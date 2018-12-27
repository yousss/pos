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

        <style>
            .container {
                text-align: center;
                position: absolute;
                width: 100%;
                height: 100%;
                display: table;
                z-index: 1;
                background: #F8F9FA;
            }
            .center-box {
                display: table-cell;
                vertical-align: middle;
            }
            .adjacent-center {
                width: 365px;
                display: inline-block;
                text-align: left;
            }

            .form-container .control-group .control {
                width: 100%;
            }

            h1 {
                font-size: 24px;
                font-weight: 600;
                margin-bottom: 30px;
            }

            .brand-logo {
                margin-bottom: 30px;
                text-align: center;
            }

            .footer {
                margin-top: 40px;
                padding: 0 20px;
            }

            .footer p {
                font-size: 14px;
                color: #8E8E8E;
                text-align: center;
            }

            .btn.btn-primary {
                width: 100%;
            }
        </style>

        <?php echo $__env->yieldContent('css'); ?>
    </head>
    <body>
        <div id="app" class="container">

            <flash-wrapper ref='flashes'></flash-wrapper>

            <div class="center-box">
            
                <div class="adjacent-center">

                    <div class="brand-logo">
                        <img src="<?php echo e(asset('vendor/webkul/ui/assets/images/logo.png')); ?>" alt="Bagisto"/>
                    </div>

                    <?php echo $__env->yieldContent('content'); ?>

                    <div class="footer">
                        <p>
                            © Copyright 2018, All rights reserved.
                        </p>
                    </div>

                </div>

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
            <?php endif; ?>

            window.serverErrors = [];
            <?php if(count($errors)): ?>
                window.serverErrors = <?php echo json_encode($errors->getMessages(), 15, 512) ?>;
            <?php endif; ?>
        </script>

        <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/admin/assets/js/admin.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('vendor/webkul/ui/assets/js/ui.js')); ?>"></script>

        <?php echo $__env->yieldContent('javascript'); ?>
        
    </body>
</html>