<?php if($products->count()): ?>
    <section class="featured-products">

        <div class="featured-heading">
            <?php echo e(__('shop::app.home.new-products')); ?><br/>

            <span class="featured-seperator" style="color:lightgrey;">_____</span>
        </div>

        <div class="product-grid-4">
        
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php echo $__env->make('shop::products.list.card', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        
    </section>
<?php endif; ?>