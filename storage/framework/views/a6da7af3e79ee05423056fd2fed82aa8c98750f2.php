<?php $__env->startSection('page_title'); ?>
    <?php echo e($category->meta_title ?? $category->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('seo'); ?>
    <meta name="description" content="<?php echo e($category->meta_description); ?>"/>
    <meta name="description" content="<?php echo e($category->meta_keywords); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
    <?php $productRepository = app('Webkul\Product\Repositories\ProductRepository'); ?>

    <div class="main">
        <?php echo view_render_event('bagisto.shop.products.index.before', ['category' => $category]); ?>


        <div class="category-container">

            <?php echo $__env->make('shop::products.list.layered-navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="category-block">
                <div class="hero-image mb-35">
                    <?php if(!is_null($category->image)): ?>

                        <img class="logo" src="<?php echo e($category->image_url); ?>" />

                    <?php endif; ?>
                </div>

                <?php $products = $productRepository->findAllByCategory($category->id); ?>

                <?php if($products->count()): ?>

                    <?php echo $__env->make('shop::products.list.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php $toolbarHelper = app('Webkul\Product\Helpers\Toolbar'); ?>

                    <?php if($toolbarHelper->getCurrentMode() == 'grid'): ?>
                        <div class="product-grid-3">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('shop::products.list.card', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <div class="product-list">
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('shop::products.list.card', ['product' => $product], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php echo view_render_event('bagisto.shop.products.index.pagination.before'); ?>


                    <div class="bottom-toolbar">
                        <?php echo e($products->appends(request()->input())->links()); ?>

                    </div>

                    <?php echo view_render_event('bagisto.shop.products.index.pagination.after'); ?>


                <?php else: ?>

                    <div class="product-list empty">
                        <h2><?php echo e(__('shop::app.products.whoops')); ?></h2>

                        <p>
                            <?php echo e(__('shop::app.products.empty')); ?>

                        </p>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        <?php echo view_render_event('bagisto.shop.products.index.after', ['category' => $category]); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            var sort = document.getElementById("sort");
            var filter = document.getElementById("filter");
            var sortLimit = document.getElementsByClassName('pager')[0];
            var layerFilter = document.getElementsByClassName('responsive-layred-filter')[0];
            layerFilter.style.display ="none";
            if(sort && filter) {
                sort.addEventListener("click", sortFilter);
                filter.addEventListener("click", sortFilter);
            }
            function sortFilter() {
                var className = document.getElementById(this.id).className;
                if(className === 'icon sort-icon') {
                    sort.classList.remove("sort-icon");
                    sort.classList.add("icon-menu-close-adj");
                    filter.classList.remove("icon-menu-close-adj");
                    filter.classList.add("filter-icon");
                    sortLimit.style.display = "flex";
                    sortLimit.style.justifyContent = "space-between";
                    layerFilter.style.display ="none";
                } else if(className === 'icon filter-icon') {
                    filter.classList.remove("filter-icon");
                    filter.classList.add("icon-menu-close-adj");
                    sort.classList.remove("icon-menu-close-adj");
                    sort.classList.add("sort-icon");
                    layerFilter.style.display = "block";
                    layerFilter.style.marginTop = "10px";
                    sortLimit.style.display = "none";
                } else {
                    sort.classList.remove("icon-menu-close-adj");
                    sort.classList.add("sort-icon");
                    filter.classList.remove("icon-menu-close-adj");
                    filter.classList.add("filter-icon");
                    sortLimit.style.display = "none";
                    layerFilter.style.display = "none";
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>