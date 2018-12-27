<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.customers.reviews.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.customers.reviews.title')); ?></h1>
            </div>
            <div class="page-action">
                
            </div>
        </div>

        <div class="page-content">
            <?php $review = app('Webkul\Admin\DataGrids\CustomerReviewDataGrid'); ?>
            <?php echo $review->render(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>