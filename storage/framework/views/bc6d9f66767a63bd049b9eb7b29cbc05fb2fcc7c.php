<?php echo view_render_event('bagisto.shop.products.view.stock.before', ['product' => $product]); ?>


<div class="stock-status <?php echo e($product->type != 'configurable' && !$product->haveSufficientQuantity(1) ? '' : 'active'); ?>">
    <?php echo e($product->type != 'configurable' && !$product->haveSufficientQuantity(1) ? __('shop::app.products.out-of-stock') : __('shop::app.products.in-stock')); ?>

</div>

<?php echo view_render_event('bagisto.shop.products.view.stock.after', ['product' => $product]); ?>