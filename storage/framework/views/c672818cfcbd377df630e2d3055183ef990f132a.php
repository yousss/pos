<?php echo view_render_event('bagisto.shop.layout.header.category.before'); ?>


<category-nav categories='<?php echo json_encode($categories, 15, 512) ?>' url="<?php echo e(url()->to('/')); ?>"></category-nav>

<?php echo view_render_event('bagisto.shop.layout.header.category.after'); ?>