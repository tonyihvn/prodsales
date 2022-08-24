<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class production_jobs extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'staff_incharge');
    }


    public function product()
    {
        return $this->hasOne(products::class, 'id', 'product_id');
    }
}
