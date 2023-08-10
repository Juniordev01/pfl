<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\productBarcode;
use App\ProductVariant;
use App\Variant;
use Automattic\WooCommerce\HttpClient\Response;
use Milon\Barcode\DNS1D;

use Picqer\Barcode\BarcodeGeneratorHTML;

class BarcodeGenerator extends Controller
{
    //
    public function generateBarcode()
    {

        $products = Product::with('productVariants')->whereNotIn('id', range(1, 809))->get(); //Change The rang according to your need
        foreach ($products as $product) {

            $product->product_barcode = null ? $product->product_barcode : mt_rand(1000000000000, 9999999999999);
            if ($product->update()) {
                $parts = explode('-', $product->name, 2);
                $lastPart = $parts[1];
                if (count($product->productVariants) > 0) {
                    foreach ($product->productVariants as $eachVariant) {
                        $eachVariant->sku =  $lastPart . "-" . $eachVariant->title;
                        $eachVariant->barcode = $lastPart . "-" . $eachVariant->title . "-" . $eachVariant->title;
                        $eachVariant->update();
                    }
                    return $this->json(
                        ['message' => 'Product barcode and Variants Updated'],
                        200
                    );
                } else
                    return $this->json(
                        ['message' => 'No Variant Available'],
                        404
                    );
            }
        }




        // foreach ($products as  $product) {

        //     $product = Product::findOrFail($id);
        //     if ($product && $product->product_barcode == null) {
        //         // dd("nj/");
        //         dd($product->id);
        //         $product->product_barcode = mt_rand(1000000000000, 9999999999999);
        //         $product->update();
        //     }
        // }
    }

    public function fetchBarcodeProduct()
    {
        
        $products = Product::orderBy('id', 'desc')->with('productVariants')->paginate(5);
        // $products = Product::orderBy('id', 'desc')->with('productVariants')->where('id',786)->get();
        // return($products);
        return view('backend.barcode.barcode', compact('products'));
    }
}
