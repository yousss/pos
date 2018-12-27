<?php echo view_render_event('bagisto.shop.products.view.up-sells.after', ['product' => $product]); ?>


<?php if($product->up_sells()->count()): ?>
    <div class="attached-products-wrapper">

        <div class="title">
            <?php echo e(__('shop::app.products.up-sell-title')); ?>

            <span class="border-bottom"></span>
        </div>

        <div class="product-grid max-4-col">

            <?php $__currentLoopData = $product->up_sells()->paginate(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $up_sell_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php echo $__env->make('shop::products.list.card', ['product' => $up_sell_product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
<?php endif; ?>

<?php echo view_render_event('bagisto.shop.products.view.up-sells.after', ['product' => $product]); ?>