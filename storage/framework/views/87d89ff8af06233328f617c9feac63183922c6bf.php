<div class="footer">
    <div class="footer-content">
        <div class="footer-list-container">

            <?php if(count($categories)): ?>
                <div class="list-container">
                    <span class="list-heading">Categories</span>

                    <ul class="list-group">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('shop.categories.index', $category->slug)); ?>"><?php echo e($category->name); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo DbView::make(core()->getCurrentChannel())->field('footer_content')->render(); ?>


            <div class="list-container">
                <span class="list-heading"><?php echo e(__('shop::app.footer.subscribe-newsletter')); ?></span>
                <div class="form-container">
                    <form action="<?php echo e(route('shop.subscribe')); ?>">
                        <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                            <input type="email" class="control subscribe-field" name="email" placeholder="Email Address" required><br/>

                            <button class="btn btn-md btn-primary"><?php echo e(__('shop::app.subscription.subscribe')); ?></button>
                        </div>
                    </form>
                </div>

                <span class="list-heading"><?php echo e(__('shop::app.footer.locale')); ?></span>
                <div class="form-container">
                    <div class="control-group">
                        <select class="control locale-switcher" onchange="window.location.href = this.value">

                            <?php $__currentLoopData = core()->getCurrentChannel()->locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="?locale=<?php echo e($locale->code); ?>" <?php echo e($locale->code == app()->getLocale() ? 'selected' : ''); ?>><?php echo e($locale->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>
                    </div>
                </div>

                <div class="currency">
                    <span class="list-heading"><?php echo e(__('shop::app.footer.currency')); ?></span>
                    <div class="form-container">
                        <div class="control-group">
                            <select class="control locale-switcher" onchange="window.location.href = this.value">

                                <?php $__currentLoopData = core()->getCurrentChannel()->currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="?currency=<?php echo e($currency->code); ?>" <?php echo e($currency->code == core()->getCurrentCurrencyCode() ? 'selected' : ''); ?>><?php echo e($currency->code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>