<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Computer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_computer';
    protected $fillable = [
        'computer_brand',
        'computer_model',
        'computer_price',
        'computer_ram_size',
        'computer_is_laptop',
        'category_id',
        'computer_barcode',
    ];

    /**
     * Relación muchos a uno con Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id_category');
    }
}
