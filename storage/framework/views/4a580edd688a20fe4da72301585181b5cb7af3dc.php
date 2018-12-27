<div class="order-summary">
    <h3><?php echo e(__('shop::app.checkout.total.order-summary')); ?></h3>

    <div class="item-detail">
        <label>
            <?php echo e(intval($cart->items_qty)); ?>

            <?php echo e(__('shop::app.checkout.total.sub-total')); ?>

            <?php echo e(__('shop::app.checkout.total.price')); ?>

        </label>
        <label class="right"><?php echo e(core()->currency($cart->base_sub_total)); ?></label>
    </div>

    <?php if($cart->selected_shipping_rate): ?>
        <div class="item-detail">
            <label><?php echo e(__('shop::app.checkout.total.delivery-charges')); ?></label>
            <label class="right"><?php echo e(core()->currency($cart->selected_shipping_rate->price)); ?></label>
        </div>
    <?php endif; ?>

    <?php if($cart->base_tax_total): ?>
        <div class="item-detail">
            <label><?php echo e(__('shop::app.checkout.total.tax')); ?></label>
            <label class="right"><?php echo e(core()->currency($cart->base_tax_total)); ?></label>
        </div>
    <?php endif; ?>

    <div class="payble-amount">
        <label><?php echo e(__('shop::app.checkout.total.grand-total')); ?></label>
        <label class="right"><?php echo e(core()->currency($cart->base_grand_total)); ?></label>
    </div>
</div>