<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $primaryKey = 'id_category';
    
    protected $fillable = [
        'category_name',
        'category_description',
        'category_order',
        'category_discount',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'category_discount' => 'decimal:2',
    ];

    /**
     * Relación uno a muchos con Computer
     */
    public function computers()
    {
        return $this->hasMany(Computer::class, 'category_id', 'id_category');
    }
}
