<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialModel extends Model
{
    use HasFactory;

    protected $table = 'materials';
    
    protected $fillable = [
        'id',
        'product_id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
}