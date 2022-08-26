<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'setting_id', 'id');
    }

    public function stock()
    {
        return $this->hasOne(product_stocks::class, 'product_id', 'id');
    }

    public function finishedproduct()
    {
        return $this->hasMany(finished_products::class, 'product_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany(product_sales::class, 'product_id', 'id');
    }

}
