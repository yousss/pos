<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.settings.channels.edit-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">

        <form method="POST" action="<?php echo e(route('admin.channels.update', $channel->id)); ?>" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="page-header">
                <div class="page-title">
                    <h1><?php echo e(__('admin::app.settings.channels.edit-title')); ?></h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.settings.channels.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>
                    <input name="_method" type="hidden" value="PUT">

                    <accordian :title="'<?php echo e(__('admin::app.settings.channels.general')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code" class="required"><?php echo e(__('admin::app.settings.channels.code')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="code" name="code" data-vv-as="&quot;<?php echo e(__('admin::app.settings.channels.code')); ?>&quot;" value="<?php echo e($channel->code); ?>" disabled="disabled"/>
                                <input type="hidden" name="code" value="<?php echo e($channel->code); ?>"/>
                                <span class="control-error" v-if="errors.has('code')">{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"><?php echo e(__('admin::app.settings.channels.name')); ?></label>
                                <input v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;<?php echo e(__('admin::app.settings.channels.name')); ?>&quot;" value="<?php echo e(old('name') ?: $channel->name); ?>"/>
                                <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="description"><?php echo e(__('admin::app.settings.channels.description')); ?></label>
                                <textarea class="control" id="description" name="description"><?php echo e(old('description') ?: $channel->description); ?></textarea>
                            </div>

                            <div class="control-group">
                                <label for="hostname"><?php echo e(__('admin::app.settings.channels.hostname')); ?></label>
                                <input type="text" class="control" id="hostname" name="hostname" value="<?php echo e($channel->hostname); ?>" placeholder="https://www.example.com"/>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.settings.channels.currencies-and-locales')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('locales[]') ? 'has-error' : '']">
                                <label for="locales" class="required"><?php echo e(__('admin::app.settings.channels.locales')); ?></label>
                                <?php $selectedOptionIds = old('locales') ?: $channel->locales->pluck('id')->toArray() ?>
                                <select v-validate="'required'" class="control" id="locales" name="locales[]" data-vv-as="&quot;<?php echo e(__('admin::app.settings.channels.locales')); ?>&quot;" multiple>
                                    <?php $__currentLoopData = core()->getAllLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($locale->id); ?>" <?php echo e(in_array($locale->id, $selectedOptionIds) ? 'selected' : ''); ?>>
                                            <?php echo e($locale->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('locales[]')">{{ errors.first('locales[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('default_locale_id') ? 'has-error' : '']">
                                <label for="default_locale_id" class="required"><?php echo e(__('admin::app.settings.channels.default-locale')); ?></label>
                                <?php $selectedOption = old('default_locale_id') ?: $channel->default_locale_id ?>
                                <select v-validate="'required'" class="control" id="default_locale_id" name="default_locale_id" data-vv-as="&quot;<?php echo e(__('admin::app.settings.channels.default-locale')); ?>&quot;">
                                    <?php $__currentLoopData = core()->getAllLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($locale->id); ?>" <?php echo e($selectedOption == $locale->id ? 'selected' : ''); ?>>
                                            <?php echo e($locale->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('default_locale_id')">{{ errors.first('default_locale_id') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('currencies[]') ? 'has-error' : '']">
                                <label for="currencies" class="required"><?php echo e(__('admin::app.settings.channels.currencies')); ?></label>
                                <?php $selectedOptionIds = old('currencies') ?: $channel->currencies->pluck('id')->toArray() ?>
                                <select v-validate="'required'" class="control" id="currencies" name="currencies[]" data-vv-as="&quot;<?php echo e(__('admin::app.settings.channels.currencies')); ?>&quot;" multiple>
                                    <?php $__currentLoopData = core()->getAllCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($currency->id); ?>" <?php echo e(in_array($currency->id, $selectedOptionIds) ? 'selected' : ''); ?>>
                                            <?php echo e($currency->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('currencies[]')">{{ errors.first('currencies[]') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('base_currency_id') ? 'has-error' : '']">
                                <label for="base_currency_id" class="required"><?php echo e(__('admin::app.settings.channels.base-currency')); ?></label>
                                <?php $selectedOption = old('base_currency_id') ?: $channel->base_currency_id ?>
                                <select v-validate="'required'" class="control" id="base_currency_id" name="base_currency_id" data-vv-as="&quot;<?php echo e(__('admin::app.settings.channels.base-currency')); ?>&quot;">
                                    <?php $__currentLoopData = core()->getAllCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($currency->id); ?>" <?php echo e($selectedOption == $currency->id ? 'selected' : ''); ?>>
                                            <?php echo e($currency->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="control-error" v-if="errors.has('base_currency_id')">{{ errors.first('base_currency_id') }}</span>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.settings.channels.design')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group">
                                <label for="theme"><?php echo e(__('admin::app.settings.channels.theme')); ?></label>

                                <?php $selectedOption = old('theme') ?: $channel->theme ?>

                                <select class="control" id="theme" name="theme">
                                    <?php $__currentLoopData = themes()->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($theme->code); ?>" <?php echo e($selectedOption == $theme->code ? 'selected' : ''); ?>>
                                            <?php echo e($theme->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="home_page_content"><?php echo e(__('admin::app.settings.channels.home_page_content')); ?></label>
                                <textarea class="control" id="home_page_content" name="home_page_content"><?php echo e(old('home_page_content') ?: $channel->home_page_content); ?></textarea>
                            </div>

                            <div class="control-group">
                                <label for="footer_content"><?php echo e(__('admin::app.settings.channels.footer_content')); ?></label>
                                <textarea class="control" id="footer_content" name="footer_content"><?php echo e(old('footer_content') ?: $channel->footer_content); ?></textarea>
                            </div>

                            <div class="control-group">
                                <label><?php echo e(__('admin::app.settings.channels.logo')); ?>


                                <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="logo" :multiple="false" :images='"<?php echo e($channel->logo_url); ?>"'></image-wrapper>
                            </div>

                            <div class="control-group">
                                <label><?php echo e(__('admin::app.settings.channels.favicon')); ?>


                                <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="favicon" :multiple="false" :images='"<?php echo e($channel->favicon_url); ?>"'></image-wrapper>
                            </div>

                        </div>
                    </accordian>

                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js')); ?>"></script>

    <script>
        $(document).ready(function () {
            tinymce.init({
                selector: 'textarea#home_page_content,textarea#footer_content',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
                image_advtab: true,
                valid_elements : '*[*]',
                templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                ],
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>