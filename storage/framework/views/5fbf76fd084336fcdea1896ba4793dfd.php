// resources/views/products/show.blade.php


<?php $__env->startSection('content'); ?>
    <h1><?php echo e($product->name); ?></h1>

    <p>Product ID: <?php echo e($product->product_id); ?></p>
    <p>Description: <?php echo e($product->description); ?></p>
    <p>Price: $<?php echo e($product->price); ?></p>
    <p>Stock: <?php echo e($product->stock); ?></p>
    <?php if($product->image): ?>
        <p><img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>"></p>
    <?php endif; ?>

    <a href="<?php echo e(route('products.edit', $product->id)); ?>">Edit</a>

    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
        <button type="submit">Delete</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\USER\Downloads\assignment20-main\assignment20-main\resources\views\pages\show.blade.php ENDPATH**/ ?>