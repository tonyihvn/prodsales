<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_checkouts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'setting_id','id');
    }


    public function material()
    {
        return $this->hasOne(materials::class, 'id', 'material_id');
    }

    public function approvedby()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }

    public function checkoutby()
    {
        return $this->hasOne(User::class, 'id', 'checkout_by');
    }
}
