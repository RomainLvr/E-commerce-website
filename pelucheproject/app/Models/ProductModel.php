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
        'dimensions',
        'discount',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function getPrimaryImage()
    {
        return ImagesModel::select('image')->where('product_id', $this->id)->where('is_primary', true)->get()->first();
    }

    public function getAllImages()
    {
        return ImagesModel::select('image')->where('product_id', $this->id)->get();
    }

    public function isNew()
    {
        return $this->created_at->diffInDays(now()) < 30;
    }

    public function isAvailable()
    {
        return $this->stock > 0 && $this->active;
    }

    public function getFormattedPrice()
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    public function getFormattedStock()
    {
        return $this->stock . ' unité' . ($this->stock > 1 ? 's' : '');
    }

    public function getDiscundPrice()
    {
        return number_format($this->price - ($this->price * $this->discount / 100), 2, ',', ' ') . ' €';
    }

    public function getMaterials()
    {
        return MaterialModel::where('product_id', $this->id)->get();
    }

    public function getRate()
    {
        return number_format(round(ProductOrderModel::where('product_id', $this->id)->avg('rate') * 2) / 2, 1);
    }

    public function getRatingNumber()
    {
        return ProductOrderModel::where('product_id', $this->id)->count() > 0 ? ProductOrderModel::where('product_id', $this->id)->count() . ' évaluation(s)' : 'Aucune évaluation';
    }
}
