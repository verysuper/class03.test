<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
            'category_no',
            'name',
            'name_en',
            'image',
            'info',
            'info_en',
            'parent_id',
            'display',
            'created_by_id',
            'updated_by_id',
            'view',
            'layer',
    ];
}
