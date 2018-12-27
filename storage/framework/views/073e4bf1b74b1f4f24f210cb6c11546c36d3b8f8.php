<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.checkout.cart.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
    <?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>
    <section class="cart">
        <?php if($cart): ?>
            <div class="title">
                <?php echo e(__('shop::app.checkout.cart.title')); ?>

            </div>

            <div class="cart-content">
                <div class="left-side">
                    <form action="<?php echo e(route('shop.checkout.cart.update')); ?>" method="POST" @submit.prevent="onSubmit">

                        <div class="cart-item-list" style="margin-top: 0">
                            <?php echo csrf_field(); ?>
                            <?php $__currentLoopData = $cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    if($item->type == "configurable")
                                        $productBaseImage = $productImageHelper->getProductBaseImage($item->child->product);
                                    else
                                        $productBaseImage = $productImageHelper->getProductBaseImage($item->product);
                                ?>

                                <div class="item">
                                    <div style="margin-right: 15px;">
                                        <a href="<?php echo e(url()->to('/').'/products/'.$item->product->url_key); ?>"><img class="item-image" src="<?php echo e($productBaseImage['medium_image_url']); ?>" /></a>
                                    </div>

                                    <div class="item-details">

                                        <div class="item-title">
                                            <a href="<?php echo e(url()->to('/').'/products/'.$item->product->url_key); ?>">
                                                <?php echo e($item->product->name); ?>

                                            </a>
                                        </div>

                                        <div class="price">
                                            <?php echo e(core()->currency($item->base_price)); ?>

                                        </div>

                                        <?php if($item->type == 'configurable'): ?>

                                            <div class="summary">

                                                <?php echo e(Cart::getProductAttributeOptionDetails($item->child->product)['html']); ?>


                                            </div>
                                        <?php endif; ?>
                                        <div class="misc">
                                            <div class="control-group" :class="[errors.has('qty[<?php echo e($item->id); ?>]') ? 'has-error' : '']">
                                                <div class="wrap">
                                                    <label for="qty[<?php echo e($item->id); ?>]"><?php echo e(__('shop::app.checkout.cart.quantity.quantity')); ?></label>

                                                    <input type="text" class="control" v-validate="'required|numeric|min_value:1'" name="qty[<?php echo e($item->id); ?>]" value="<?php echo e($item->quantity); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.cart.quantity.quantity')); ?>&quot;">
                                                </div>

                                                <span class="control-error" v-if="errors.has('qty[<?php echo e($item->id); ?>]')">{{ errors.first('qty[<?php echo $item->id; ?>]') }}</span>
                                            </div>

                                            <span class="remove">
                                                <a href="<?php echo e(route('shop.checkout.cart.remove', $item->id)); ?>" onclick="removeLink('Do you really want to do this?')"><?php echo e(__('shop::app.checkout.cart.remove-link')); ?></a></span>

                                            <?php if(auth()->guard('customer')->check()): ?>
                                                <span class="towishlist">
                                                    <?php if($item->parent_id != 'null' ||$item->parent_id != null): ?>
                                                        <a href="<?php echo e(route('shop.movetowishlist', $item->id)); ?>" onclick="removeLink('Do you really want to do this?')"><?php echo e(__('shop::app.checkout.cart.move-to-wishlist')); ?></a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('shop.movetowishlist', $item->child->id)); ?>" onclick="removeLink('<?php echo e(__('shop::app.checkout.cart.cart-remove-action')); ?>')"><?php echo e(__('shop::app.checkout.cart.move-to-wishlist')); ?></a>
                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if(!cart()->isItemHaveQuantity($item)): ?>
                                            <div class="error-message mt-15">
                                                * <?php echo e(__('shop::app.checkout.cart.quantity-error')); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="misc-controls">
                            <a href="<?php echo e(route('shop.home.index')); ?>" class="link"><?php echo e(__('shop::app.checkout.cart.continue-shopping')); ?></a>

                            <div>
                                <button type="submit" class="btn btn-lg btn-primary">
                                    <?php echo e(__('shop::app.checkout.cart.update-cart')); ?>

                                </button>

                                <?php if(!cart()->hasError()): ?>
                                    <a href="<?php echo e(route('shop.checkout.onepage.index')); ?>" class="btn btn-lg btn-primary">
                                        <?php echo e(__('shop::app.checkout.cart.proceed-to-checkout')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="right-side">
                    <?php echo $__env->make('shop::checkout.total.summary', ['cart' => $cart], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>

        <?php else: ?>

            <div class="title">
                <?php echo e(__('shop::app.checkout.cart.title')); ?>

            </div>

            <div class="cart-content">
                <p>
                    <?php echo e(__('shop::app.checkout.cart.empty')); ?>

                </p>

                <p style="display: inline-block;">
                    <a style="display: inline-block;" href="<?php echo e(route('shop.home.index')); ?>" class="btn btn-lg btn-primary"><?php echo e(__('shop::app.checkout.cart.continue-shopping')); ?></a>
                </p>
            </div>

        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function removeLink(message){
            if(!confirm(message))
            event.preventDefault();
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>