<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.catalog.products.edit-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <?php $locale = request()->get('locale') ?: app()->getLocale(); ?>
        <?php $channel = request()->get('channel') ?: core()->getDefaultChannelCode(); ?>

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">

                <div class="page-title">
                    <h1><?php echo e(__('admin::app.catalog.products.edit-title')); ?></h1>

                    <div class="control-group">
                        <select class="control" id="channel-switcher" name="channel">
                            <?php $__currentLoopData = core()->getAllChannels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channelModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($channelModel->code); ?>" <?php echo e(($channelModel->code) == $channel ? 'selected' : ''); ?>>
                                    <?php echo e($channelModel->name); ?>

                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="control-group">
                        <select class="control" id="locale-switcher" name="locale">
                            <?php $__currentLoopData = core()->getAllLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($localeModel->code); ?>" <?php echo e(($localeModel->code) == $locale ? 'selected' : ''); ?>>
                                    <?php echo e($localeModel->name); ?>

                                </option>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.catalog.products.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <?php echo csrf_field(); ?>

                <input name="_method" type="hidden" value="PUT">

                <?php $__currentLoopData = $product->attribute_family->attribute_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attributeGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($attributeGroup->custom_attributes)): ?>
                        <accordian :title="'<?php echo e(__($attributeGroup->name)); ?>'" :active="true">
                            <div slot="body">

                                <?php $__currentLoopData = $attributeGroup->custom_attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(!$product->super_attributes->contains($attribute)): ?>

                                        <?php
                                            $validations = [];
                                            $disabled = false;
                                            if($product->type == 'configurable' && in_array($attribute->code, ['price', 'cost', 'special_price', 'special_price_from', 'special_price_to', 'width', 'height', 'depth', 'weight'])) {
                                                if(!$attribute->is_required)
                                                    continue;

                                                $disabled = true;
                                            } else {
                                                if ($attribute->is_required) {
                                                    array_push($validations, 'required');
                                                }

                                                if ($attribute->type == 'price') {
                                                    array_push($validations, 'decimal');
                                                }

                                                array_push($validations, $attribute->validation);
                                            }

                                            $validations = implode('|', array_filter($validations));
                                        ?>

                                        <?php if(view()->exists($typeView = 'admin::catalog.products.field-types.' . $attribute->type)): ?>

                                            <div class="control-group <?php echo e($attribute->type); ?>" :class="[errors.has('<?php echo e($attribute->code); ?>') ? 'has-error' : '']">
                                                <label for="<?php echo e($attribute->code); ?>" <?php echo e($attribute->is_required ? 'class=required' : ''); ?>>
                                                    <?php echo e($attribute->admin_name); ?>


                                                    <?php if($attribute->type == 'price'): ?>
                                                        <span class="currency-code">(<?php echo e(core()->currencySymbol(core()->getBaseCurrencyCode())); ?>)</span>
                                                    <?php endif; ?>

                                                    <?php
                                                        $channel_locale = [];
                                                        if($attribute->value_per_channel) {
                                                            array_push($channel_locale, $channel);
                                                        }

                                                        if($attribute->value_per_locale) {
                                                            array_push($channel_locale, $locale);
                                                        }
                                                    ?>

                                                    <?php if(count($channel_locale)): ?>
                                                        <span class="locale">[<?php echo e(implode(' - ', $channel_locale)); ?>]</span>
                                                    <?php endif; ?>
                                                </label>

                                                <?php echo $__env->make($typeView, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                                                <span class="control-error" v-if="errors.has('<?php echo e($attribute->code); ?>')">{{ errors.first('<?php echo $attribute->code; ?>') }}</span>
                                            </div>

                                        <?php endif; ?>

                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </accordian>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($form_accordians): ?>

                    <?php $__currentLoopData = $form_accordians->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accordian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php echo $__env->make($accordian['view'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js')); ?>"></script>

    <script>
        $(document).ready(function () {
            $('#channel-switcher, #locale-switcher').on('change', function (e) {
                $('#channel-switcher').val()
                var query = '?channel=' + $('#channel-switcher').val() + '&locale=' + $('#locale-switcher').val();

                window.location.href = "<?php echo e(route('admin.catalog.products.edit', $product->id)); ?>" + query;
            })

            tinymce.init({
                selector: 'textarea#description, textarea#short_description',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>