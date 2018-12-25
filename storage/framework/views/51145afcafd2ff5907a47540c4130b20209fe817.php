<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.home.page-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <?php echo view_render_event('bagisto.shop.home.content.before'); ?>


    <?php echo DbView::make(core()->getCurrentChannel())->field('home_page_content')->with(['sliderData' => $sliderData])->render(); ?>

    
    <?php echo e(view_render_event('bagisto.shop.home.content.after')); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>