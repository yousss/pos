<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.account.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>
    <div class="content full-page">
        <form method="POST" action="" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <?php echo e(__('admin::app.account.title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.account.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <input name="_method" type="hidden" value="PUT">

                    <accordian :title="'<?php echo e(__('admin::app.account.general')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"><?php echo e(__('admin::app.account.name')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" value="<?php echo e($user->name); ?>"  data-vv-as="&quot;<?php echo e(__('admin::app.account.name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required"><?php echo e(__('admin::app.account.email')); ?></label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" value="<?php echo e($user->email); ?>"  data-vv-as="&quot;<?php echo e(__('admin::app.account.email')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.account.change-password')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password"><?php echo e(__('admin::app.account.password')); ?></label>
                                <input type="password" v-validate="'min:6'" class="control" id="password" name="password"  data-vv-as="&quot;<?php echo e(__('admin::app.account.password')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('password')">{{ errors.first('password') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation"><?php echo e(__('admin::app.account.confirm-password')); ?></label>
                                <input type="password" v-validate="'min:6|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;<?php echo e(__('admin::app.account.confirm-password')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.account.current-password')); ?>'" :active="true">
                        <div slot="body">
                        <div class="control-group" :class="[errors.has('current_password') ? 'has-error' : '']">
                            <label for="current_password"><?php echo e(__('admin::app.account.current-password')); ?></label>
                            <input type="password" v-validate="'required|min:6'" class="control" id="current_password" name="current_password" data-vv-as="&quot;<?php echo e(__('admin::app.account.current-password')); ?>&quot;"/>
                            <span class="control-error" v-if="errors.has('current_password')">{{ errors.first('current_password') }}</span>
                        </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>