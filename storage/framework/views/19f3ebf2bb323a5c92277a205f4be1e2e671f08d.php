<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.locales.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">

        <form method="POST" action="<?php echo e(route('admin.locales.store')); ?>" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1><?php echo e(__('admin::app.settings.locales.add-title')); ?></h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.settings.locales.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <accordian :title="'<?php echo e(__('admin::app.settings.locales.general')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required"><?php echo e(__('admin::app.settings.locales.code')); ?></label>
                                <input v-validate="'required'" class="control" id="code" name="code" data-vv-as="&quot;<?php echo e(__('admin::app.settings.locales.code')); ?>&quot;" v-code/>
                                <span class="control-error" v-if="errors.has('code')">{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"><?php echo e(__('admin::app.settings.locales.name')); ?></label>
                                <input v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;<?php echo e(__('admin::app.settings.locales.name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>
                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>