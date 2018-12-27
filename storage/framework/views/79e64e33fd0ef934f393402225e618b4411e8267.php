<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.catalog.categories.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">

        <form method="POST" action="<?php echo e(route('admin.catalog.categories.store')); ?>" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1><?php echo e(__('admin::app.catalog.categories.add-title')); ?></h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.catalog.categories.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="locale" value="all"/>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.general')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required"><?php echo e(__('admin::app.catalog.categories.name')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" value="<?php echo e(old('name')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.name')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('name')">{{ errors.first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('status') ? 'has-error' : '']">
                                <label for="status" class="required"><?php echo e(__('admin::app.catalog.categories.visible-in-menu')); ?></label>
                                <select class="control" v-validate="'required'" id="status" name="status" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.visible-in-menu')); ?>&quot;">
                                    <option value="1">
                                        <?php echo e(__('admin::app.catalog.categories.yes')); ?>

                                    </option>
                                    <option value="0">
                                        <?php echo e(__('admin::app.catalog.categories.no')); ?>

                                    </option>
                                </select>
                                <span class="control-error" v-if="errors.has('status')">{{ errors.first('status') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('position') ? 'has-error' : '']">
                                <label for="position" class="required"><?php echo e(__('admin::app.catalog.categories.position')); ?></label>
                                <input type="text" v-validate="'required|numeric'" class="control" id="position" name="position" value="<?php echo e(old('position')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.position')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('position')">{{ errors.first('position') }}</span>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.description-and-images')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('description') ? 'has-error' : '']">
                                <label for="description" class="required"><?php echo e(__('admin::app.catalog.categories.description')); ?></label>
                                <textarea v-validate="'required'" class="control" id="description" name="description" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.description')); ?>&quot;"><?php echo e(old('description')); ?></textarea>
                                <span class="control-error" v-if="errors.has('description')">{{ errors.first('description') }}</span>
                            </div>

                            <div class="control-group">
                                <label><?php echo e(__('admin::app.catalog.categories.image')); ?>


                                <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="image" :multiple="false"></image-wrapper>
                            </div>

                        </div>
                    </accordian>

                    <?php if($categories->count()): ?>
                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.parent-category')); ?>'" :active="true">
                        <div slot="body">

                            <tree-view value-field="id" name-field="parent_id" input-type="radio" items='<?php echo json_encode($categories, 15, 512) ?>'></tree-view>

                        </div>
                    </accordian>
                    <?php endif; ?>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.categories.seo')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group">
                                <label for="meta_title"><?php echo e(__('admin::app.catalog.categories.meta_title')); ?></label>
                                <input type="text" class="control" id="meta_title" name="meta_title" value="<?php echo e(old('meta_title')); ?>"/>
                            </div>

                            <div class="control-group" :class="[errors.has('slug') ? 'has-error' : '']">
                                <label for="slug" class="required"><?php echo e(__('admin::app.catalog.categories.slug')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="slug" name="slug" value="<?php echo e(old('slug')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.categories.slug')); ?>&quot;" v-slugify/>
                                <span class="control-error" v-if="errors.has('slug')">{{ errors.first('slug') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="meta_description"><?php echo e(__('admin::app.catalog.categories.meta_description')); ?></label>
                                <textarea class="control" id="meta_description" name="meta_description"><?php echo e(old('meta_description')); ?></textarea>
                            </div>

                            <div class="control-group">
                                <label for="meta_keywords"><?php echo e(__('admin::app.catalog.categories.meta_keywords')); ?></label>
                                <textarea class="control" id="meta_keywords" name="meta_keywords"><?php echo e(old('meta_keywords')); ?></textarea>
                            </div>

                        </div>
                    </accordian>

                </div>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>