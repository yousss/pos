<div class="table">
    
    <table class="<?php echo e($css->table); ?>">
        <?php echo $__env->make('ui::datagrid.table.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('ui::datagrid.table.body', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </table>
    <?php echo $__env->make('ui::datagrid.pagination', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>