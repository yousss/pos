<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('shop::app.checkout.onepage.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-wrapper'); ?>

    <checkout></checkout>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

    <script type="text/x-template" id="checkout-template">
        <div id="checkout" class="checkout-process">

            <div class="col-main">

                <ul class="checkout-steps">
                    <li class="active" :class="[completedStep >= 0 ? 'active' : '', completedStep > 0 ? 'completed' : '']" @click="navigateToStep(1)">
                        <div class="decorator address-info"></div>
                        <span><?php echo e(__('shop::app.checkout.onepage.information')); ?></span>
                    </li>

                    <div class="line mb-25"></div>

                    <li :class="[currentStep == 2 || completedStep > 1 ? 'active' : '', completedStep > 1 ? 'completed' : '']" @click="navigateToStep(2)">
                        <div class="decorator shipping"></div>
                        <span><?php echo e(__('shop::app.checkout.onepage.shipping')); ?></span>
                    </li>

                    <div class="line mb-25"></div>

                    <li :class="[currentStep == 3 || completedStep > 2 ? 'active' : '', completedStep > 2 ? 'completed' : '']" @click="navigateToStep(3)">
                        <div class="decorator payment"></div>
                        <span><?php echo e(__('shop::app.checkout.onepage.payment')); ?></span>
                    </li>

                    <div class="line mb-25"></div>

                    <li :class="[currentStep == 4 ? 'active' : '']">
                        <div class="decorator review"></div>
                        <span><?php echo e(__('shop::app.checkout.onepage.complete')); ?></span>
                    </li>
                </ul>

                <div class="step-content information" v-show="currentStep == 1">

                    <?php echo $__env->make('shop::checkout.onepage.customer-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="button-group">

                        <button type="button" class="btn btn-lg btn-primary" @click="validateForm('address-form')" :disabled="disable_button">
                            <?php echo e(__('shop::app.checkout.onepage.continue')); ?>

                        </button>

                    </div>

                </div>

                <div class="step-content shipping" v-show="currentStep == 2">

                    <shipping-section v-if="currentStep == 2" @onShippingMethodSelected="shippingMethodSelected($event)"></shipping-section>

                    <div class="button-group">

                        <button type="button" class="btn btn-lg btn-primary" @click="validateForm('shipping-form')" :disabled="disable_button">
                            <?php echo e(__('shop::app.checkout.onepage.continue')); ?>

                        </button>

                    </div>

                </div>

                <div class="step-content payment" v-show="currentStep == 3">

                    <payment-section v-if="currentStep == 3" @onPaymentMethodSelected="paymentMethodSelected($event)"></payment-section>

                    <div class="button-group">

                        <button type="button" class="btn btn-lg btn-primary" @click="validateForm('payment-form')" :disabled="disable_button">
                            <?php echo e(__('shop::app.checkout.onepage.continue')); ?>

                        </button>

                    </div>

                </div>

                <div class="step-content review" v-show="currentStep == 4">

                    <review-section v-if="currentStep == 4"></review-section>

                    <div class="button-group">

                        <button type="button" class="btn btn-lg btn-primary" @click="placeOrder()" :disabled="disable_button">
                            <?php echo e(__('shop::app.checkout.onepage.place-order')); ?>

                        </button>

                    </div>

                </div>

            </div>

            <div class="col-right" v-show="currentStep != 4">

                <summary-section></summary-section>

            </div>

        </div>
    </script>

    <script>
        var shippingHtml = '';
        var paymentHtml = '';
        var reviewHtml = '';
        var summaryHtml = Vue.compile(`<?php echo view('shop::checkout.total.summary', ['cart' => $cart])->render(); ?>`);
        var customerAddress = null;
        <?php if(auth()->guard('customer')->check()): ?>
            <?php if(auth('customer')->user()->default_address): ?>
                customerAddress = <?php echo json_encode(auth('customer')->user()->default_address, 15, 512) ?>;
            <?php else: ?>
                customerAddress = {};
            <?php endif; ?>
            customerAddress.email = "<?php echo e(auth('customer')->user()->email); ?>";
            customerAddress.first_name = "<?php echo e(auth('customer')->user()->first_name); ?>";
            customerAddress.last_name = "<?php echo e(auth('customer')->user()->last_name); ?>";
        <?php endif; ?>
        Vue.component('checkout', {
            template: '#checkout-template',
            inject: ['$validator'],
            data: () => ({
                currentStep: 1,
                completedStep: 0,
                address: {
                    billing: {
                        use_for_shipping: true
                    },
                    shipping: {},
                },
                selected_shipping_method: '',
                selected_payment_method: '',
                disable_button: false,
                countryStates: <?php echo json_encode(core()->groupedStatesByCountries(), 15, 512) ?>
            }),
            created() {
                if(customerAddress) {
                    this.address.billing = customerAddress;
                    this.address.use_for_shipping = true;
                }
            },
            methods: {
                navigateToStep (step) {
                    if(step <= this.completedStep) {
                        this.currentStep = step
                        this.completedStep = step - 1;
                    }
                },
                haveStates(addressType) {
                    if(this.countryStates[this.address[addressType].country] && this.countryStates[this.address[addressType].country].length)
                        return true;
                    
                    return false;
                },
                validateForm: function (scope) {
                    this.$validator.validateAll(scope).then((result) => {
                        if(result) {
                            if(scope == 'address-form') {
                                this.saveAddress()
                            } else if(scope == 'shipping-form') {
                                this.saveShipping()
                            } else if(scope == 'payment-form') {
                                this.savePayment()
                            }
                        }
                    });
                },
                saveAddress () {
                    var this_this = this;
                    this.disable_button = true;
                    this.$http.post("<?php echo e(route('shop.checkout.save-address')); ?>", this.address)
                        .then(function(response) {
                            this_this.disable_button = false;
                            if(response.data.jump_to_section == 'shipping') {
                                shippingHtml = Vue.compile(response.data.html)
                                this_this.completedStep = 1;
                                this_this.currentStep = 2;
                            }
                        })
                        .catch(function (error) {
                            this_this.disable_button = false;
                            this_this.handleErrorResponse(error.response, 'address-form')
                        })
                },
                saveShipping () {
                    var this_this = this;
                    this.disable_button = true;
                    this.$http.post("<?php echo e(route('shop.checkout.save-shipping')); ?>", {'shipping_method': this.selected_shipping_method})
                        .then(function(response) {
                            this_this.disable_button = false;
                            if(response.data.jump_to_section == 'payment') {
                                paymentHtml = Vue.compile(response.data.html)
                                this_this.completedStep = 2;
                                this_this.currentStep = 3;
                            }
                        })
                        .catch(function (error) {
                            this_this.disable_button = false;
                            this_this.handleErrorResponse(error.response, 'shipping-form')
                        })
                },
                savePayment () {
                    var this_this = this;
                    this.disable_button = true;
                    this.$http.post("<?php echo e(route('shop.checkout.save-payment')); ?>", {'payment': this.selected_payment_method})
                        .then(function(response) {
                            this_this.disable_button = false;
                            if(response.data.jump_to_section == 'review') {
                                reviewHtml = Vue.compile(response.data.html)
                                this_this.completedStep = 3;
                                this_this.currentStep = 4;
                            }
                        })
                        .catch(function (error) {
                            this_this.disable_button = false;
                            this_this.handleErrorResponse(error.response, 'payment-form')
                        })
                },
                placeOrder () {
                    var this_this = this;
                    this.disable_button = true;
                    this.$http.post("<?php echo e(route('shop.checkout.save-order')); ?>", {'_token': "<?php echo e(csrf_token()); ?>"})
                        .then(function(response) {
                            if(response.data.success) {
                                if(response.data.redirect_url) {
                                    window.location.href = response.data.redirect_url;
                                } else {
                                    window.location.href = "<?php echo e(route('shop.checkout.success')); ?>";
                                }
                            }
                        })
                        .catch(function (error) {
                            this_this.disable_button = true;
                            window.flashMessages = [{'type': 'alert-error', 'message': "<?php echo e(__('shop::app.common.error')); ?>" }];
                            this_this.$root.addFlashMessages()
                        })
                },
                handleErrorResponse (response, scope) {
                    if(response.status == 422) {
                        serverErrors = response.data.errors;
                        this.$root.addServerErrors(scope)
                    } else if(response.status == 403) {
                        if(response.data.redirect_url) {
                            window.location.href = response.data.redirect_url;
                        }
                    }
                },
                shippingMethodSelected (shippingMethod) {
                    this.selected_shipping_method = shippingMethod;
                },
                paymentMethodSelected (paymentMethod) {
                    this.selected_payment_method = paymentMethod;
                }
            }
        })
        var summaryTemplateRenderFns = [];
        Vue.component('summary-section', {
            inject: ['$validator'],
            data: () => ({
                templateRender: null
            }),
            staticRenderFns: summaryTemplateRenderFns,
            mounted() {
                this.templateRender = summaryHtml.render;
                for (var i in summaryHtml.staticRenderFns) {
                    summaryTemplateRenderFns.push(summaryHtml.staticRenderFns[i]);
                }
            },
            render(h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                    ]);
            }
        })
        var shippingTemplateRenderFns = [];
        Vue.component('shipping-section', {
            inject: ['$validator'],
            data: () => ({
                templateRender: null,
                selected_shipping_method: '',
            }),
            staticRenderFns: shippingTemplateRenderFns,
            mounted() {
                this.templateRender = shippingHtml.render;
                for (var i in shippingHtml.staticRenderFns) {
                    shippingTemplateRenderFns.unshift(shippingHtml.staticRenderFns[i]);
                }
            },
            render(h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                    ]);
            },
            methods: {
                methodSelected () {
                    this.$emit('onShippingMethodSelected', this.selected_shipping_method)
                }
            }
        })
        var paymentTemplateRenderFns = [];
        Vue.component('payment-section', {
            inject: ['$validator'],
            data: () => ({
                templateRender: null,
                payment: {
                    method: ""
                },
            }),
            staticRenderFns: paymentTemplateRenderFns,
            mounted() {
                this.templateRender = paymentHtml.render;
                for (var i in paymentHtml.staticRenderFns) {
                    paymentTemplateRenderFns.unshift(paymentHtml.staticRenderFns[i]);
                }
            },
            render(h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                    ]);
            },
            methods: {
                methodSelected () {
                    this.$emit('onPaymentMethodSelected', this.payment)
                }
            }
        })
        var reviewTemplateRenderFns = [];
        Vue.component('review-section', {
            data: () => ({
                templateRender: null
            }),
            staticRenderFns: reviewTemplateRenderFns,
            mounted() {
                this.templateRender = reviewHtml.render;
                for (var i in reviewHtml.staticRenderFns) {
                    reviewTemplateRenderFns.unshift(reviewHtml.staticRenderFns[i]);
                }
            },
            render(h) {
                return h('div', [
                    (this.templateRender ?
                        this.templateRender() :
                        '')
                    ]);
            }
        })
    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('shop::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>