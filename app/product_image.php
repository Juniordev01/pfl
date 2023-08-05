<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Product;

class product_image extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(product::class,'product_id');
    }
}
