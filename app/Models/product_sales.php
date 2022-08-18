<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_sales extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }

    /*
    public function salesgroup()
    {
        return $this->hasMany(product_sales::class, 'group_id', 'group_id');
    }
    */

    public function product()
    {
        return $this->hasOne(products::class, 'id', 'product_id');
    }

}
