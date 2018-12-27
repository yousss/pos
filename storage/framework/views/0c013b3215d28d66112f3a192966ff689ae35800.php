<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.users.users.add-user-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form method="POST" action="<?php echo e(route('admin.users.store')); ?>" @submit.prevent="onSubmit">
            <div class="page-header">
                <div class="page-title">
                    <h1><?php echo e(__('admin::app.users.users.add-user-title')); ?></h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.users.users.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <accordian :title="'<?php echo e(__('admin::app.users.users.general')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"><?php echo e(__('admin::app.users.users.name')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;<?php echo e(__('admin::app.users.users.name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required"><?php echo e(__('admin::app.users.users.email')); ?></label>
                                <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;<?php echo e(__('admin::app.users.users.email')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('Password')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                                <label for="password"><?php echo e(__('admin::app.users.users.password')); ?></label>
                                <input type="password" v-validate="'min:6|max:18'" class="control" id="password" name="password" data-vv-as="&quot;<?php echo e(__('admin::app.users.users.password')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('password')">{{ errors.first('password') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                                <label for="password_confirmation"><?php echo e(__('admin::app.users.users.confirm-password')); ?></label>
                                <input type="password" v-validate="'min:6|max:18|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;<?php echo e(__('admin::app.users.users.confirm-password')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('password_confirmation')">{{ errors.first('password_confirmation') }}</span>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.users.users.status-and-role')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('role_id') ? 'has-error' : '']">
                                <label for="role" class="required"><?php echo e(__('admin::app.users.users.role')); ?></label>
                                <select v-validate="'required'" class="control" name="role_id" data-vv-as="&quot;<?php echo e(__('admin::app.users.users.role')); ?>&quot;">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('role_id')">{{ errors.first('role_id') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="status"><?php echo e(__('admin::app.users.users.status')); ?></label>
                                <span class="checkbox">
                                    <input type="checkbox" id="status" name="status" value="1">
                                    <label class="checkbox-view" for="status"></label>
                                    <?php echo e(__('admin::app.users.users.account-is-active')); ?>

                                </span>
                            </div>
                        </div>
                    </accordian>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>