<thead>
    <?php if(count($massoperations)): ?>
        <tr class="mass-action" style="display: none; height: 63px;">
            <th colspan="10" style="width: 100%;">
                <div class="mass-action-wrapper">
                    <span class="massaction-remove">
                        <span class="icon checkbox-dash-icon"></span>
                    </span>

                    <form method="POST" style="display: inline-flex;" id="mass-action-form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="indexes" name="indexes" value="">

                        <div class="control-group">
                            <select class="control massaction-type" name="massaction-type" id="massaction-type">
                                <?php $__currentLoopData = $massoperations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $massoperation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($key == 0): ?> selected <?php endif; ?> value="<?php echo e($key); ?>"><?php echo e($massoperation['type']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <?php $__currentLoopData = $massoperations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value['type'] == 'update'): ?>
                                <div class="control-group" style="display: none; margin-left: 10px;" id="update-options">
                                    <select class="options control" name="update-options" id="option-type">
                                        <?php $__currentLoopData = $value['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php if($key == 0): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <input type="hidden" name="selected-option-text" id="selected-option-text" value="">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <input type="submit" class="btn btn-sm btn-primary" style="margin-left: 10px;">
                    </form>
                </div>
            </th>
        </tr>
    <?php endif; ?>
    <tr class="table-grid-header">
        <?php if(count($massoperations)): ?>
            <th>
                <span class="checkbox">
                    <input type="checkbox" id="mastercheckbox">
                    <label class="checkbox-view" for="checkbox"></label>
                </span>
            </th>
        <?php endif; ?>
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($column->sortable == "true"): ?>
                <th class="grid_head sortable"
                    <?php if(strpos($column->alias, ' as ')): ?>
                        <?php $exploded_name = explode(' as ',$column->name); ?>
                        data-column-name="<?php echo e($exploded_name[0]); ?>"
                    <?php else: ?>
                        data-column-name="<?php echo e($column->alias); ?>"
                    <?php endif; ?>

                    data-column-label="<?php echo e($column->label); ?>"
                    data-column-sort="asc">
                    <?php echo $column->sorting(); ?><span class="icon"></span>
                </th>
                <?php else: ?>
                    <th class="grid_head"
                        data-column-name="<?php echo e($column->alias); ?>"
                        data-column-label="<?php echo e($column->label); ?>">
                        <?php echo $column->sorting(); ?>

                    </th>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($actions)): ?>
            <th style="width: 85px;">
                <?php echo e(__('ui::app.datagrid.actions')); ?>

            </th>
        <?php endif; ?>
    </tr>
</thead>