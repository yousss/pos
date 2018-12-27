<?php if(auth()->guard('customer')->check()): ?>
    <?php echo view_render_event('bagisto.shop.products.wishlist.before'); ?>


    <a class="add-to-wishlist" href="<?php echo e(route('customer.wishlist.add', $product->id)); ?>" id="wishlist-changer">
        <span class="icon wishlist-icon"></span>
    </a>

    <?php echo view_render_event('bagisto.shop.products.wishlist.after'); ?>

<?php endif; ?>