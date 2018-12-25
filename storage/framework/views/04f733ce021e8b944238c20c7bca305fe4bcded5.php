<?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>

<?php $cart = cart()->getCart(); ?>

<?php if($cart): ?>
    <?php $items = $cart->items; ?>

    <div class="dropdown-toggle">
        <div style="display: inline-block; cursor: pointer;">
            <span class="name">
                Cart
                <span class="count"> (<?php echo e(intval($cart->items_qty)); ?>)</span>
            </span>
        </div>

        <i class="icon arrow-down-icon active"></i>
    </div>

    <div class="dropdown-list" style="display: none; top: 50px; right: 0px">
        <div class="dropdown-container">
            <div class="dropdown-cart">
                <div class="dropdown-header">
                    <p class="heading">
                        <?php echo e(__('shop::app.checkout.cart.cart-subtotal')); ?> -
                        <?php echo e(core()->currency($cart->base_sub_total)); ?>

                    </p>
                </div>

                <div class="dropdown-content">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <div class="item">
                                <div class="item-image" >
                                    <?php
                                        if($item->type == "configurable")
                                            $images = $productImageHelper->getProductBaseImage($item->child->product);
                                        else
                                            $images = $productImageHelper->getProductBaseImage($item->product);
                                    ?>
                                    <img src="<?php echo e($images['small_image_url']); ?>" />
                                </div>

                                <div class="item-details">
                                    
                                        <div class="item-name"><?php echo e($item->name); ?></div>
                                    

                                    <?php if($item->type == "configurable"): ?>
                                        <div class="item-options">
                                            <?php echo e(trim(Cart::getProductAttributeOptionDetails($item->child->product)['html'])); ?>

                                        </div>
                                    <?php endif; ?>

                                    <div class="item-price"><?php echo e(core()->currency($item->base_total)); ?></div>

                                    <div class="item-qty">Quantity - <?php echo e($item->quantity); ?></div>
                                </div>
                            </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="dropdown-footer">
                    <a href="<?php echo e(route('shop.checkout.cart.index')); ?>"><?php echo e(__('shop::app.minicart.view-cart')); ?></a>

                    <a class="btn btn-primary btn-lg" style="color: white;" href="<?php echo e(route('shop.checkout.onepage.index')); ?>"><?php echo e(__('shop::app.minicart.checkout')); ?></a>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>

    <div class="dropdown-toggle">
        <div style="display: inline-block; cursor: pointer;">

            <span class="name"><?php echo e(__('shop::app.minicart.cart')); ?><span class="count"> (<?php echo e(__('shop::app.minicart.zero')); ?>) </span></span>
        </div>
    </div>
<?php endif; ?>