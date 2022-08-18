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
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }

    public function user()
    {
        return $this->belongsToMany(user::class, 'id', 'checkout_by','approved_by');
    }

    public function material()
    {
        return $this->hasOne(materials::class, 'id', 'material_id');
    }
}
