
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="<?php echo e(asset('calender/date-picker.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('ImageSelector/style.css')); ?>">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php $__env->startSection('content'); ?>
<style>
    .dropdown-menu {
        padding: 0 !important;
        width: 30px !important;
        ;
    }

    .dropdown-menu.inner {
        /* Set a fixed width for the dropdown menu */
        width: 200px;
        /* Enable text wrapping */
        white-space: normal;
        /* Define the maximum height for the dropdown menu */
        max-height: 200px;
        /* Enable vertical scrolling if the content overflows */
        overflow-y: auto;
    }

    /* Target the inner anchor tags within the dropdown-menu inner */
    .dropdown-menu.inner a {
        /* Set the display property to block to enable horizontal wrapping */
        display: block;
        /* Add some padding for better appearance */
        padding: 5px;
    }

    /* Target the text spans within the anchor tags */
    .dropdown-menu.inner a .text {
        /* Set the maximum width to control the wrapping */
        max-width: 150px;
        /* Adjust this value as needed */
        /* Enable text wrapping */
        white-space: normal;
    }

    .option-limit-length {
        max-width: 200px;
        /* Adjust the maximum width as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }





    /*  */

    .selected-tag {
        display: inline-block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
    }

    .selected-tag .close-icon {
        cursor: pointer;
        margin-left: 5px;
    }

    /* Hide all options in the select box */
    #tagsSelect option {
        display: none;
    }

    /* Hide selected options in the select box */
    /* #tagsSelect option:checked {
        display: none;
    } */


    #selectedTagsContainer {
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-size: 13px;
        ;
        color: #303030;
        line-height: 20px;
        ;
        font-weight: 400;
    }


    .selected-tag {
        display: inline-block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f0f0f0;
    }

    .selected-tag .close-icon {
        cursor: pointer;
        font-size: 16px;
        /* Increase the cross icon size */
        margin-left: 5px;
    }

    /* Hide all options in the select box */
    #tagsSelect option {
        display: none;
    }

    /* Proper styling for the selectedTagsContainer */
    #selectedTagsContainer {
        margin-top: 10px;
    }
    .media_style {
        border: 2px dashed grey;
                padding: 30px; /* Set padding from inside the border */
    }

    /* Optional: Add some styling for the selected tags container */
</style>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-end" style="z-index: 12;">
                <?php if(session('create_message')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('create_message')); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <form action="<?php echo e(url('/store')); ?>" method="POST" id="hiddenForm" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-8 rounded">
                    <div class="card shadow-lg  p-3  bg-white cards">
                        <div class="form-group">
                            <label class="title">Title</label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="Product Title" style="border: 1px solid black; border-radius: 5px;">
                        </div>
                        <span class="mt-1 mb-2">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>

                        <div class="form-group">
                            <label class="title">Description</label>
                            <textarea class="form-control" name="summernote" id="summernote"></textarea>
                        </div>
                        <span class=" mb-2">
                            <?php $__errorArgs = ['summernote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>

                    <div class="card shadow-lg  p-3 bg-white rounded">
                        <div class="form-group">
                            <div class="d-flex justify-content-start">
                                <label class="media ml-2">Media</strong></label><i class="dripicons-question ml-2" data-toggle="tooltip" title="<?php echo e(trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')); ?>"></i>
                            </div>
                            <input type="hidden" name="image_count" class="image_count">
                            <!-- <div id="imageUpload" class="dropzone"></div>
                            <span class="validation-msg" id="image-error"></span> -->
                            <div class="media_style"> 
                                <input type="file" id="file-input" name="pro_image[]" onchange="preview()" multiple>
                                <label for="file-input" class="multi_image_select">
                                    <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                                </label>
                                <p id="num-of-files" class="text-center mt-2">No Files Chosen</p>
                            <div id="images" class="d-flex justify-content-start"></div>    
                            </div>
                            
                        </div>
                        <input type="hidden" id="image-count" name="image_count" value="0">
                        <span class=" mb-2">
                            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </span>
                    </div>



                    <div class="card shadow-lg  p-3 bg-white cards">
                        <label for="" class="pricing">Pricing</label>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="title">Price</label>
                                <input type="text" class="form-control price" name="price" id="fields" placeholder="Enter amount" aria-label="Amount" oninput="getValue()" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="title">Compare-at-price</label>
                                <input type="text" class="form-control comp_price" name="comp_price" value="<?php echo e(old('comp_price')); ?>" id="fields" placeholder="Enter amount" oninput="getValue()" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['comp_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="taxCharge">
                            <label class="custom-control-label taxChange" id="taxId" style="margin-top: 1px;" oninput="getValue()" for="taxCharge" onclick="toggleTax()">Change Tax on this product</label>
                        </div>
                        <div class="form-row" id="pro_mar" style="display: none;">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4" class="cost">Cost per item</label>
                                <input type="text" class="form-control cost_per_item" value="<?php echo e(old('per_item_cost')); ?>" name="per_item_cost" id="fields" oninput="getValue()" placeholder="Enter amount" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['per_item_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4" class="profit">Profit</label>
                                <input type="text" class="form-control profit_value" id="fields" value="<?php echo e(old('product_profit')); ?>" name="product_profit" placeholder="Enter amount" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['product_profit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4" class="margin">Margin</label>
                                <input type="text" class="form-control margin_value" id="fields" value="<?php echo e(old('product_margin')); ?>" name="product_margin" placeholder="Enter amount" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['product_margin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow-lg  p-3  bg-white cards">
                        <label for="" class="Inventory">Inventory</label>
                        <div class="custom-control custom-checkbox mb-3 mt-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label track " style="margin-top: 1px;" for="customCheck1" id="toggleQuantityCheck" onclick="toggleQuantityField()">Track Quantity</label>
                        </div>
                        <div id="toggle_quantity" style="display: none;">
                            <div>
                                <label for="" class="Quantity">Quantity</label>
                            </div>
                            <hr />

                            <div class="form-row d-flex justify-content-between">
                                <div class="form-group col-md-3">
                                    <label for="inputPassword4" id="borough">15 Marlborough</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="number" class="form-control" placeholder="0" value="<?php echo e(old('product_quantity')); ?>" name="product_quantity" id="quantityField" style="border: 1px solid black; border-radius: 5px;">
                                    <span class=" mb-2">
                                        <?php $__errorArgs = ['product_quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </span>
                                </div>
                            </div>


                            <div class="custom-control custom-checkbox mb-1 mt-2">
                                <input type="checkbox" class="custom-control-input" onclick="toggleStockField()" id="customCheck2">
                                <label class="custom-control-label contSelling" for="customCheck2" style="margin-top: 1px;">Continue Selling When Out Of Stock</label>
                                <p class=" mt-1" id="stock_out">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium.</p>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox mb-3 mt-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck3" onclick="toggleBarcodeField()">
                            <label class="custom-control-label sku" for="customCheck3" style="margin-top: 1px;;">This Product has a SKU or barcode</label>
                        </div>
                        <div class="form-row" id="barcode">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="sku">SKU (Stock Keeping Unit)</label>
                                <input type="text" class="form-control" id="currencyInput" value="<?php echo e(old('sku_input')); ?>" name="sku_input" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['sku_input'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="Barcode">Barcode (ISBN, UCP, GTIN, etc)</label>
                                <input type="text" class="form-control" id="currencyInput" name="bar_code" value="<?php echo e(old('bar_code')); ?>" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['bar_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-lg p-3 bg-white cards">
                        <label for="" class="shipping">Shipping</label>
                        <div class="custom-control custom-checkbox mb-3 mt-2">
                            <input type="checkbox" class="custom-control-input" id="shipping" onclick="toggleShippingField()">
                            <label class="custom-control-label" for="shipping" id="req_shipping" style="margin-top: 1px;">This Product require Shipping</label>
                        </div>
                        <div class=" form-group col-md-4" id="shipping_field">
                            <label for="" class="Weight ">Weight</label>
                            <div class="d-flex">
                                <input type="number" class="form-control" value="<?php echo e(old('weight')); ?>" id="currencyInput" name="weight" aria-label="Amount" step="0.01" style="border: 1px solid black; border-radius: 5px;">
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                                <select class="form-select border ml-2" value="<?php echo e(old('weight_unit')); ?>" style="border-radius: 10px !important;" name="weight_unit" aria-label="Default select example" id="weight_type">
                                    <option value="" disabled hidden>Choose Unit</option>
                                    <option value="1">Kg</option>
                                    <option value="2">lg</option>
                                    <option value="3">oz</option>
                                    <option value="4">g</option>
                                </select>
                                <span class=" mb-2">
                                    <?php $__errorArgs = ['weight_unit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </span>
                            </div>
                        </div>
                        <hr class="divider">
                        <a class="text-primary more_opt" id="custom_info" onclick="toggleCustomField()"> + Add custom Information</a>
                        <div class="form-group" id="custom_info_div" style="display: none;">
                            <div class="mb-2">
                                <span class="cus_info">Custom Information</span>
                                <br>
                                <span class="int_order">Printed on custom forms or shipping labels for international orders</span>
                            </div>
                            <div class="form-group">
                                <label class="Country">Country</label>
                                <div>
                                    <select class="form-select border w-100" name="country" value="<?php echo e(old('country')); ?>" aria-label="Default select example">
                                        <option value="" disabled hidden>Choose Country</option>
                                        <option value="1">Pakistan</option>
                                        <option value="2">India</option>
                                        <option value="3">China</option>
                                        <option value="4">England</option>
                                    </select>
                                    <!-- <span class=" mb-2">
                                        <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </span > -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="HS">HS (Harmonized System)</label>
                                <input name="harmonized_system" type="search" value="<?php echo e(old('harmonized_system')); ?>" placeholder="Search Here" class="form-control" style="border: 1px solid black; border-radius: 5px;">
                                <!-- <span class=" mb-2">
                                        <?php $__errorArgs = ['harmonized_system'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                         <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </span > -->
                            </div>
                        </div>
                    </div>


                    <!-- <div class="card shadow-lg p-3  bg-white cards">
                        <label for="" class="Variants ">Variants</label>
                        <hr class="divider mt-1">
                        <div class="col-md-12" id="variant-section" style="display: none;">
                            <div class="row" id="variant-input-section">
                                <div class="col-md-12 form-group mt-2">
                                    <label>Option Name</label>
                                    <input type="text" name="variant_option[]" class="form-control variant-field" placeholder="Size, Color etc...">
                                    <span class=" mb-2">
                                        <?php $__errorArgs = ['variant_option'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </span>
                                </div>
                                <div class="col-md-12 form-group ">
                                    <label>Option Value</label>
                                    <input type="text" name="variant_value[]" id="var_option_value" class="type-variant form-control variant-field">
                                    <span class=" mb-2">
                                        <?php $__errorArgs = ['variant_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="hideNAppend()" class="btn border text-black bg-light mb-1 ml-3" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border-radius: 5px;">Done</button>
                                </div>
                            </div>
                            <hr class="divider">
                        </div>
                        <a class="text-primary mt-2 mb-2 add-more-variant" id="add-variant-btn"> + Add Option like size or color</a>

                        <div class="variants_table mt-2" style="display: none;">
                            <hr class="divider">
                            <div class=" table-responsive">
                                <table id="variant-table" class="table variant-list varOption">
                                    <thead>
                                        <tr class=" text-center">
                                            <th>Variant</th>
                                            <th>Price</th>
                                            <th>Available</th>
                                            <th>On hand</th>
                                            <th>Sku</th>
                                            <th>Barcode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table_body text-center">
                                            <td class="variantOptionValue"></td>
                                            <td>
                                                <input type="text" class="form-control" name="var_price" id="var_price"  style="border: 1px solid black; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="var_available"  style="border: 1px solid black; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="var_on_hand"  style="border: 1px solid black; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="var_sku"  style="border: 1px solid black; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="var_barcode"  style="border: 1px solid black; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <button type="button" class="btn border text-black bg-light " style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border-radius: 5px;"><i class="fa-solid fa-trash-can"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> -->

                    <div class="card shadow-lg p-3  bg-white cards">
                        <label for="" class="Variants ">Variants</label>
                        <div class="form-group">
                            <input type="text" id="priceInput" name="var_name" class="form-control mt-2" placeholder="Enter Variants Name...">
                        </div>
                        <div class="form-group">
                            <input type="text" id="variantInput" name="var_values" class="form-control mt-3 mb-2">
                        </div>
                        <div class="form-group">
                            <button class="btn mt-2 variant_btn" type="button" onclick="addToTable()">Add to Table</button>
                        </div>
                        <div class=" table-responsive" id="show_table" style="display: none;">
                            <table id="dataTable" class="table table-bordered mt-4 custom-table">
                                <tr>
                                    <th>Variant</th>
                                    <th>Price</th>
                                    <th>Available</th>
                                    <th>On hand</th>
                                    <th>Sku</th>
                                    <th>Barcode</th>
                                    <th>Action</th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow-lg  p-3 bg-white cards">
                        <div class="form-group ">
                            <div class="d-flex justify-content-between">
                                <h5 class="search_eng">Search Engine Listing</h5>
                                <a href="#" class="edit_search">Edit</a>
                            </div>
                            <!-- <div> -->
                            <span class="little_desc">Add a little description below to see how this product might appear in the search engine listing</span>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 ">
                    <div class="card shadow-sm p-3  bg-white cards">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="card-title status">Status</label>
                                <div>
                                    <select class="form-select border w-100" name="save_status">
                                        <option value="" disabled hidden>Choose Status</option>
                                        <option value="Active" class="text"> Active</option>
                                        <option value="Inactive" class="text">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <span class=" mb-2">
                                <?php $__errorArgs = ['save_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" name="startDate" id="sch_start_date">
                    <input type="hidden" name="endDate" id="sch_end_date">
                    <!--  Modal  -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog w-50" role="document">
                            <div class="modal-content">
                                <div class="modal-header card-header">
                                    <h5 class="modal-title sch_online " id="exampleModalLabel">Schedule Online Store Before Publishing</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="">Start Date</label>
                                            <input type="text" id="start_date" name="starting_date" class="date-picker form-control" value="<?php echo e(old('starting_date')); ?>" />
                                            <!-- <input type="date" id="start_date" class="form-control" /> -->
                                        </div>
                                        <span class=" mb-2">
                                            <?php $__errorArgs = ['starting_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                        <div class="col-lg-6">
                                            <label for="">End Time</label>
                                            <input type="text" id="end_date" name="ending_date" class="date-picker form-control" value="<?php echo e(old('ending_date')); ?>" />
                                        </div>
                                        <span class=" mb-2">
                                            <?php $__errorArgs = ['ending_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light text-dark " data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-dark text-white schedule_date">Schedule Publishing</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->

                    <div class="card shadow-sm p-3  bg-white cards">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label class="card-title Publishing">Publishing</label>
                                    <a href="#" style="margin-top: -1px;;" class="text">Manage<i class="fas fa-chevron-down down-arrow"></i></a>
                                </div>
                                <!-- <ul > -->
                                <div>
                                    <ul class="list-unstyled d-flex justify-content-between align-items-center">
                                        <li>
                                            <span class="text Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Online Store</span>
                                        </li>
                                        <li>
                                            <img src="<?php echo e(asset('icons/datetime.png')); ?>" alt="" width="20px" height="20px" class="" data-toggle="modal" data-target="#exampleModal">
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <span class="Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Point of Sale and POS</span>
                                        </li>

                                        <li class="mb-3">
                                            <span class="Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Shop</span>
                                            <div style="margin-left: 19px;"><span class="text-black text">Shop has noticed your store does't meet store requirement</span>
                                                <a href="#" class="learnMore">Learn More</a>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <span class="Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Facebook & Instagram</span>
                                            <div style="margin-left: 19px;"><span class="text-black text">Shop has noticed your store does't meet store requirement</span>
                                                <a href="#" class="learnMore">Learn More</a>
                                            </div>
                                        </li>

                                        <li class="mb-3">
                                            <span class="text Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Markets</span>
                                            <div style="margin-left: 19px;"><span class="text-black text">Shop has noticed your store does't meet store requirement</span>
                                                <a href="#" class="text">Learn More</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <!-- </ul> -->
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm p-3 bg-white cards">
                        <div class="card-body">

                            <label class="card-title pro_org">Product Organization</label>
                            <div class="form-group">
                                <label for="" class="product">Product Category</label>

                                <select class="form-select border w-100" aria-label="Default select example" name="prod_category" value="<?php echo e(old('prod_category')); ?>" style="border: 1px solid black; border-radius: 5px;">
                                    <option value="" disabled hidden>Choose Category</option>
                                    <?php $__currentLoopData = $lims_category_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lims_category_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lims_category_list->id); ?>"><?php echo e($lims_category_list->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['prod_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                            </div>
                            <div class="form-group">
                                <label for="" class="product">Product Type</label>
                                <!-- <input type="text" class="form-control" name="prod_type" style="border: 1px solid black; border-radius: 5px;"> -->
                                <select class="form-select border w-100" aria-label="Default select example" name="prod_type" value="<?php echo e(old('prod_type')); ?>" style="border: 1px solid black; border-radius: 5px;">
                                    <option value="" disabled hidden>Choose Type</option>
                                    <option value="Product Type 1">Product Type 1</option>
                                    <option value="Product Type 2">Product Type 2</option>
                                </select>
                                <?php $__errorArgs = ['prod_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="" class="product">Vendor</label>
                                <select class="form-select border w-100" aria-label="Default select example" name="prod_vendor" value="<?php echo e(old('prod_vendor')); ?>" style="border: 1px solid black; border-radius: 5px;">
                                    <option value="" disabled hidden>Choose Vendor</option>
                                    <option value="Pakistan Fashion Lounge">Pakistan Fashion Lounge</option>
                                    <!-- Add more option elements for other tags if needed -->
                                </select>
                                <?php $__errorArgs = ['prod_vendor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <!-- <input type="text" class="form-control" name="prod_vendor" style="border: 1px solid black; border-radius: 5px;"> -->
                            </div>
                            <span class="coll_error">There are no collection available to add this product to. You can add a new collection or modify your existing collection </span>
                            <!-- <div class="form-group">
                                <div class="row d-flex justify-content-between ">
                                    <label for="" class="ml-3" class="product">Tags</label><a href="#" class="mr-4">Manage</a>
                                </div>
                                <div>
                                    <select class="form-select border w-100 flex-wrap" name="tags[]" multiple data-live-search="true" data-size="5">
                                        <option value="" disabled hidden>Choose Tags</option>
                                        <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tag->title); ?>" class="flex-wrap option-limit-length"><?php echo e($tag->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="row d-flex justify-content-between">
                                    <label for="" class="ml-3" class="product">Tags</label><a href="#" class="mr-4 manage">Manage</a>
                                </div>
                                <div>
                                    <select class="form-select border w-100 flex-wrap" name="tags[]" multiple data-live-search="true" data-size="5" id="tagsSelect">
                                        <option value="" disabled hidden>Choose Tags</option>
                                        <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($tag->title); ?>" class="flex-wrap option-limit-length"><?php echo e($tag->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div id="selectedTagsContainer" style="border: 5px;"></div>


                        </div>
                    </div>

                    <div class="card shadow-sm p-3 bg-white cards">
                        <div class="card-body">
                            <label class="card-title on_store">Online Store</label>
                            <div class="form-group">
                                <span for="" class="template">Theme Template</span>
                                <div>
                                    <select class="form-select border w-100" name="pro_theme" aria-label="Default select example" style="border: 1px solid black; border-radius: 5px;">
                                        <option value="">Default Product</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn border text-white mt-2 bg-dark d-flex justify-content-end" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border-radius: 5px;">Save</button>
            </div>
        </form>
    </div>

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('tagsSelect');
            const selectedTagsContainer = document.getElementById('selectedTagsContainer');

            select.addEventListener('change', function() {
                const selectedOptions = Array.from(select.selectedOptions);

                // Clear the selected tags container
                selectedTagsContainer.innerHTML = '';

                // Populate the selected tags container with the selected options
                selectedOptions.forEach(function(option) {
                    const selectedTag = document.createElement('div');
                    selectedTag.className = 'selected-tag';
                    selectedTag.innerText = option.value;

                    const closeIcon = document.createElement('span');
                    closeIcon.className = 'close-icon';
                    closeIcon.innerHTML = '&times;';
                    closeIcon.addEventListener('click', function() {
                        // Remove the selected option when the close icon is clicked
                        select.add(option);
                        selectedTagsContainer.removeChild(selectedTag);
                    });

                    selectedTag.appendChild(closeIcon);
                    selectedTagsContainer.appendChild(selectedTag);
                });
            });
        });
















        function toggleTax() {
            var checkbox = document.getElementById("taxId");
            var quantityField = document.getElementById("pro_mar");

            checkbox.checked == checkbox.checked ? quantityField.style.display = "flex" : quantityField.style.display = "none";
            // if (checkbox.checked) {
            //     quantityField.style.display = "flex";
            // } if(!checkbox.checked) {
            //     quantityField.style.display = "none";
            // }
        }



        // function addToTable() {
        //     const variantTable = document.getElementById('show_table');
        //     variantTable.style.display = "flex"
        //     const variantInput = document.getElementById('variantInput');
        //     const variant = variantInput.value;
        //     const priceInput = document.getElementById('priceInput');
        //     const price = priceInput.value;

        //     if (variant.trim() !== '' && price.trim() !== '') {
        //         const table = document.getElementById('dataTable');
        //         const newRow = table.insertRow(-1);

        //         for (let i = 0; i < 6; i++) {
        //             const newCell = newRow.insertCell(i);

        //             if (i === 0) {
        //                 newCell.innerHTML = variant;
        //             } else if (i === 1) {
        //                 const proPrice = document.querySelector('.price').value;
        //                 newCell.innerHTML = proPrice;
        //             } else {
        //                 newCell.contentEditable = false;
        //             }
        //         }

        //         const actionCell = newRow.insertCell(6);
        //         actionCell.innerHTML = '<button class="btn edit_btn" type="button"  onclick="editRow(this)">Edit</button>';

        //         // Clear input fields after adding to the table
        //         variantInput.value = '';
        //         priceInput.value = '';
        //     }
        // }

        function addToTable() {
            const variantTable = document.getElementById('show_table');
            variantTable.style.display = "flex";

            const variantInput = document.getElementById('variantInput');
            const variant = variantInput.value;
            const priceInput = document.getElementById('priceInput');
            const price = priceInput.value;

            if (variant.trim() !== '' && price.trim() !== '') {
                const table = document.getElementById('dataTable');
                const newRow = table.insertRow(-1);

                for (let i = 0; i < 6; i++) {
                    const newCell = newRow.insertCell(i);

                    if (i === 0) {
                        newCell.innerHTML = variant;
                    }
                    // else if (i === 1) {
                    //     newCell.innerHTML = price;
                    // }
                    else {
                        newCell.contentEditable = false;
                    }
                }

                const actionCell = newRow.insertCell(6);
                actionCell.innerHTML = '<button class="btn edit_btn" type="button"  onclick="editRow(this)">Edit</button>';

                // Clear input fields after adding to the table
                variantInput.value = '';
                priceInput.value = '';
            }
        }

        function editRow(button) {
            const row = button.parentNode.parentNode;
            const cells = row.cells;

            // Toggle the editable state for the cells (start from index 2 to skip Variant and Price columns)
            for (let i = 1; i < cells.length - 1; i++) {
                cells[i].contentEditable = true;
            }

            // Change the button to a Save button
            button.innerHTML = 'Save';
            button.onclick = function() {
                saveRow(this);
            };
        }

        function saveRow(button) {
            const row = button.parentNode.parentNode;
            const cells = row.cells;

            // Toggle the editable state for the cells (start from index 2 to skip Variant and Price columns)
            for (let i = 2; i < cells.length - 1; i++) {
                cells[i].contentEditable = false;
            }

            // Change the button back to an Edit button
            button.innerHTML = 'Edit';
            button.onclick = function() {
                editRow(this);
            };

            const variant = cells[0].innerHTML;
            const price = cells[1].innerHTML;
            const available = cells[2].innerHTML;
            const onHand = cells[3].innerHTML;
            const sku = cells[4].innerHTML;
            const barcode = cells[5].innerHTML;

            // Create a unique index for the row
            const rowIndex = row.rowIndex;

            // Update the hidden form with the data from the row
            updateHiddenInput('variant', variant, rowIndex);
            updateHiddenInput('price', price, rowIndex);
            updateHiddenInput('available', available, rowIndex);
            updateHiddenInput('onHand', onHand, rowIndex);
            updateHiddenInput('sku', sku, rowIndex);
            updateHiddenInput('barcode', barcode, rowIndex);
        }

        function updateHiddenInput(name, value, rowIndex) {
            const inputName = `${name}[${rowIndex}]`;
            const inputField = document.createElement('input');
            inputField.type = 'hidden';
            inputField.name = inputName;
            inputField.value = value;
            document.getElementById('hiddenForm').appendChild(inputField);
        }

        // Variants Ends Here




        // Variants Code Start
        var variantPlaceholder = <?php echo json_encode(trans('file.Enter variant value seperated by comma')); ?>;
        var variantIds = [];
        var combinations = [];
        var oldCombinations = [];
        var oldAdditionalCost = [];
        var oldAdditionalPrice = [];
        var step;
        var numberOfWarehouse = <?php echo json_encode(count($lims_warehouse_list)) ?>;

        $('[data-toggle="tooltip"]').tooltip();


        $('.add-more-variant').on("click", function() {
            var variantListElement = document.getElementById("variant-section");
            if (variantListElement.style.display === "none") {
                variantListElement.style.display = "block";
            } else {
                var tableRow = '<tr class="table_body  text-center"><td class="variantOptionValue"></td><td>    <input type="text" class="form-control" name="var_price" id="var_price" value="<?php echo e(old("var_price")); ?>" style="border: 1px solid black; border-radius: 5px;"></td><td>    <input type="text" class="form-control" name="var_available" value="<?php echo e(old("var_available")); ?>" style="border: 1px solid black; border-radius: 5px;"></td><td>    <input type="text" class="form-control" name="var_on_hand" value="<?php echo e(old("var_on_hand")); ?>" style="border: 1px solid black; border-radius: 5px;"></td><td>    <input type="text" class="form-control" name="var_sku" value="<?php echo e(old("var_sku")); ?>" style="border: 1px solid black; border-radius: 5px;"></td><td>    <input type="text" class="form-control" name="var_barcode" value="<?php echo e(old("var_barcode")); ?>" style="border: 1px solid black; border-radius: 5px;"></td><td>    <button type="button" class="btn border text-black bg-light " style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border-radius: 5px;"><i class="fa-solid fa-trash-can"></i></button></td</tr>'
                $("#variant-table tbody").append(tableRow);
                var htmlText = '<div class="col-md-12 form-group mt-2"><label>Option *</label><input type="text" name="variant_option[]" class="form-control variant-field" placeholder="Size, Color etc..."></div><div class="col-md-12 form-group mt-2"><label>Value *</label><input type="text" name="variant_value[]" class="type-variant form-control variant-field"></div><div class="form-group"><button type="button" onclick="hideNAppend()" class="btn border text-black bg-light mb-1 ml-3" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border-radius: 5px;">Done</button></div>';
                $("#variant-input-section").append(htmlText);
                $('.type-variant').tagsInput();

            }

        });
        // Variants Code End


        function toggleQuantityField() {
            var checkbox = document.getElementById("toggleQuantityCheck");
            var quantityField = document.getElementById("toggle_quantity");

            if (checkbox.checked) {
                quantityField.style.display = "block";
            } else {
                quantityField.style.display = "none";
            }
        }

        function toggleStockField() {
            var checkbox = document.getElementById("customCheck2");
            var quantityField = document.getElementById("stock_out");

            if (checkbox.checked) {
                quantityField.style.display = "none";
            } else {
                quantityField.style.display = "block";
            }
        }

        function toggleBarcodeField() {
            var checkbox = document.getElementById("customCheck3");
            var barcodeFields = document.getElementById("barcode");

            if (checkbox.checked) {
                barcodeFields.style.display = "flex";
            } else {
                barcodeFields.style.display = "none";
            }
        }

        function toggleShippingField() {
            var checkbox = document.getElementById("shipping");
            var shippingFields = document.getElementById("shipping_field");

            if (checkbox.checked) {
                shippingFields.style.display = "block";
            } else {
                shippingFields.style.display = "none";
            }
        }

        function toggleCustomField() {
            var customInfoElement = document.getElementById("custom_info");
            var jsCodeBlock = document.getElementById("custom_info_div");
            if (jsCodeBlock.style.display === "none") {
                customInfoElement.style.display = "none";
                jsCodeBlock.style.display = "block";
            } else {
                jsCodeBlock.style.display = "none";
            }
        }

        function toggleVariant() {
            var variantsDiv = document.getElementById("variants_div");
            if (variantsDiv.style.display === "none") {
                variantsDiv.style.display = "block";
            } else {
                variantsDiv.style.display = "none";
            }
        }

        function belowField() {
            var extraOption = document.getElementById("extraOption");
            extraOption.style.display = "block";
        }

        function getValue() {
            var price = parseFloat(document.querySelector(".price").value);
            var cost = parseFloat(document.querySelector(".cost_per_item").value);
            var profit = price - cost;
            var price = parseFloat(document.querySelector(".price").value);
            var cost = parseFloat(document.querySelector(".cost_per_item").value);
            var profit = price - cost;

            if (profit > 1) {
                document.querySelector('.profit_value').value = profit;
                var margin = (profit / price) * 100;
                document.querySelector('.margin_value').value = margin.toFixed(2) + '%';
            } else {
                document.querySelector('.profit_value').value = "";
                document.querySelector('.margin_value').value = "";
            }

            // const margin = ((price - cost) / cost) * 100;
            // document.querySelector(".margin").value = margin;

        }

        //  Schedule Date 
        $('.schedule_date').on('click', function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            $('#sch_start_date').val(startDate);
            $('#sch_end_date').val(endDate);

            $('#exampleModal').modal('hide');
        });



        let fileInput = document.getElementById("file-input");
        let imageContainer = document.getElementById("images");
        let numOfFiles = document.getElementById("num-of-files");
        let imageCountInput = document.getElementById("image-count");

        function preview() {
            // Clear the existing images before adding new ones
            imageContainer.innerHTML = "";

            let imageFiles = [];
            for (let i = 0; i < fileInput.files.length; i++) {
                if (fileInput.files[i].type.startsWith('image/')) {
                    imageFiles.push(fileInput.files[i]);
                }
            }

            numOfFiles.textContent = `${imageFiles.length} Images Selected`;

            imageCountInput.value = imageFiles.length; // Update the image_count hidden input field

            for (let i = 0; i < imageFiles.length; i++) {
                let image = imageFiles[i];
                let reader = new FileReader();
                let figure = document.createElement("figure");

                // Create an input field to hold the image index
                let indexInput = document.createElement("input");
                indexInput.setAttribute("type", "hidden");
                indexInput.setAttribute("name", "imageIndex[]"); // Set the name attribute to an array
                indexInput.value = i; // Set the value to the image index
                figure.appendChild(indexInput);

                reader.onload = () => {
                    let img = document.createElement("img");
                    img.setAttribute("src", reader.result);
                    figure.appendChild(img);
                }
                imageContainer.appendChild(figure);
                reader.readAsDataURL(image);
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 400
        });
    </script>
    <script src="<?php echo e(asset('calender/date-picker.js')); ?>"></script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PFL\pfl\resources\views/backend/product/create.blade.php ENDPATH**/ ?>