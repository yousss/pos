<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.customers.customers.edit-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form method="POST" action="<?php echo e(route('admin.customer.update', $customer->id)); ?>">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <?php echo e(__('admin::app.customers.customers.title')); ?>

                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.customers.customers.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">

                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <input name="_method" type="hidden" value="PUT">

                    <accordian :title="'<?php echo e(__('admin::app.account.general')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('first_name') ? 'has-error' : '']">
                                <label for="first_name" class="required"> <?php echo e(__('admin::app.customers.customers.first_name')); ?></label>
                                <input type="text"  class="control" name="first_name" v-validate="'required'" value="<?php echo e($customer->first_name); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customers.customers.first_name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('last_name') ? 'has-error' : '']">
                                <label for="last_name" class="required"> <?php echo e(__('admin::app.customers.customers.last_name')); ?></label>
                                <input type="text"  class="control"  name="last_name"   v-validate="'required'" value="<?php echo e($customer->last_name); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customers.customers.last_name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('last_name')">{{ errors.first('last_name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                                <label for="email" class="required"> <?php echo e(__('admin::app.customers.customers.email')); ?></label>
                                <input type="email"  class="control"  name="email" v-validate="'required|email'" value="<?php echo e($customer->email); ?>" data-vv-as="&quot;<?php echo e(__('shop::app.customers.customers.email')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="gender" class="required"><?php echo e(__('admin::app.customers.customers.gender')); ?></label>
                                <select name="gender" class="control" v-validate="'gender'" value="<?php echo e($customer->gender); ?>" v-validate="'required'" data-vv-as="&quot;<?php echo e(__('shop::app.customers.customers.gender')); ?>&quot;">
                                        <option value="Male" <?php echo e($customer->gender == "Male" ? 'selected' : ''); ?>><?php echo e(__('admin::app.customers.customers.male')); ?></option>
                                        <option value="Female" <?php echo e($customer->gender == "Female" ? 'selected' : ''); ?>><?php echo e(__('admin::app.customers.customers.female')); ?></option>
                                </select>
                                <span class="control-error" v-if="errors.has('gender')">{{ errors.first('gender') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('date_of_birth') ? 'has-error' : '']">
                                <label for="dob"><?php echo e(__('admin::app.customers.customers.date_of_birth')); ?></label>
                                <input type="date" class="control" name="date_of_birth" value="<?php echo e($customer->date_of_birth); ?>" v-validate="" data-vv-as="&quot;<?php echo e(__('admin::app.customers.customers.date_of_birth')); ?>&quot;">
                                <span class="control-error" v-if="errors.has('date_of_birth')">{{ errors.first('date_of_birth') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="customerGroup" ><?php echo e(__('admin::app.customers.customers.customer_group')); ?></label>

                                <?php if(!is_null($customer->customer_group_id)): ?>
                                    <?php $selectedCustomerOption = $customer->customerGroup->id ?>
                                <?php else: ?>
                                    <?php $selectedCustomerOption = '' ?>
                                <?php endif; ?>

                                <select  class="control" name="customer_group_id">
                                    <?php $__currentLoopData = $customerGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($group->id); ?>" <?php echo e($selectedCustomerOption == $group->id ? 'selected' : ''); ?>>
                                        <?php echo e($group->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="control-group" :class="[errors.has('channel_id') ? 'has-error' : '']">
                                <label for="channel" ><?php echo e(__('admin::app.customers.customers.channel_name')); ?></label>

                                <?php if(!is_null($customer->channel_id)): ?>
                                    <?php $selectedChannelOption = $customer->channel_id ?>
                                <?php else: ?>
                                    <?php $selectedChannelOption = $customer->channel_id ?>
                                <?php endif; ?>

                                <select  class="control" name="channel_id" v-validate="'required'" data-vv-as="&quot;<?php echo e(__('shop::app.customers.customers.channel_name')); ?>&quot;">
                                    <?php $__currentLoopData = $channelName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($channel->id); ?>" <?php echo e($selectedChannelOption == $channel->id ? 'selected' : ''); ?>>
                                        <?php echo e($channel->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('channel_id')">{{ errors.first('channel_id') }}</span>
                            </div>

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>