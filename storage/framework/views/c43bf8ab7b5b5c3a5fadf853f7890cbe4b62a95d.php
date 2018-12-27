<form data-vv-scope="shipping-form">
    <div class="form-container">
        <div class="form-header">
            <h1><?php echo e(__('shop::app.checkout.onepage.shipping-method')); ?></h1>
        </div>

        <div class="shipping-methods">

            <div class="control-group" :class="[errors.has('shipping-form.shipping_method') ? 'has-error' : '']">

                <?php $__currentLoopData = $shippingRateGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rateGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <h4 for=""><?php echo e($rateGroup['carrier_title']); ?></h4>

                    <?php $__currentLoopData = $rateGroup['rates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="radio" >
                            <input v-validate="'required'" type="radio" id="<?php echo e($rate->method); ?>" name="shipping_method" data-vv-as="&quot;<?php echo e(__('shop::app.checkout.onepage.shipping-method')); ?>&quot;" value="<?php echo e($rate->method); ?>" v-model="selected_shipping_method" @change="methodSelected()">
                            <label class="radio-view" for="<?php echo e($rate->method); ?>"></label>
                            <?php echo e($rate->method_title); ?>

                            <b><?php echo e(core()->currency($rate->base_price)); ?></b>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <span class="control-error" v-if="errors.has('shipping-form.shipping_method')">
                    {{ errors.first('shipping-form.shipping_method') }}
                </span>

            </div>

        </div>
    </div>
</form>