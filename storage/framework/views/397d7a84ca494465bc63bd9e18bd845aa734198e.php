<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.catalog.attributes.add-title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <form method="POST" action="<?php echo e(route('admin.catalog.attributes.store')); ?>" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1><?php echo e(__('admin::app.catalog.attributes.add-title')); ?></h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        <?php echo e(__('admin::app.catalog.attributes.save-btn-title')); ?>

                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <?php echo csrf_field(); ?>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.attributes.general')); ?>'" :active="true">
                        <div slot="body">
                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="code"><?php echo e(__('admin::app.catalog.attributes.code')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="code" name="code" value="<?php echo e(old('code')); ?>"  data-vv-as="&quot;<?php echo e(__('admin::app.catalog.attributes.code')); ?>&quot;" v-code/>
                                <span class="control-error" v-if="errors.has('code')">{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="type" class="required"><?php echo e(__('admin::app.catalog.attributes.type')); ?></label>
                                <select class="control" id="type" name="type">
                                    <option value="text"><?php echo e(__('admin::app.catalog.attributes.text')); ?></option>
                                    <option value="textarea"><?php echo e(__('admin::app.catalog.attributes.textarea')); ?></option>
                                    <option value="price"><?php echo e(__('admin::app.catalog.attributes.price')); ?></option>
                                    <option value="boolean"><?php echo e(__('admin::app.catalog.attributes.boolean')); ?></option>
                                    <option value="select"><?php echo e(__('admin::app.catalog.attributes.select')); ?></option>
                                    <option value="multiselect"><?php echo e(__('admin::app.catalog.attributes.multiselect')); ?></option>
                                    <option value="datetime"><?php echo e(__('admin::app.catalog.attributes.datetime')); ?></option>
                                    <option value="date"><?php echo e(__('admin::app.catalog.attributes.date')); ?></option>
                                </select>
                            </div>
                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.attributes.label')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group" :class="[errors.has('admin_name') ? 'has-error' : '']">
                                <label for="admin_name" class="required"><?php echo e(__('admin::app.catalog.attributes.admin')); ?></label>
                                <input type="text" v-validate="'required'" class="control" id="admin_name" name="admin_name" value="<?php echo e(old('admin_name')); ?>" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.attributes.admin')); ?>&quot;"/>
                                <span class="control-error" v-if="errors.has('admin_name')">{{ errors.first('admin_name') }}</span>
                            </div>

                            <?php $__currentLoopData = Webkul\Core\Models\Locale::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="control-group">
                                    <label for="locale-<?php echo e($locale->code); ?>"><?php echo e($locale->name . ' (' . $locale->code . ')'); ?></label>
                                    <input type="text" class="control" id="locale-<?php echo e($locale->code); ?>" name="<?php echo $locale->code; ?>[name]" value="<?php echo e(old($locale->code)['name']); ?>"/>
                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </accordian>

                    <div class="hide">
                        <accordian :title="'<?php echo e(__('admin::app.catalog.attributes.options')); ?>'" :active="true" :id="'options'">
                            <div slot="body">

                                <option-wrapper></option-wrapper>

                            </div>
                        </accordian>
                    </div>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.attributes.validations')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group">
                                <label for="is_required"><?php echo e(__('admin::app.catalog.attributes.is_required')); ?></label>
                                <select class="control" id="is_required" name="is_required">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="is_unique"><?php echo e(__('admin::app.catalog.attributes.is_unique')); ?></label>
                                <select class="control" id="is_unique" name="is_unique">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="validation"><?php echo e(__('admin::app.catalog.attributes.input_validation')); ?></label>
                                <select class="control" id="validation" name="validation">
                                    <option value=""></option>
                                    <option value="numeric"><?php echo e(__('admin::app.catalog.attributes.number')); ?></option>
                                    <option value="email"><?php echo e(__('admin::app.catalog.attributes.email')); ?></option>
                                    <option value="decimal"><?php echo e(__('admin::app.catalog.attributes.decimal')); ?></option>
                                    <option value="url"><?php echo e(__('admin::app.catalog.attributes.url')); ?></option>
                                </select>
                            </div>

                        </div>
                    </accordian>

                    <accordian :title="'<?php echo e(__('admin::app.catalog.attributes.configuration')); ?>'" :active="true">
                        <div slot="body">

                            <div class="control-group">
                                <label for="value_per_locale"><?php echo e(__('admin::app.catalog.attributes.value_per_locale')); ?></label>
                                <select class="control" id="value_per_locale" name="value_per_locale">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="value_per_channel"><?php echo e(__('admin::app.catalog.attributes.value_per_channel')); ?></label>
                                <select class="control" id="value_per_channel" name="value_per_channel">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="is_filterable"><?php echo e(__('admin::app.catalog.attributes.is_filterable')); ?></label>
                                <select class="control" id="is_filterable" name="is_filterable">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="is_configurable"><?php echo e(__('admin::app.catalog.attributes.is_configurable')); ?></label>
                                <select class="control" id="is_configurable" name="is_configurable">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                            <div class="control-group">
                                <label for="is_visible_on_front"><?php echo e(__('admin::app.catalog.attributes.is_visible_on_front')); ?></label>
                                <select class="control" id="is_visible_on_front" name="is_visible_on_front">
                                    <option value="0"><?php echo e(__('admin::app.catalog.attributes.no')); ?></option>
                                    <option value="1"><?php echo e(__('admin::app.catalog.attributes.yes')); ?></option>
                                </select>
                            </div>

                        </div>
                    </accordian>
                </div>
            </div>

        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script type="text/x-template" id="options-template">
        <div>
            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo e(__('admin::app.catalog.attributes.admin_name')); ?></th>

                            <?php $__currentLoopData = Webkul\Core\Models\Locale::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <th><?php echo e($locale->name . ' (' . $locale->code . ')'); ?></th>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <th><?php echo e(__('admin::app.catalog.attributes.position')); ?></th>

                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="row in optionRows">
                            <td>
                                <div class="control-group" :class="[errors.has(adminName(row)) ? 'has-error' : '']">
                                    <input type="text" v-validate="'required'" v-model="row['admin_name']" :name="adminName(row)" class="control" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.attributes.admin_name')); ?>&quot;"/>
                                    <span class="control-error" v-if="errors.has(adminName(row))">{{ errors.first(adminName(row)) }}</span>
                                </div>
                            </td>

                            <?php $__currentLoopData = Webkul\Core\Models\Locale::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
                                    <div class="control-group" :class="[errors.has(localeInputName(row, '<?php echo e($locale->code); ?>')) ? 'has-error' : '']">
                                        <input type="text" v-validate="'required'" v-model="row['<?php echo e($locale->code); ?>']" :name="localeInputName(row, '<?php echo e($locale->code); ?>')" class="control" data-vv-as="&quot;<?php echo e($locale->name . ' (' . $locale->code . ')'); ?>&quot;"/>
                                        <span class="control-error" v-if="errors.has(localeInputName(row, '<?php echo e($locale->code); ?>'))">{{ errors.first(localeInputName(row, '<?php echo $locale->code; ?>')) }}</span>
                                    </div>
                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <td>
                                <div class="control-group" :class="[errors.has(sortOrderName(row)) ? 'has-error' : '']">
                                    <input type="text" v-validate="'required|numeric'" :name="sortOrderName(row)" class="control" data-vv-as="&quot;<?php echo e(__('admin::app.catalog.attributes.position')); ?>&quot;"/>
                                    <span class="control-error" v-if="errors.has(sortOrderName(row))">{{ errors.first(sortOrderName(row)) }}</span>
                                </div>
                            </td>

                            <td class="actions">
                                <i class="icon trash-icon" @click="removeRow(row)"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-lg btn-primary" id="add-option-btn" style="margin-top: 20px" @click="addOptionRow()">
                <?php echo e(__('admin::app.catalog.attributes.add-option-btn-title')); ?>

            </button>
        </div>
    </script>

    <script>
        $(document).ready(function () {
            $('#type').on('change', function (e) {
                if(['select', 'multiselect', 'checkbox'].indexOf($(e.target).val()) === -1) {
                    $('#options').parent().addClass('hide')
                } else {
                    $('#options').parent().removeClass('hide')
                }
            })

            var optionWrapper = Vue.component('option-wrapper', {

                template: '#options-template',

                data: () => ({
                    optionRowCount: 0,
                    optionRows: []
                }),

                methods: {
                    addOptionRow () {
                        var rowCount = this.optionRowCount++;
                        var row = {'id': 'option_' + rowCount};

                        <?php $__currentLoopData = Webkul\Core\Models\Locale::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        row['<?php echo e($locale->code); ?>'] = '';
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        this.optionRows.push(row);
                    },

                    removeRow (row) {
                        var index = this.optionRows.indexOf(row)
                        Vue.delete(this.optionRows, index);
                    },

                    adminName (row) {
                        return 'options[' + row.id + '][admin_name]';
                    },

                    localeInputName (row, locale) {
                        return 'options[' + row.id + '][' + locale + '][label]';
                    },

                    sortOrderName (row) {
                        return 'options[' + row.id + '][sort_order]';
                    }
                }
            })

            new Vue({
                el: '#options',

                components: {
                    optionWrapper: optionWrapper
                },
            })
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>