<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function isNew()
    {
        return $this->created_at->diffInDays(now()) < 30;
    }

    public function isAvailable()
    {
        return $this->stock > 0;
    }

    public function getFormattedPrice()
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    public function getFormattedStock()
    {
        return $this->stock . ' unité' . ($this->stock > 1 ? 's' : '');
    }
}
