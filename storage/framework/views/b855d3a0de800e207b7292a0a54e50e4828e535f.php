<tbody class="<?php echo e($css->tbody); ?>">
    <?php if(count($results) == 0): ?>
    <tr>
        <td colspan="<?php echo e(count($columns)+1); ?>" style="text-align: center;">
            <?php echo e(__('ui::app.datagrid.no-records')); ?>

        </td>
    </tr>
    <?php endif; ?>
    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <?php if(count($massoperations)): ?>
        <td>
            <span class="checkbox">
                <input type="checkbox" class="indexers" id="<?php echo e($result->id); ?>" name="checkbox[]">
                <label class="checkbox-view" for="checkbox1"></label>
            </span>
        </td>
        <?php endif; ?>
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($column->closure)): ?>
                <?php if($column->closure == true): ?>
                    <td><?php echo $column->render($result); ?></td>
                <?php endif; ?>
            <?php else: ?>
                <td><?php echo e($column->render($result)); ?></td>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($actions)): ?>
            <td class="action">
                <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a
                        href="<?php echo e(route($action['route'], $result->id)); ?>"
                        class="Action-<?php echo e($action['type']); ?>"
                        id="<?php echo e($result->id); ?>"
                        <?php if(isset($action['confirm_text'])): ?>
                            onclick="return confirm_click('<?php echo e($action['confirm_text']); ?>');"
                        <?php endif; ?>
                        >
                        <i
                        <?php if(isset($action['icon-alt'])): ?>
                            title="<?php echo e($action['icon-alt']); ?>"
                        <?php endif; ?>
                        class="<?php echo e($action['icon']); ?>"></i>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>