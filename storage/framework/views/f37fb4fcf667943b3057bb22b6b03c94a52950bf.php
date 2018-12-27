<?php if($categories->count()): ?>
<accordian :title="'<?php echo e(__($accordian['name'])); ?>'" :active="true">
    <div slot="body">
        
        <tree-view behavior="normal" value-field="id" name-field="categories" input-type="checkbox" items='<?php echo json_encode($categories, 15, 512) ?>' value='<?php echo json_encode($product->categories->pluck("id"), 15, 512) ?>'></tree-view>

    </div>
</accordian>
<?php endif; ?>