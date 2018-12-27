<div class="tabs">
    <?php if(request()->route()->getName() != 'admin.configuration.index'): ?>

        <?php $keys = explode('.', $menu->currentKey);  ?>


        <?php if($items = array_get($menu->items, implode('.children.', array_slice($keys, 0, 2)) . '.children')): ?>
        
            <ul>

                <?php $__currentLoopData = array_get($menu->items, implode('.children.', array_slice($keys, 0, 2)) . '.children'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li class="<?php echo e($menu->getActive($item)); ?>">
                        <a href="<?php echo e($item['url']); ?>">
                            <?php echo e($item['name']); ?>

                        </a>
                    </li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
            </ul>

        <?php endif; ?>

    <?php else: ?>

        <?php if($items = array_get($config->items, request()->route('slug') . '.children')): ?>

            <ul>

                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li class="<?php echo e($key == request()->route('slug2') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.configuration.index', (request()->route('slug') . '/' . $key))); ?>">
                            <?php echo e($item['name']); ?>

                        </a>
                    </li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>

        <?php endif; ?>

    <?php endif; ?>
</div>