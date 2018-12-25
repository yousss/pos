<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.error.404.page-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <div class="error-container" style="width: 100%; display: flex; justify-content: center;">

        <div class="wrapper" style="display: flex; height: 60vh; width: 100%;
            justify-content: start; align-items: center;">

            <div class="error-box"  style="width: 50%">

                <div class="error-title" style="font-size: 100px;color: #5E5E5E">
                    <?php echo e(__('admin::app.error.404.name')); ?>

                </div>

                <div class="error-messgae" style="font-size: 24px;color: #5E5E5E">
                    <?php echo e(__('admin::app.error.404.title')); ?>

                </div>

                <div class="error-description" style="margin-top: 20px;margin-bottom: 20px;color: #242424">
                    <?php echo e(__('admin::app.error.404.message')); ?>

                </div>

                <a href="<?php echo e(route('shop.home.index')); ?>">
                    <?php echo e(__('admin::app.error.go-to-home')); ?>

                </a>

            </div>

            <div class="error-graphic icon-404" style="margin-left: 10% ;"></div>

        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>