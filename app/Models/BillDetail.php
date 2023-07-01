<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;
    protected $table = 'products';
    public function type_products(){
        return $this->belongTo('App\Type_product');
    }

    public function bills_details(){
        return $this -> hasMany('App\BillDetail');
    }

    public function comment(){
        return $this -> belongTo('App\Product');
    }
}
