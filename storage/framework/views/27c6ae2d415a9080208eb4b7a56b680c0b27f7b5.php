<?php $productViewHelper = app('Webkul\Product\Helpers\View'); ?>

<?php echo view_render_event('bagisto.shop.products.view.attributes.before', ['product' => $product]); ?>


<?php if($customAttributeValues = $productViewHelper->getAdditionalData($product)): ?>
    <accordian :title="'<?php echo e(__('shop::app.products.specification')); ?>'" :active="false">
        <div slot="header">
            <?php echo e(__('shop::app.products.specification')); ?>

            <i class="icon expand-icon right"></i>
        </div>

        <div slot="body">
            <table class="full-specifications">

                <?php $__currentLoopData = $customAttributeValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <tr>
                        <td><?php echo e($attribute['label']); ?></td>
                        <td><?php echo e($attribute['value']); ?></td>
                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </table>
        </div>
    </accordian>
<?php endif; ?>

<?php echo view_render_event('bagisto.shop.products.view.attributes.after', ['product' => $product]); ?>