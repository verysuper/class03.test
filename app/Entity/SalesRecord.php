<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use App\Entity\User;

class SalesRecord extends Model
{
    protected $fillable = [
            'user_id',
            'customer_name',
            'product_description',
            'record_image',
            'customer_id',
            'product_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
