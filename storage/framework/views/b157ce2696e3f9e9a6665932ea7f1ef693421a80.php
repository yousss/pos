<form data-vv-scope="payment-form">
    <div class="form-container">
        <div class="form-header">
            <h1><?php echo e(__('shop::app.checkout.onepage.payment-information')); ?></h1>
        </div>

        <div class="payment-methods">

            <div class="control-group" :class="[errors.has('payment-form.payment[method]') ? 'has-error' : '']">

                <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <span class="radio">
                        <input v-validate="'required'" type="radio" id="<?php echo e($payment['method']); ?>" name="payment[method]" value="<?php echo e($payment['method']); ?>" v-model="payment.method" @change="methodSelected()" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.payment-method')); ?>&quot;">
                        <label class="radio-view" for="<?php echo e($payment['method']); ?>"></label>
                        <?php echo e($payment['method_title']); ?>

                    </span>

                    <span class="control-info"><?php echo e($payment['description']); ?></span>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <span class="control-error" v-if="errors.has('payment-form.payment[method]')">
                    {{ errors.first('payment-form.payment[method]') }}
                </span>

            </div>
        </div>
    </div>
</form>