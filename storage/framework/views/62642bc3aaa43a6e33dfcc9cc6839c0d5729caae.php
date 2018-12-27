<div class="<?php echo e($css->filter); ?> filter-wrapper">
    <div class="filter-row-one">
        <div class="search-filter" style="display: inline-flex; align-items: center;">
            <input type="search" class="control search-field" placeholder="Search Here..." value="" />
            <div class="ic-wrapper">
                <span class="icon search-icon search-btn"></span>
            </div>
        </div>
        <div class="dropdown-filters">
            <div class="column-filter" style="display: none;">
                <div class="dropdown-list bottom-right">
                    <div class="dropdown-container">
                        <ul>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li data-name="<?php echo e($column->alias); ?>">
                                <?php echo e($column->label); ?>

                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="more-filters">
                <div class="dropdown-toggle">
                    <div class="dropdown-header">
                        <span class="name">Filter</span>
                        
                        <i class="icon arrow-down-icon active"></i>
                    </div>
                </div>
                <div class="dropdown-list bottom-right" style="display: none;">
                    <div class="dropdown-container">
                        <ul>
                            <li class="filter-column-dropdown">
                                <select class="filter-column-select">
                                    <option selected disabled>Select Column</option>
                                    <?php $__currentLoopData = $filterable; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fcol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($fcol['alias']); ?>" data-type="<?php echo e($fcol['type']); ?>" data-label="<?php echo e($fcol['label']); ?>"><?php echo e($fcol['label']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </li>
                            
                            <li class="filter-condition-dropdown-string">
                                <select class="control filter-condition-select-string">
                                    <option selected disabled value="">Select Condition</option>
                                    <option value="like">Contains</option>
                                    <option value="nlike">Does not contains</option>
                                    <option value="eq">Is equal to</option>
                                    <option value="neqs">Is not equal to</option>
                                </select>
                            </li>

                            
                            <li class="filter-condition-dropdown-number">
                                <select class="control filter-condition-select-number">
                                    <option selected disabled value="">Select Condition</option>
                                    <option value="eq">Is equal to</option>
                                    <option value="neqs">Is not equal to</option>
                                    <option value="gt">Greater than</option>
                                    <option value="lt">Less than</option>
                                    <option value="gte">Greater than equals to</option>
                                    <option value="lte">Less than equals to</option>
                                </select>
                            </li>

                            
                            <li class="filter-condition-dropdown-boolean">
                                <select class="control filter-condition-select-boolean">
                                    <option selected disabled value="">Select Condition</option>
                                    <option value="eq">Is equal to</option>
                                    <option value="neqs">Is no equal to</option>
                                </select>
                            </li>

                            
                            <li class="filter-condition-dropdown-datetime">
                                <select class="control filter-condition-select-datetime">
                                    <option selected disabled value="">Select Condition</option>
                                    <option value="eq">Is equal to</option>
                                    <option value="neqs">Is not equal to</option>
                                    <option value="gt">Greater than</option>
                                    <option value="lt">Less than</option>
                                    <option value="gte">Greater than equals to</option>
                                    <option value="lte">Less than equals to</option>
                                    
                                </select>
                            </li>

                            
                            <li class="filter-response-string">
                                <input type="text" class="control response-string" placeholder="String Value here" value=""/>
                            </li>

                            <li class="filter-response-boolean">
                                <select class="control response-boolean">
                                    <option selected disabled>Select Value</option>
                                    <option value="1">True / Active</option>
                                    <option value="0">False / Inactive</option>
                                </select>
                            </li>

                            <li class="filter-response-datetime">
                                
                                <input type="date" class="control response-datetime" placeholder="Date value here" />
                            </li>

                            <li class="filter-response-number">
                                <input type="text" class="control response-number" placeholder="Numeric Value here" value="" />
                            </li>

                            <li>
                                <button class="btn btn-sm btn-primary apply-filter">Apply</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-row-two">
        
    </div>
</div>