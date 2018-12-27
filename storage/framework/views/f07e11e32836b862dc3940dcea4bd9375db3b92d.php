<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.sales.invoices.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.sales.invoices.title')); ?></h1>
            </div>

            <div class="page-action">
                <div class="export" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span>
                        <?php echo e(__('admin::app.export.export')); ?>

                    </span>
                </div>
            </div>
        </div>

        <div class="page-content">
            <?php $orderInvoicesGrid = app('Webkul\Admin\DataGrids\OrderInvoicesDataGrid'); ?>
            <?php echo $orderInvoicesGrid->render(); ?>

        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header"><?php echo e(__('admin::app.export.download')); ?></h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/x-template" id="export-form-template">
    <form method="POST" action="<?php echo e(route('admin.datagrid.export')); ?>">

        <div class="page-content">
            <div class="form-container">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="gridData" value="<?php echo e(serialize($orderInvoicesGrid)); ?>">

                <div class="control-group">
                    <label for="format" class="required">
                        <?php echo e(__('admin::app.export.format')); ?>

                    </label>
                    <select name="format" class="control" v-validate="'required'">
                        <option value="xls">XLS</option>
                        <option value="csv">CSV</option>
                    </select>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-lg btn-primary" @click="closeModal">
            <?php echo e(__('admin::app.export.export')); ?>

        </button>

    </form>
</script>

<script>
    Vue.component('export-form', {
        template: '#export-form-template',
        methods: {
            closeModal () {
                this.$parent.closeModal();
            }
        }
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin::layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>