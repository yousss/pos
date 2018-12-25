<div class="header" id="header">
    <div class="header-top">
        <div class="left-content">
            <ul class="logo-container">
                <li>
                    <a href="<?php echo e(route('shop.home.index')); ?>">
                        <?php if($logo = core()->getCurrentChannel()->logo_url): ?>
                            <img class="logo" src="<?php echo e($logo); ?>" />
                        <?php else: ?>
                            <img class="logo" src="<?php echo e(bagisto_asset('images/logo.svg')); ?>" />
                        <?php endif; ?>
                    </a>
                </li>
            </ul>

            <ul class="search-container">
                <li class="search-group">
                    <form role="search" action="<?php echo e(route('shop.search.index')); ?>" method="GET" style="display: inherit;">
                        <input type="search" name="term" class="search-field" placeholder="<?php echo e(__('shop::app.header.search-text')); ?>" required>

                        <div class="search-icon-wrapper">
                            <button class="" class="background: none;">
                                <i class="icon icon-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>

        <div class="right-content">
            <?php if(core()->getCurrentChannel()->currencies->count() > 1): ?>
                <ul class="currency-switcher">
                    <div class="dropdown-toggle">
                        <?php echo e(core()->getCurrentCurrencyCode()); ?>

                        <i class="icon arrow-down-icon active"></i>
                    </div>

                    <div class="dropdown-list bottom-right">
                        <div class="dropdown-container">
                            <ul>
                                <?php $__currentLoopData = core()->getCurrentChannel()->currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="?currency=<?php echo e($currency->code); ?>"><?php echo e($currency->code); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </ul>
            <?php endif; ?>

            <ul class="account-dropdown-container">
                <li class="account-dropdown">
                    <div class="dropdown-toggle account">
                        <span class="icon account-icon"></span>
                        <i class="icon arrow-down-icon active"></i>
                    </div>

                    <?php if(auth()->guard('customer')->guest()): ?>
                        <div class="dropdown-list bottom-right" style="display: none;">
                            <div class="dropdown-container">
                                <label><?php echo e(__('shop::app.header.title')); ?></label><br/>
                                <span style="font-size: 12px;"><?php echo e(__('shop::app.header.dropdown-text')); ?></span>
                                <ul class="account-dropdown-list">
                                    <li><a class="btn btn-primary btn-sm" href="<?php echo e(route('customer.session.index')); ?>"><?php echo e(__('shop::app.header.sign-in')); ?></a></li>

                                    <li><a class="btn btn-primary btn-sm" href="<?php echo e(route('customer.register.index')); ?>"><?php echo e(__('shop::app.header.sign-up')); ?></a></li>
                                </ul>

                            </div>

                        </div>
                    <?php endif; ?>

                    <?php if(auth()->guard('customer')->check()): ?>
                        <div class="dropdown-list bottom-right" style="display: none; max-width: 230px;">
                            <div class="dropdown-container">
                                <label><?php echo e(auth()->guard('customer')->user()->first_name); ?></label>
                                <ul>
                                    <li><a href="<?php echo e(route('customer.profile.index')); ?>"><?php echo e(__('shop::app.header.profile')); ?></a></li>

                                    <li><a href="<?php echo e(route('customer.wishlist.index')); ?>"><?php echo e(__('shop::app.header.wishlist')); ?></a></li>

                                    <li><a href="<?php echo e(route('shop.checkout.cart.index')); ?>"><?php echo e(__('shop::app.header.cart')); ?></a></li>

                                    <li><a href="<?php echo e(route('customer.session.destroy')); ?>"><?php echo e(__('shop::app.header.logout')); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>

            <ul class="cart-dropdown-container">
                <?php $productImageHelper = app('Webkul\Product\Helpers\ProductImage'); ?>

                <li class="cart-dropdown">
                    <span class="icon cart-icon"></span>
                    <?php echo $__env->make('shop::checkout.cart.mini-cart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </li>
            </ul>

            <ul class="right-responsive">
                <li class="search-box"><span class="icon icon-search" id="search"></span></li>
                <ul class="resp-account-dropdown-container">

                    <li class="account-dropdown">
                        <div class="dropdown-toggle">
                            <span class="icon account-icon"></span>
                        </div>

                        <?php if(auth()->guard()->guest()): ?>
                            <div class="dropdown-list bottom-right" style="display: none;">
                                <div class="dropdown-container">
                                    <label><?php echo e(__('shop::app.header.title')); ?></label>

                                    <ul>
                                        <li><a href="<?php echo e(route('customer.session.index')); ?>"><?php echo e(__('shop::app.header.sign-in')); ?></a></li>
                                        <li><a href="<?php echo e(route('customer.register.index')); ?>"><?php echo e(__('shop::app.header.sign-up')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(auth()->guard('customer')->check()): ?>
                            <div class="dropdown-list bottom-right" style="display: none;">
                                <div class="dropdown-container">

                                    <label><?php echo e(auth()->guard('customer')->user()->first_name); ?></label>

                                    <ul>
                                        <li><a href="<?php echo e(route('customer.profile.index')); ?>"><?php echo e(__('shop::app.header.profile')); ?></a></li>

                                        <li><a href="<?php echo e(route('customer.wishlist.index')); ?>"><?php echo e(__('shop::app.header.wishlist')); ?></a></li>

                                        <li><a href="<?php echo e(route('shop.checkout.cart.index')); ?>"><?php echo e(__('shop::app.header.cart')); ?></a></li>

                                        <li><a href="<?php echo e(route('customer.session.destroy')); ?>"><?php echo e(__('shop::app.header.logout')); ?></a></li>
                                    </ul>

                                </div>

                            </div>
                        <?php endif; ?>
                    </li>
                </ul>

                <ul class="resp-cart-dropdown-container">

                    <li class="cart-dropdown">
                        <?php $cart = cart()->getCart(); ?>

                        <?php if(isset($cart)): ?>
                            <div>
                                <a href="<?php echo e(route('shop.checkout.cart.index')); ?>">
                                    <span class="icon cart-icon"></span>
                                </a>
                            </div>
                        <?php else: ?>
                            <div style="display: inline-block; cursor: pointer;">
                                <span class="icon cart-icon"></span>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
                <li class="menu-box" ><span class="icon icon-menu" id="hammenu"></span></li>
            </ul>
        </div>
    </div>

    <div class="header-bottom" id="header-bottom">
        <?php echo $__env->make('shop::layouts.header.nav-menu.navmenu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <div class="search-responsive mt-10">
        <form role="search" action="<?php echo e(route('shop.search.index')); ?>" method="GET" style="display: inherit;">
            <div class="search-content">
                <button class="" style="background: none; border: none; padding: 0px;">
                    <i class="icon icon-search mt-10"></i>
                </button>
                <input type="search" name="term" class="search mt-5">
                <button class="" style="background: none; float: right; border: none; padding: 0px;">
                    <i class="icon icon-menu-back right mt-10"></i>
                </button>
            </div>
        </form>

        
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var hamMenu = document.getElementById("hammenu");
            var search = document.getElementById("search");
            var searchResponsive = document.getElementsByClassName('search-responsive')[0];
            var navResponsive = document.getElementsByClassName('header-bottom')[0];
            search.addEventListener("click", header);
            hamMenu.addEventListener("click", header);
            function header() {
                var className = document.getElementById(this.id).className;
                if(className === 'icon icon-search' ) {
                    search.classList.remove("icon-search");
                    search.classList.add("icon-menu-close");
                    hamMenu.classList.remove("icon-menu-close");
                    hamMenu.classList.add("icon-menu");
                    searchResponsive.style.display = 'block';
                    navResponsive.style.display = 'none';
                } else if(className === 'icon icon-menu') {
                    hamMenu.classList.remove("icon-menu");
                    hamMenu.classList.add("icon-menu-close");
                    search.classList.remove("icon-menu-close");
                    search.classList.add("icon-search");
                    searchResponsive.style.display = 'none';
                    navResponsive.style.display = 'block';
                } else {
                    search.classList.remove("icon-menu-close");
                    search.classList.add("icon-search");
                    hamMenu.classList.remove("icon-menu-close");
                    hamMenu.classList.add("icon-menu");
                    searchResponsive.style.display = 'none';
                    navResponsive.style.display = 'none';
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>