<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\productBarcode;
use App\ProductVariant;
use App\Variant;
use Milon\Barcode\DNS1D;

use Picqer\Barcode\BarcodeGeneratorHTML;

class BarcodeGenerator extends Controller
{
    //
    public function generateBarcode()
    {
        $product_ids = Product::pluck('id');
        foreach ($product_ids as  $id) {
            $product = Product::findOrFail($id);
            if ($product && $product->product_barcode == null) {
                dd("nj/");
                $product->product_barcode = mt_rand(1000000000000, 9999999999999);
                $product->update();
            }
        }
    }

    // public function fetchBarcodeProduct()
    // {
    //     $products = productBarcode::paginate(6);
    //     return view('backend.barcode.barcode', compact('products'));
    // }
}
