@extends('backend.layout.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('calender/date-picker.css')}}">
<link rel="stylesheet" href="{{asset('ImageSelector/style.css')}}">

<style>
    .form-control {
        background-color: white !important;
    }

    .form-check {
        padding-left: 0% !important;
    }

    .form-check-input {
        margin-top: 0.5rem !important;
    }

    #barcode,
    #shipping_field {
        display: none;
    }

    #weight_type {
        border-radius: 3px !important;
        ;
    }

    button.btn.dropdown-toggle.btn-default.btn-light {
        color: black !important;
        ;
        background-color: white !important;
    }

    span.dropdown-item-inner {
        color: black !important;

    }

    .dropdown-item.selected {
        color: black;

    }

    #custom_info:hover,
    #variants_option:hover,
    #add-variant-btn:hover {
        cursor: pointer;
        color: #0B5ED7 !important;
    }

    .divider {
        margin-top: -2px;

    }

    .form-group select {
        border-radius: 5px !important;

    }

    .cards {
        border-radius: 16px !important;
    }

    .custom-button {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        /* Add a shadow to the button */
        border: 1px solid #ced4da;
        /* Add a border to the button */
    }

    .down-arrow {
        margin-left: 5px;
        /* Add some space between the "Manage" link and the arrow */
        font-size: 14px;
        color: #666;
        /* Customize the color of the arrow */
    }

    .title,
    .cost,
    .profit,
    .margin,
    .track,
    .Quantity,
    .taxChange,
    .contSelling,
    #stock_out,
    .sku,
    .Barcode,
    #req_shipping,
    .Weight,
    .int_order,
    .Country,
    .HS,
    .opt_name,
    .opt_val,
    .more_opt,
    .little_desc,
    .text,
    .product,
    .Publishing_sub_cont,
    .coll_error,
    #add-variant-btn,
    #borough {
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-size: 13px;
        ;
        color: #303030;
        line-height: 20px;
        ;
        font-weight: 400;
    }

    .media,
    .pricing,
    .Inventory,
    .shipping,
    .Variants,
    .search_eng,
    .cus_info,
    .status,
    #sch_online,
    .pro_org,
    .on_store #exampleModalLabel,
    .Publishing {
        font-family: 'Inter', sans-serif;
        font-style: bold;
        font-weight: 600;
    }

    #fields {
        padding: 9px 14px 9px 40px;
        /* background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat 9px center; */
        background: transparent url('{{asset("svg/pound.svg")}}') no-repeat 9px center;
        /* background-image: url('{{asset("svg/pound.svg")}}'); Relative path example */
    }
</style>
@section('content')


<section>
    <div class="container-fluid">
        <form action="{{ url('store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-8 rounded">
                    <div class="card shadow-lg  p-3  bg-white cards">
                        <div class="form-group">
                            <label class="title">Title</label>
                            <input type="text" name="name" class="form-control" placeholder="Product Title" style="border: 1px solid black; border-radius: 5px;">
                        </div>
                        <span class="mt-1 mb-2">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span >

                        <div class="form-group">
                            <label class="title">Description</label>
                            <textarea class="form-control" name="summernote" id="summernote"></textarea>
                        </div>
                        <span class=" mb-2">
                            @error('summernote')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span >
                    </div>

                    <div class="card shadow-lg  p-3 bg-white rounded">
                        <div class="form-group">
                            <div class="d-flex justify-content-start">
                                <label class="media ml-2">Media</strong></label><i class="dripicons-question ml-2" data-toggle="tooltip" title="{{trans('file.You can upload multiple image. Only .jpeg, .jpg, .png, .gif file can be uploaded. First image will be base image.')}}"></i>
                            </div>
                            <input type="hidden" name="image_count" class="image_count">
                            <!-- <div id="imageUpload" class="dropzone"></div>
                            <span class="validation-msg" id="image-error"></span> -->
                            <input type="file" id="file-input" accept="image/png, image/jpeg" name="pro_image[]" onchange="preview()" multiple>
                            <label for="file-input" class="multi_image_select">
                                <i class="fas fa-upload"></i> &nbsp; Choose A Photo
                            </label>
                            <p id="num-of-files" class="text-center mt-2">No Files Chosen</p>
                            <div id="images"></div>
                        </div>
                        <input type="hidden" id="image-count" name="image_count" value="0">
                    </div>


                    <div class="card shadow-lg  p-3 bg-white cards">
                        <label for="" class="pricing">Pricing</label>
                        <div class="form-row mb-3">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="title">Price</label>
                                <input type="text" class="form-control price" name="price" id="fields" placeholder="Enter amount" aria-label="Amount" oninput="getValue()" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="title">Compare-at-price</label>
                                <input type="text" class="form-control comp_price" name="comp_price" id="fields" placeholder="Enter amount" oninput="getValue()" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="taxCharge">
                            <label class="custom-control-label taxChange" style="margin-top: 1px;" oninput="getValue()" for="taxCharge">Change Tax on this product</label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputPassword4" class="cost">Cost per item</label>
                                <input type="text" class="form-control cost_per_item" name="per_item_cost" id="fields" oninput="getValue()" placeholder="Enter amount" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4" class="profit">Profit</label>
                                <input type="text" class="form-control profit_value" id="fields" name="product_profit" placeholder="Enter amount" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4" class="margin">Margin</label>
                                <input type="text" class="form-control margin_value" id="fields" name="product_margin" placeholder="Enter amount" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">

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
                                    <input type="number" class="form-control" placeholder="0" name="product_quantity" id="quantityField" style="border: 1px solid black; border-radius: 5px;">
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
                                <input type="text" class="form-control" id="currencyInput" name="sku_input" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="Barcode">Barcode (ISBN, UCP, GTIN, etc)</label>
                                <input type="text" class="form-control" id="currencyInput" name="bar_code" aria-label="Amount" style="border: 1px solid black; border-radius: 5px;">
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
                                <input type="number" class="form-control" id="currencyInput" name="weight" aria-label="Amount" step="0.01" style="border: 1px solid black; border-radius: 5px;">
                                <select class="form-select border ml-2" style="border-radius: 10px !important;" name="weight_unit" aria-label="Default select example" id="weight_type">
                                    <option value="1" selected>Kg</option>
                                    <option value="2">lg</option>
                                    <option value="3">oz</option>
                                    <option value="4">g</option>
                                </select>
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
                                    <select class="form-select border w-100" name="country" aria-label="Default select example">
                                        <option value="1" selected>Pakistan</option>
                                        <option value="2">India</option>
                                        <option value="3">China</option>
                                        <option value="4">England</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="HS">HS (Harmonized System)</label>
                                <input name="harmonized_system" type="search" placeholder="Search Here" class="form-control" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                        </div>
                    </div>

                    <!-- <div class="card shadow-lg p-3  bg-white cards">
                        <label for="" class="Variants">Variants</label>
                        <div id="variant-input-section">
                            <div class="variant-row" style="display: none;">
                                <label class="opt_name">Option *</label>
                                <input type="text" name="variant_option[]" class="form-control variant-field" placeholder="Size, Color etc..." style="border: 1px solid black; border-radius: 5px;">
                                <label class="opt_val">Value *</label>
                                <input type="text" name="variant_value[]" class="form-control variant-field" style="border: 1px solid black; border-radius: 5px;">
                            </div>
                        </div>
                        <div class="table-responsive  mt-2" style="display: none;" id="variant_list">
                            <table id="variant-table" class="table table-hover variant-list">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Available</th>
                                        <th>On hand</th>
                                        <th>SKU</th>
                                        <th>Barcode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <a class="text-primary more_opt mt-2" id="add-variant-btn"> + Add Option like size or color</a>


                    </div> -->

                    <div class="card shadow-lg p-3  bg-white cards">
                        <label for="" class="Variants ">Variants</label>
                        <div class="col-md-12" id="variant-section" style="display: none;">
                            <div class="row" id="variant-input-section">
                                <div class="col-md-6 form-group mt-2">
                                    <label>{{trans('file.Option')}} *</label>
                                    <input type="text" name="variant_option[]" class="form-control variant-field" placeholder="Size, Color etc...">
                                </div>
                                <div class="col-md-6 form-group mt-2">
                                    <label>{{trans('file.Value')}} *</label>
                                    <input type="text" name="variant_value[]" class="type-variant form-control variant-field">
                                </div>
                            </div>

                            <div class="table-responsive ">
                                <table id="variant-table" class="table table-hover variant-list">
                                    <thead>
                                        <tr>
                                            <th>{{trans('file.name')}}</th>
                                            <th>{{trans('file.Item Code')}}</th>
                                            <th>{{trans('file.Additional Cost')}}</th>
                                            <th>{{trans('file.Additional Price')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="divider">

                        <a class="text-primary mt-2 add-more-variant" id="add-variant-btn"> + Add Option like size or color</a>
                    </div>

                    <div class="card shadow-lg  p-3 bg-white cards">
                        <div class="form-group ">
                            <div class="d-flex justify-content-between">
                                <h5 class="search_eng">Search Engine Listing</h5>
                                <a href="#">Edit</a>
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
                                        <option value="Active" selected class="text"> Active</option>
                                        <option value="Inactive" class="text">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <span class=" mb-2">
                            @error('save_status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </span >
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
                                            <input type="text" id="start_date" name="starting_date" class="date-picker form-control" />
                                            <!-- <input type="date" id="start_date" class="form-control" /> -->
                                        </div>
                                        <span class=" mb-2">
                                            @error('starting_date')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </span >
                                        <div class="col-lg-6">
                                            <label for="">End Time</label>
                                            <input type="text" id="end_date" name="ending_date" class="date-picker form-control" />
                                        </div>
                                        <span class=" mb-2">
                                            @error('ending_date')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </span >
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
                                            <img src="{{asset('icons/datetime.png')}}" alt="" width="20px" height="20px" class="" data-toggle="modal" data-target="#exampleModal">
                                        </li>
                                    </ul>
                                    <ul class="list-unstyled">
                                        <li class="mb-3">
                                            <span class="Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Point of Sale and POS</span>
                                        </li>

                                        <li class="mb-3">
                                            <span class="Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Shop</span>
                                            <div style="margin-left: 19px;"><span class="text-black text">Shop has noticed your store does't meet store requirement</span>
                                                <a href="#">Learn More</a>
                                            </div>
                                        </li>
                                        <li class="mb-3">
                                            <span class="Publishing_sub_cont"><i class="fa fa-circle-thin"></i> Facebook & Instagram</span>
                                            <div style="margin-left: 19px;"><span class="text-black text">Shop has noticed your store does't meet store requirement</span>
                                                <a href="#">Learn More</a>
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

                                <select class="form-select border w-100" aria-label="Default select example" name="prod_category" style="border: 1px solid black; border-radius: 5px;">
                                    @foreach ($lims_category_list as $lims_category_list)
                                    <option value="{{$lims_category_list->id}}">{{$lims_category_list->name}}</option>
                                    @endforeach
                                    <!-- Add more option elements for other tags if needed -->
                                </select>
                                @error('prod_category')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                

                            </div>
                            <div class="form-group">
                                <label for="" class="product">Product Type</label>
                                <!-- <input type="text" class="form-control" name="prod_type" style="border: 1px solid black; border-radius: 5px;"> -->
                                <select class="form-select border w-100" aria-label="Default select example" name="prod_type" style="border: 1px solid black; border-radius: 5px;">
                                    <option value="Product Type 1">Product Type 1</option>
                                    <option value="Product Type 2">Product Type 2</option>
                                    <!-- Add more option elements for other tags if needed -->
                                </select>
                                @error('prod_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="product">Vendor</label>
                                <select class="form-select border w-100" aria-label="Default select example" name="prod_vendor" style="border: 1px solid black; border-radius: 5px;">
                                    <option value="Pakistan Fashion Lounge" selected>Pakistan Fashion Lounge</option>
                                    <!-- Add more option elements for other tags if needed -->
                                </select>
                                @error('prod_vendor')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <!-- <input type="text" class="form-control" name="prod_vendor" style="border: 1px solid black; border-radius: 5px;"> -->
                            </div>
                            <span class="coll_error">There are no collection available to add this product to. You can add a new collection or modify your existing collection </span>
                            <div class="form-group">
                                <div class="row d-flex justify-content-between ">
                                    <label for="" class="ml-3" class="product">Tags</label><a href="#" class="mr-4">Manage</a>
                                </div>
                                <div>
                                    <select class="form-select border w-100" name="tags[]" aria-label="Default select example" style="border: 1px solid black; border-radius: 5px;" multiple>
                                        @foreach ($collections as $tag)
                                        <option value="{{$tag->title}}">{{$tag->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm p-3 bg-white cards">
                        <div class="card-body">
                            <label class="card-title on_store">Online Store</label>
                            <div class="form-group">
                                <span for="">Theme Template</span>
                                <div>
                                    <select class="form-select border w-100" name="pro_theme" aria-label="Default select example" style="border: 1px solid black; border-radius: 5px;">
                                        <option value="" selected>Default Product</option>
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

    @endsection
    @push('scripts')

    <script>
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
                var htmlText = '<div class="col-md-6 form-group mt-2"><label>Option *</label><input type="text" name="variant_option[]" class="form-control variant-field" placeholder="Size, Color etc..."></div><div class="col-md-6 form-group mt-2"><label>Value *</label><input type="text" name="variant_value[]" class="type-variant form-control variant-field"></div>';
                $("#variant-input-section").append(htmlText);
                $('.type-variant').tagsInput();
            }

        });

        //start variant related js
        $(function() {
            $('.type-variant').tagsInput();
        });

        // Variants Code End


        function toggleQuantityField() {
            var checkbox = document.getElementById("toggleQuantityCheck");
            var quantityField = document.getElementById("toggle_quantity");

            if (checkbox.checked) {
                quantityField.style.display = "none";
            } else {
                quantityField.style.display = "block";
            }
        }

        // $(".dropzone").sortable({
        //     items: '.dz-preview',
        //     cursor: 'grab',
        //     opacity: 0.5,
        //     containment: '.dropzone',
        //     distance: 20,
        //     tolerance: 'pointer',
        //     stop: function() {
        //         var queue = myDropzone.getAcceptedFiles();
        //         newQueue = [];
        //         $('#imageUpload .dz-preview .dz-filename [data-dz-name]').each(function(count, el) {
        //             var name = el.innerHTML;
        //             queue.forEach(function(file) {
        //                 if (file.name === name) {
        //                     newQueue.push(file);
        //                 }
        //             });
        //         });
        //         myDropzone.files = newQueue;
        //     }
        // });

        // myDropzone = new Dropzone('div#imageUpload', {
        //     addRemoveLinks: true,
        //     autoProcessQueue: false,
        //     uploadMultiple: true,
        //     parallelUploads: 100,
        //     maxFilesize: 12,
        //     paramName: 'image',
        //     clickable: true,
        //     method: 'POST',
        //     url: '{{route('products.store')}}',
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     renameFile: function(file) {
        //         var dt = new Date();
        //         var time = dt.getTime();
        //         return time + file.name;
        //     },
        //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //     init: function () {
        //         var myDropzone = this;
        //         $('#submit-btn').on("click", function (e) {
        //             e.preventDefault();
        //             if ( $("#product-form").valid() && validate() ) {
        //                 tinyMCE.triggerSave();
        //                 if(myDropzone.getAcceptedFiles().length) {
        //                     myDropzone.processQueue();
        //                 }
        //                 else {
        //                     var formData = new FormData();
        //                     var data = $("#product-form").serializeArray();
        //                     $.each(data, function (key, el) {
        //                         formData.append(el.name, el.value);
        //                     });
        //                     var file = $('#file')[0].files;
        //                     if(file.length > 0)
        //                         formData.append('file',file[0]);
        //                     $.ajax({
        //                         type:'POST',
        //                         url:'{{route('products.store')}}',
        //                         data: formData,
        //                         contentType: false,
        //                         processData: false,
        //                         success:function(response) {
        //                             //console.log(response);
        //                             location.href = '../products';
        //                         },
        //                         error:function(response) {
        //                           if(response.responseJSON.errors.name) {
        //                               $("#name-error").text(response.responseJSON.errors.name);
        //                           }
        //                           else if(response.responseJSON.errors.code) {
        //                               $("#code-error").text(response.responseJSON.errors.code);
        //                           }
        //                         },
        //                     });
        //                 }
        //             }
        //         });

        //         this.on('sending', function (file, xhr, formData) {
        //             // Append all form inputs to the formData Dropzone will POST
        //             var data = $("#product-form").serializeArray();
        //             $.each(data, function (key, el) {
        //                 formData.append(el.name, el.value);
        //             });
        //             var file = $('#file')[0].files;
        //             if(file.length > 0)
        //                 formData.append('file',file[0]);
        //         });
        //     },
        //     error: function (file, response) {
        //         console.log(response);
        //         if(response.errors.name) {
        //           $("#name-error").text(response.errors.name);
        //           this.removeAllFiles(true);
        //         }
        //         else if(response.errors.code) {
        //           $("#code-error").text(response.errors.code);
        //           this.removeAllFiles(true);
        //         }
        //         else {
        //           try {
        //               var res = JSON.parse(response);
        //               if (typeof res.message !== 'undefined' && !$modal.hasClass('in')) {
        //                   $("#success-icon").attr("class", "fas fa-thumbs-down");
        //                   $("#success-text").html(res.message);
        //                   $modal.modal("show");
        //               } else {
        //                   if ($.type(response) === "string")
        //                       var message = response; //dropzone sends it's own error messages in string
        //                   else
        //                       var message = response.message;
        //                   file.previewElement.classList.add("dz-error");
        //                   _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        //                   _results = [];
        //                   for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        //                       node = _ref[_i];
        //                       _results.push(node.textContent = message);
        //                   }
        //                   return _results;
        //               }
        //           } catch (error) {
        //               console.log(error);
        //           }
        //         }
        //     },
        //     successmultiple: function (file, response) {
        //         location.href = '../products';
        //         //console.log(file, response);
        //     },
        //     completemultiple: function (file, response) {
        //         console.log(file, response, "completemultiple");
        //     },
        //     reset: function () {
        //         console.log("resetFiles");
        //         this.removeAllFiles(true);
        //     }
        // });

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


        // // Image Selector
        // let fileInput = document.getElementById("file-input");
        
        // let imageContainer = document.getElementById("images");
        // let numOfFiles = document.getElementById("num-of-files");

        // function preview() {
        //     imageContainer.innerHTML = "";
        //     image_count = numOfFiles.textContent = `${fileInput.files.length}`;
        //      numOfFiles.textContent = `${fileInput.files.length} Files Selected`;
           

        //     for (i of fileInput.files) {
        //         let reader = new FileReader();
        //         let figure = document.createElement("figure");
        //         let figCap = document.createElement("figcaption");
        //         figCap.innerText = i.name;
        //         figure.appendChild(figCap);
        //         reader.onload = () => {
        //             let img = document.createElement("img");
        //             img.setAttribute("src", reader.result);
        //             figure.insertBefore(img, figCap);
        //         }
        //         imageContainer.appendChild(figure);
        //         reader.readAsDataURL(i);
        //     }
        //     document.querySelector('.image_count').value = image_count;
        // }

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


// Variants
(function($) {
        var delimiter = [];
        var inputSettings = [];
        var callbacks = [];
        
        $.fn.addTag = function(value, options) {
            options = jQuery.extend({
                focus: false,
                callback: true
            }, options);
            this.each(function() {
                var id = $(this).attr('id');
                var tagslist = $(this).val().split(_getDelimiter(delimiter[id]));
                if (tagslist[0] === '') tagslist = [];

                value = jQuery.trim(value);
                
                if ((inputSettings[id].unique && $(this).tagExist(value)) || !_validateTag(value, inputSettings[id], tagslist, delimiter[id])) {
                    $('#' + id + '_tag').addClass('error');
                    return false;
                }
                
                $('<span>', {class: 'tag'}).append(
                    $('<span>', {class: 'tag-text'}).text(value),
                    $('<button>', {class: 'tag-remove'}).click(function() {
                        return $('#' + id).removeTag(encodeURI(value));
                    })
                ).insertBefore('#' + id + '_addTag');
                tagslist.push(value);

                $('#' + id + '_tag').val('');
                if (options.focus) {
                    $('#' + id + '_tag').focus();
                } else {
                    $('#' + id + '_tag').blur();
                }

                $.fn.tagsInput.updateTagsField(this, tagslist);

                if (options.callback && callbacks[id] && callbacks[id]['onAddTag']) {
                    var f = callbacks[id]['onAddTag'];
                    f.call(this, this, value);
                }
                
                if (callbacks[id] && callbacks[id]['onChange']) {
                    var i = tagslist.length;
                    var f = callbacks[id]['onChange'];
                    f.call(this, this, value);
                }

                $(".type-variant").each(function(index) {
                    variantIds.splice(index, 1, $(this).attr('id'));
                });
                
                //start custom code
                first_variant_values = $('#'+variantIds[0]).val().split(_getDelimiter(delimiter[variantIds[0] ]));
                combinations = first_variant_values;
                step = 1;
                while(step < variantIds.length) {
                    var newCombinations = [];
                    for (var i = 0; i < combinations.length; i++) {
                        new_variant_values = $('#'+variantIds[step]).val().split(_getDelimiter(delimiter[variantIds[step] ]));
                        for (var j = 0; j < new_variant_values.length; j++) {
                            newCombinations.push(combinations[i]+'/'+new_variant_values[j]);
                        }
                    }
                    combinations = newCombinations;
                    step++;
                }
                var rownumber = $('table.variant-list tbody tr:last').index();
                if(rownumber > -1) {
                    oldCombinations = [];
                    oldAdditionalCost = [];
                    oldAdditionalPrice = [];
                    $(".variant-name").each(function(i) {
                        oldCombinations.push($(this).text());
                        oldAdditionalCost.push($('table.variant-list tbody tr:nth-child(' + (i + 1) + ')').find('.additional-cost').val());
                        oldAdditionalPrice.push($('table.variant-list tbody tr:nth-child(' + (i + 1) + ')').find('.additional-price').val());
                    });
                }
                $("table.variant-list tbody").remove();
                var newBody = $("<tbody>");
                for(i = 0; i < combinations.length; i++) {
                    var variant_name = combinations[i];
                    var item_code = variant_name+'-'+$("#code").val();
                    var newRow = $("<tr>");
                    var cols = '';
                    cols += '<td class="variant-name">'+variant_name+'<input type="hidden" name="variant_name[]" value="' + variant_name + '" /></td>';
                    cols += '<td><input type="text" class="form-control item-code" name="item_code[]" value="'+item_code+'" /></td>';
                    //checking if this variant already exist in the variant table
                    oldIndex = oldCombinations.indexOf(combinations[i]);
                    if(oldIndex >= 0) {
                        cols += '<td><input type="number" class="form-control additional-cost" name="additional_cost[]" value="'+oldAdditionalCost[oldIndex]+'" step="any" /></td>';
                        cols += '<td><input type="number" class="form-control additional-price" name="additional_price[]" value="'+oldAdditionalPrice[oldIndex]+'" step="any" /></td>';
                    }
                    else {
                        cols += '<td><input type="number" class="form-control additional-cost" name="additional_cost[]" value="" step="any" /></td>';
                        cols += '<td><input type="number" class="form-control additional-price" name="additional_price[]" value="" step="any" /></td>';
                    }
                    newRow.append(cols);
                    newBody.append(newRow);
                }
                $("table.variant-list").append(newBody);
                //end custom code
            });
            return false;
        };

        $.fn.removeTag = function(value) {
            value = decodeURI(value);
            
            this.each(function() {
                var id = $(this).attr('id');

                var old = $(this).val().split(_getDelimiter(delimiter[id]));

                $('#' + id + '_tagsinput .tag').remove();
                
                var str = '';
                for (i = 0; i < old.length; ++i) {
                    if (old[i] != value) {
                        str = str + _getDelimiter(delimiter[id]) + old[i];
                    }
                }

                $.fn.tagsInput.importTags(this, str);

                if (callbacks[id] && callbacks[id]['onRemoveTag']) {
                    var f = callbacks[id]['onRemoveTag'];
                    f.call(this, this, value);
                }
            });

            return false;
        };

        $.fn.tagExist = function(val) {
            var id = $(this).attr('id');
            var tagslist = $(this).val().split(_getDelimiter(delimiter[id]));
            return (jQuery.inArray(val, tagslist) >= 0);
        };

        $.fn.importTags = function(str) {
            var id = $(this).attr('id');
            $('#' + id + '_tagsinput .tag').remove();
            $.fn.tagsInput.importTags(this, str);
        };

        $.fn.tagsInput = function(options) {
            var settings = jQuery.extend({
                interactive: true,
                placeholder: variantPlaceholder,
                minChars: 0,
                maxChars: null,
                limit: null,
                validationPattern: null,
                width: 'auto',
                height: 'auto',
                autocomplete: null,
                hide: true,
                delimiter: ',',
                unique: true,
                removeWithBackspace: true
            }, options);

            var uniqueIdCounter = 0;

            this.each(function() {
                if (typeof $(this).data('tagsinput-init') !== 'undefined') return;

                $(this).data('tagsinput-init', true);

                if (settings.hide) $(this).hide();
                
                var id = $(this).attr('id');
                if (!id || _getDelimiter(delimiter[$(this).attr('id')])) {
                    id = $(this).attr('id', 'tags' + new Date().getTime() + (++uniqueIdCounter)).attr('id');
                }

                var data = jQuery.extend({
                    pid: id,
                    real_input: '#' + id,
                    holder: '#' + id + '_tagsinput',
                    input_wrapper: '#' + id + '_addTag',
                    fake_input: '#' + id + '_tag'
                }, settings);

                delimiter[id] = data.delimiter;
                inputSettings[id] = {
                    minChars: settings.minChars,
                    maxChars: settings.maxChars,
                    limit: settings.limit,
                    validationPattern: settings.validationPattern,
                    unique: settings.unique
                };

                if (settings.onAddTag || settings.onRemoveTag || settings.onChange) {
                    callbacks[id] = [];
                    callbacks[id]['onAddTag'] = settings.onAddTag;
                    callbacks[id]['onRemoveTag'] = settings.onRemoveTag;
                    callbacks[id]['onChange'] = settings.onChange;
                }

                var markup = $('<div>', {id: id + '_tagsinput', class: 'tagsinput'}).append(
                    $('<div>', {id: id + '_addTag'}).append(
                        settings.interactive ? $('<input>', {id: id + '_tag', class: 'tag-input', value: '', placeholder: settings.placeholder}) : null
                    )
                );

                $(markup).insertAfter(this);

                $(data.holder).css('width', settings.width);
                $(data.holder).css('min-height', settings.height);
                $(data.holder).css('height', settings.height);

                if ($(data.real_input).val() !== '') {
                    $.fn.tagsInput.importTags($(data.real_input), $(data.real_input).val());
                }
                
                // Stop here if interactive option is not chosen
                if (!settings.interactive) return;
                
                $(data.fake_input).val('');
                $(data.fake_input).data('pasted', false);
                
                $(data.fake_input).on('focus', data, function(event) {
                    $(data.holder).addClass('focus');
                    
                    if ($(this).val() === '') {
                        $(this).removeClass('error');
                    }
                });
                
                $(data.fake_input).on('blur', data, function(event) {
                    $(data.holder).removeClass('focus');
                });

                if (settings.autocomplete !== null && jQuery.ui.autocomplete !== undefined) {
                    $(data.fake_input).autocomplete(settings.autocomplete);
                    $(data.fake_input).on('autocompleteselect', data, function(event, ui) {
                        $(event.data.real_input).addTag(ui.item.value, {
                            focus: true,
                            unique: settings.unique
                        });
                        
                        return false;
                    });
                    
                    $(data.fake_input).on('keypress', data, function(event) {
                        if (_checkDelimiter(event)) {
                            $(this).autocomplete("close");
                        }
                    });
                } else {
                    $(data.fake_input).on('blur', data, function(event) {
                        $(event.data.real_input).addTag($(event.data.fake_input).val(), {
                            focus: true,
                            unique: settings.unique
                        });
                        
                        return false;
                    });
                }
                
                // If a user types a delimiter create a new tag
                $(data.fake_input).on('keypress', data, function(event) {
                    if (_checkDelimiter(event)) {
                        event.preventDefault();
                        
                        $(event.data.real_input).addTag($(event.data.fake_input).val(), {
                            focus: true,
                            unique: settings.unique
                        });
                        
                        return false;
                    }
                });
                
                $(data.fake_input).on('paste', function () {
                    $(this).data('pasted', true);
                });
                
                // If a user pastes the text check if it shouldn't be splitted into tags
                $(data.fake_input).on('input', data, function(event) {
                    if (!$(this).data('pasted')) return;
                    
                    $(this).data('pasted', false);
                    
                    var value = $(event.data.fake_input).val();
                    
                    value = value.replace(/\n/g, '');
                    value = value.replace(/\s/g, '');
                    
                    var tags = _splitIntoTags(event.data.delimiter, value);
                    
                    if (tags.length > 1) {
                        for (var i = 0; i < tags.length; ++i) {
                            $(event.data.real_input).addTag(tags[i], {
                                focus: true,
                                unique: settings.unique
                            });
                        }
                        
                        return false;
                    }
                });
                
                // Deletes last tag on backspace
                data.removeWithBackspace && $(data.fake_input).on('keydown', function(event) {
                    if (event.keyCode == 8 && $(this).val() === '') {
                         event.preventDefault();
                         var lastTag = $(this).closest('.tagsinput').find('.tag:last > span').text();
                         var id = $(this).attr('id').replace(/_tag$/, '');
                         $('#' + id).removeTag(encodeURI(lastTag));
                         $(this).trigger('focus');
                    }
                });

                // Removes the error class when user changes the value of the fake input
                $(data.fake_input).keydown(function(event) {
                    // enter, alt, shift, esc, ctrl and arrows keys are ignored
                    if (jQuery.inArray(event.keyCode, [13, 37, 38, 39, 40, 27, 16, 17, 18, 225]) === -1) {
                        $(this).removeClass('error');
                    }
                });
            });

            return this;
        };
        
        $.fn.tagsInput.updateTagsField = function(obj, tagslist) {
            var id = $(obj).attr('id');
            $(obj).val(tagslist.join(_getDelimiter(delimiter[id])));
        };

        $.fn.tagsInput.importTags = function(obj, val) {
            $(obj).val('');
            
            var id = $(obj).attr('id');
            var tags = _splitIntoTags(delimiter[id], val); 
            
            for (i = 0; i < tags.length; ++i) {
                $(obj).addTag(tags[i], {
                    focus: false,
                    callback: false
                });
            }
            
            if (callbacks[id] && callbacks[id]['onChange']) {
                var f = callbacks[id]['onChange'];
                f.call(obj, obj, tags);
            }
        };
        
        var _getDelimiter = function(delimiter) {
            if (typeof delimiter === 'undefined') {
                return delimiter;
            } else if (typeof delimiter === 'string') {
                return delimiter;
            } else {
                return delimiter[0];
            }
        };
        
        var _validateTag = function(value, inputSettings, tagslist, delimiter) {
            var result = true;
            
            if (value === '') result = false;
            if (value.length < inputSettings.minChars) result = false;
            if (inputSettings.maxChars !== null && value.length > inputSettings.maxChars) result = false;
            if (inputSettings.limit !== null && tagslist.length >= inputSettings.limit) result = false;
            if (inputSettings.validationPattern !== null && !inputSettings.validationPattern.test(value)) result = false;
            
            if (typeof delimiter === 'string') {
                if (value.indexOf(delimiter) > -1) result = false;
            } else {
                $.each(delimiter, function(index, _delimiter) {
                    if (value.indexOf(_delimiter) > -1) result = false;
                    return false;
                });
            }
            
            return result;
        };
     
        var _checkDelimiter = function(event) {
            var found = false;
            
            if (event.which === 13) {
                return true;
            }

            if (typeof event.data.delimiter === 'string') {
                if (event.which === event.data.delimiter.charCodeAt(0)) {
                    found = true;
                }
            } else {
                $.each(event.data.delimiter, function(index, delimiter) {
                    if (event.which === delimiter.charCodeAt(0)) {
                        found = true;
                    }
                });
            }
            
            return found;
         };
         
         var _splitIntoTags = function(delimiter, value) {
             if (value === '') return [];
             
             if (typeof delimiter === 'string') {
                 return value.split(delimiter);
             } else {
                 var tmpDelimiter = '∞';
                 var text = value;
                 
                 $.each(delimiter, function(index, _delimiter) {
                     text = text.split(_delimiter).join(tmpDelimiter);
                 });
                 
                 return text.split(tmpDelimiter);
             }
             
             return [];
         };
    })(jQuery);


    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 400
        });
    </script>
    <script src="{{asset('calender/date-picker.js')}}"></script>
    @endpush