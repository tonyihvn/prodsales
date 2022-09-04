<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_damages extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function settings()
    {
        return $this->belongsTo(settings::class, 'setting_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(products::class, 'id', 'product_id');
    }

    public function damagedby()
    {
        return $this->hasOne(User::class, 'id', 'damaged_by');
    }


}
