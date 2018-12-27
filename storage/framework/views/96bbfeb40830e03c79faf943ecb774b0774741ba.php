<?php echo view_render_event('bagisto.shop.products.list.card.before', ['product' => $product]); ?>


<div class="product-card">

    <?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>

    <?php $productBaseImage = $productImageHelper->getProductBaseImage($product); ?>

    <?php if($product->new): ?>
        <div class="sticker new">
            <?php echo e(__('shop::app.products.new')); ?>

        </div>
    <?php endif; ?>

    <div class="product-image">
        <a href="<?php echo e(route('shop.products.index', $product->url_key)); ?>" title="<?php echo e($product->name); ?>">
            <img src="<?php echo e($productBaseImage['medium_image_url']); ?>" />
        </a>
    </div>

    <div class="product-information">

        <div class="product-name">
            <a href="<?php echo e(url()->to('/').'/products/'.$product->url_key); ?>" title="<?php echo e($product->name); ?>">
                <span>
                    <?php echo e($product->name); ?>

                </span>
            </a>
        </div>

        <div class="product-description">
            <?php echo e($product->short_description); ?>

        </div>

        <?php echo $__env->make('shop::products.price', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if(Route::currentRouteName() == "shop.products.index"): ?>
            <?php echo $__env->make('shop::products.add-to', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php else: ?>
            <?php if($product->type == "configurable"): ?>
                <div class="cart-wish-wrap">
                    <a href="<?php echo e(route('cart.add.configurable', $product->url_key)); ?>" class="btn btn-lg btn-primary addtocart">
                        <?php echo e(__('shop::app.products.add-to-cart')); ?>

                    </a>

                    <?php echo $__env->make('shop::products.wishlist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            <?php else: ?>
                <div class="cart-wish-wrap">
                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" value="false" name="is_configurable">
                        <button class="btn btn-lg btn-primary addtocart" <?php echo e($product->haveSufficientQuantity(1) ? '' : 'disabled'); ?>><?php echo e(__('shop::app.products.add-to-cart')); ?></button>
                    </form>

                    <?php echo $__env->make('shop::products.wishlist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>

<?php echo view_render_event('bagisto.shop.products.list.card.after', ['product' => $product]); ?>