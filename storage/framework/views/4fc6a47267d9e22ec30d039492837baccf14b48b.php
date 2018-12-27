<?php
    $validations = [];
    $disabled = false;

    if (isset($field['validation'])) {
        array_push($validations, $field['validation']);
    }

    $validations = implode('|', array_filter($validations));

    $key = $item['key'];
    $key = explode(".", $key);
    array_shift($key);
    $firstField = current($key);
    $secondField = next($key);
    $key = implode(".", $key);

    $name = $key . '.' . $field['name'];
?>

<div class="control-group <?php echo e($field['type']); ?>" :class="[errors.has('<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]') ? 'has-error' : '']">
    <label for="<?php echo e($name); ?>" <?php echo e(!isset($field['validation']) || strpos('required', $field['validation']) < 0 ? '' : 'class=required'); ?>>

        <?php echo e($field['title']); ?>


        <?php
            $channel_locale = [];

            if(isset($field['channel_based']) && $field['channel_based'])
            {
                array_push($channel_locale, $channel);
            }

            if(isset($field['locale_based']) && $field['locale_based']) {
                array_push($channel_locale, $locale);
            }
        ?>

        <?php if(count($channel_locale)): ?>
            <span class="locale">[<?php echo e(implode(' - ', $channel_locale)); ?>]</span>
        <?php endif; ?>

    </label>

    <?php if($field['type'] == 'text'): ?>

        <input type="text" v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]" value="<?php echo e(old($name) ?: core()->getConfigData($name)); ?>" data-vv-as="&quot;<?php echo e($field['name']); ?>&quot;">

    <?php elseif($field['type'] == 'textarea'): ?>

        <textarea v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]" data-vv-as="&quot;<?php echo e($field['name']); ?>&quot;"><?php echo e(old($name) ?: core()->getConfigData($name)); ?></textarea>

    <?php elseif($field['type'] == 'select'): ?>

        <select v-validate="'<?php echo e($validations); ?>'" class="control" id="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]" name="<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]" data-vv-as="&quot;<?php echo e($field['name']); ?>&quot;" >

            <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    if($option['value'] == false) {
                        $value = 0;
                    }else {
                        $value = $option['value'];
                    }

                    $selectedOption = core()->getConfigData($name) ?? '';
                ?>

                <option value="<?php echo e($value); ?>" <?php echo e($value == $selectedOption ? 'selected' : ''); ?>>
                    <?php echo e($option['title']); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

    <?php endif; ?>

    <span class="control-error" v-if="errors.has('<?php echo e($firstField); ?>[<?php echo e($secondField); ?>][<?php echo e($field['name']); ?>]')">{{ errors.first('<?php echo $firstField; ?>[<?php echo $secondField; ?>][<?php echo $field['name']; ?>]') }}</span>
</div>