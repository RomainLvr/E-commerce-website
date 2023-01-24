<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderModel extends Model
{
    use HasFactory;

    protected $table = 'product_order';
    
    protected $fillable = [
        'id',
        'product_id',
        'order_id',
        'quantity',
        'rate',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }
    
}
