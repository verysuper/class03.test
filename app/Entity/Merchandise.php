<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $fillable=[
            'merchandise_no',
            'name',
            'name_en',
            'image',
            'info',
            'info_en',
            'parent_id',
            'remain_qty',
            'display',
            'created_by_id',
            'updated_by_id',
            'view',
            'price',
            'brand_id',
            'vendor_id',
            'highly_qty',
            'delete',
        ];
}
