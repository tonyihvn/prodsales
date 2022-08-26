<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class finished_products extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }

    public function batch()
    {
        return $this->belongsTo(production_jobs::class, 'id', 'production_batch');
    }

    public function product()
    {
        return $this->hasOne(products::class, 'id', 'product_name');
    }

    public function confirmedby()
    {
        return $this->hasOne(User::class, 'id', 'confirmed_by');
    }
}
