<accordian :title="'<?php echo e(__($accordian['name'])); ?>'" :active="true">
    <div slot="body">

    
        <image-wrapper :button-label="'<?php echo e(__('admin::app.catalog.products.add-image-btn-title')); ?>'" input-name="images" :images='<?php echo json_encode($product->images, 15, 512) ?>'></image-wrapper>

    </div>
</accordian>