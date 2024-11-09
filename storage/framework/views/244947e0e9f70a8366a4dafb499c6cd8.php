<?php $__env->startSection('content'); ?>

<div class="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">Back</a>
            </div>
            <form action="<?php echo e(route('products.update', $products->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body">
                    
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">product_id *</label>
                                    <input type="text" class="form-control" name="product_id" value="<?php echo e($products->product_id); ?>">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">name *</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo e($products->name); ?>">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">description </label>
                                    <input type="text" class="form-control" name="description" value="<?php echo e($products->description); ?>">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">price *</label>
                                    <input type="text" class="form-control" name="price" value="<?php echo e($products->price); ?>">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">stock </label>
                                    <input type="text" class="form-control" name="stock" value="<?php echo e($products->stock); ?>">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">image </label>
                                    <input type="file" class="form-control" name="image" value="<?php echo e($products->image); ?>">
                                </div>
                                
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Downloads\assignment20-main\assignment20-main\resources\views\pages\edit.blade.php ENDPATH**/ ?>