<div class="form-container">
    <div class="form-header">
        <h1><?php echo e(__('shop::app.checkout.onepage.summary')); ?></h1>
    </div>

    <div class="address">

        <?php if($billingAddress = $cart->billing_address): ?>
            <div class="address-card billing-address">
                <div class="card-title">
                    <span><?php echo e(__('shop::app.checkout.onepage.billing-address')); ?></span>
                </div>

                <div class="card-content">
                    <?php echo e($billingAddress->name); ?></br>
                    <?php echo e($billingAddress->address1); ?>, <?php echo e($billingAddress->address2 ? $billingAddress->address2 . ',' : ''); ?> <?php echo e($billingAddress->state); ?></br>
                    <?php echo e(country()->name($billingAddress->country)); ?> <?php echo e($billingAddress->postcode); ?></br>
                    
                    <span class="horizontal-rule"></span>

                    <?php echo e(__('shop::app.checkout.onepage.contact')); ?> : <?php echo e($billingAddress->phone); ?> 
                </div>
            </div>
        <?php endif; ?>

        <?php if($shippingAddress = $cart->shipping_address): ?>
            <div class="address-card shipping-address">
                <div class="card-title">
                    <span><?php echo e(__('shop::app.checkout.onepage.shipping-address')); ?></span>
                </div>

                <div class="card-content">
                    <?php echo e($shippingAddress->name); ?></br>
                    <?php echo e($shippingAddress->address1); ?>, <?php echo e($shippingAddress->address2 ? $shippingAddress->address2 . ',' : ''); ?> , <?php echo e($shippingAddress->state); ?></br>
                    <?php echo e(country()->name($shippingAddress->country)); ?> <?php echo e($shippingAddress->postcode); ?></br>
                    
                    <span class="horizontal-rule"></span>

                    <?php echo e(__('shop::app.checkout.onepage.contact')); ?> : <?php echo e($shippingAddress->phone); ?> 
                </div>
            </div>
        <?php endif; ?>

    </div>

    <?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>

    <div class="cart-item-list">
        <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php 
                $product = $item->product; 
                $productBaseImage = $productImageHelper->getProductBaseImage($product);
            ?>

            <div class="item">
                <div style="margin-right: 15px;">
                    <img class="item-image" src="<?php echo e($productBaseImage['medium_image_url']); ?>" />
                </div>

                <div class="item-details">

                    <div class="item-title">
                        <?php echo e($product->name); ?>

                    </div>

                    <div class="row">
                        <span class="title">
                            <?php echo e(__('shop::app.checkout.onepage.price')); ?>

                        </span>
                        <span class="value">
                            <?php echo e(core()->currency($item->base_price)); ?>

                        </span>
                    </div>

                    <div class="row">
                        <span class="title">
                            <?php echo e(__('shop::app.checkout.onepage.quantity')); ?>

                        </span>
                        <span class="value">
                            <?php echo e($item->quantity); ?>

                        </span>
                    </div>

                    <?php if($product->type == 'configurable'): ?>
                        
                        <div class="summary" >

                            <?php echo e(Cart::getProductAttributeOptionDetails($item->child->product)['html']); ?>

                            
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <div class="order-description">

        <div class="pull-left" style="width: 50%;float: left;">
            
            <div class="shipping">
                <div class="decorator">
                    <i class="icon shipping-icon"></i>
                </div>

                <div class="text">
                    <?php echo e(core()->currency($cart->selected_shipping_rate->base_price)); ?>


                    <div class="info">
                        <?php echo e($cart->selected_shipping_rate->method_title); ?>

                    </div>
                </div>
            </div>

            <div class="payment">
                <div class="decorator">
                    <i class="icon payment-icon"></i>
                </div>

                <div class="text">
                    <?php echo e(core()->getConfigData('paymentmethods.' . $cart->payment->method . '.title')); ?>

                </div>
            </div>

        </div>

        <div class="pull-right" style="width: 50%;float: left;">

            <?php echo $__env->make('shop::checkout.total.summary', ['cart' => $cart], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>

    </div>

</div>