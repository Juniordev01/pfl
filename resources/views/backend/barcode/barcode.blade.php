@extends('layout')
@section('title','Dashboard')

@section('content')

<!-- <div class="container ">
    <div class="row">
        <div class="col-lg-3 d-flex justify-content-center">
            @foreach ($products as $product )
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">{{$product->name}}</h6>
                    <p class="card-text "><strong>Price</strong>{{$product->price}}</p>
                    <!-- {!! DNS2D::getBarcodeHTML(strval($product->id) . ' - ' . $product->name, 'QRCODE',3,2) !!} -->
<!-- <div class="barcode">
                        {!! DNS1D::getBarcodeHTML($product->product_id . "123" , "C128",1.4,22) !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> -->



<div class="container mt-5">
    <div class="row d-block" id="product-cards">
        @foreach ($products as $product )
        <div class="col-md-3">
            <div class="card mb-3 shadow-lg p-3 ">
                <div class="card-body">
                    <h5 class="card-title">Name: {{$product->name}}</h5>
                    <p class="card-text"><strong>Price:</strong> {{$product->price}}</p>
                    <!-- <span>{!! DNS1D::getBarcodeHTML($product->product_id . "123", "C128", 1.4, 22) !!}</span> -->
                    <div class="row">
                        <?php
                        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->product_id, "C128", 1.4, 22) . '" alt="barcode"   />';
                        ?>
                        <span>{{$product->product_id}}</span>
                        <span>{{$product->code}}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>








@endsection