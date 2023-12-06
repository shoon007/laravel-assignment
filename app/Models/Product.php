<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description',
        'item_condition',
        'item_type',
        'publish_status',
        'image',
        'owner_name',
        'owner_phone',
        'owner_address'
    ];
}
