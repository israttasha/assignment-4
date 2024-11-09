<?php $__env->startSection('title', 'All Products'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid w-75 mt-3">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b>Products Management</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New Products</span></a>					
                        </div>
                    </div>
                </div>
                
                <h5><a href="<?php echo e(route('products.index')); ?>" class="" data-bs-dismiss="modal" aria-label="Close">Products List</a></h5>
                <!-- Search Form -->
                <form action="<?php echo e(route('products.index')); ?>" method="GET">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by Product ID or Description">
                    <button type="submit">Search</button>
                </form>

            <?php if($products->count() > 0): ?>

                <table class="table table-hover" id="">
                    <thead>
                        <tr>
                            <!-- Sort by name -->
                            <th>
                                <a href="<?php echo e(route('products.index', ['sort_by' => 'name', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')])); ?>">
                                    Name 
                                    <?php if(request('sort_by') === 'name'): ?>
                                        <?php echo e(request('sort_order') === 'asc' ? '↑' : '↓'); ?>

                                    <?php endif; ?>
                                </a>
                            </th>
        
                            <!-- Sort by price -->
                            <th>
                                <a href="<?php echo e(route('products.index', ['sort_by' => 'price', 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc', 'search' => request('search')])); ?>">
                                    Price 
                                    <?php if(request('sort_by') === 'price'): ?>
                                        <?php echo e(request('sort_order') === 'asc' ? '↑' : '↓'); ?>

                                    <?php endif; ?>
                                </a>
                            </th>
        
                            
                        </tr>
                    </thead>

                    <thead>
                        <tr class="bg-light">
                            <th>id</th>
                            <th>product_id</th>
                            <th>name</th>
                            <th>description</th>
                            <th>price</th>
                            <th>stock</th>
                            <th>image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td><?php echo e($product->product_id); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->description); ?></td>
                                <td><?php echo e($product->price); ?></td>
                                <td><?php echo e($product->stock); ?></td>
                                <td>
                                    <?php if($product->image): ?>
                                    <img src="<?php echo e(asset($product->image)); ?>" alt="<?php echo e($product->name); ?>" width="50px" height="50px">
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex" style="height: 77px" >
                                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="edit mt-3" ><i class="material-icons" title="Edit">&#xE254;</i></a>
                                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" id="deleteForm">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <a href="#" class="delete mt-3" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                        
                        
                    </tbody>
                </table>
              <!-- Add pagination links -->
            <div class="pagination">
                <?php echo e($products->appends(['search' => request('search'), 'sort_by' => request('sort_by'), 'sort_order' => request('sort_order')])->links()); ?>

                
            </div>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<!-- Add Products -->


<!-- Delete Modal HTML -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="" hidden id="deleteID"/>
            </div>
            <div class="modal-footer">
                <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger" >Delete</button>
            </div>
        </div>
    </div>
</div>
    
<script>
    document.getElementById('confirmDelete').addEventListener('click', function () {
        document.getElementById('deleteForm').submit();
    });

    // $('#confirmDelete').on('click', function () {
    //     $('#deleteForm').submit();
    // });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Downloads\assignment20-main\assignment20-main\resources\views\pages\index.blade.php ENDPATH**/ ?>