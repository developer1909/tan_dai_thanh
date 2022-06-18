<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductsModel extends Model
{
    protected $table = 'order_products';
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity'
    ];
}
