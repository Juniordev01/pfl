<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\productBarcode;
use App\Variant;
use Milon\Barcode\DNS1D;

use Picqer\Barcode\BarcodeGeneratorHTML;

class BarcodeGenerator extends Controller
{
    //
    public function generateBarcode()
    {
        // $products = variant::with('product')->get();;
        $products = Product::with('variant')->get();

        return($products);
        foreach ($products as $product) {
            $productBarcode = new productBarcode();
            $productBarcode->name = $product->name;
            $productBarcode->price = $product->price;;
            $productBarcode->product_code = $product->product_id;;
            $productBarcode->barcode = $product->product_id;
            $productBarcode->price = $product->price;;
            $productBarcode->product_id = $product->id;;
            $productBarcode->save();
        }
        return view('backend.barcode.barcode', compact('products'));
        
    }

    public function fetchBarcodeProduct()
    {
        $products = productBarcode::paginate(6);
        return view('backend.barcode.barcode', compact('products'));
    }
}
