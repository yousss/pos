<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <title><?php echo $__env->yieldContent('page_title'); ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="icon" sizes="16x16" href="<?php echo e(asset('vendor/webkul/ui/assets/images/favicon.ico')); ?>" />

        <link rel="stylesheet" href="<?php echo e(asset('vendor/webkul/admin/assets/css/admin.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendor/webkul/ui/assets/css/ui.css')); ?>">

        <?php echo $__env->yieldContent('head'); ?>

        <?php echo $__env->yieldContent('css'); ?>

    </head>

    <body>
        <div id="app">

            <flash-wrapper ref='flashes'></flash-wrapper>

            <?php echo $__env->make('admin::layouts.nav-top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->make('admin::layouts.nav-left', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <div class="content-container">

                <?php echo $__env->yieldContent('content-wrapper'); ?>

            </div>

        </div>

        <script type="text/javascript">
            window.flashMessages = [];
            <?php if($success = session('success')): ?>
                window.flashMessages = [{'type': 'alert-success', 'message': "<?php echo e($success); ?>" }];
            <?php elseif($warning = session('warning')): ?>
                window.flashMessages = [{'type': 'alert-warning', 'message': "<?php echo e($warning); ?>" }];
            <?php elseif($error = session('error')): ?>
                window.flashMessages = [{'type': 'alert-error', 'message': "<?php echo e($error); ?>" }];
            <?php elseif($info = session('info')): ?>
                window.flashMessages = [{'type': 'alert-error', 'message': "<?php echo e($info); ?>" }];
            <?php endif; ?>

            window.serverErrors = [];
            <?php if(isset($errors)): ?>
                <?php if(count($errors)): ?>
                    window.serverErrors = <?php echo json_encode($errors->getMessages(), 15, 512) ?>;
                <?php endif; ?>
            <?php endif; ?>
        </script>

        <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/admin/assets/js/admin.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/ui/assets/js/ui.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('scripts'); ?>

        <div class="modal-overlay"></div>
    </body>
</html>