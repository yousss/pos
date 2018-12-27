<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.tax-rates.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.settings.tax-rates.title')); ?></h1>
            </div>

            <div class="page-action">
                <a href="<?php echo e(route('admin.tax-rates.show')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.settings.tax-rates.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">
            <?php $taxrates = app('Webkul\Admin\DataGrids\TaxRateDataGrid'); ?>
            <?php echo $taxrates->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>