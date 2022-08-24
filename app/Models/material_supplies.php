<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_supplies extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'setting_id', 'id');
    }

    public function supplier()
    {
        return $this->hasOne(suppliers::class, 'id', 'supplier_id');
    }

    public function material()
    {
        return $this->hasOne(materials::class, 'id', 'material_id');
    }

    public function confirmedby()
    {
        return $this->hasOne(User::class, 'id', 'confirmed_by');
    }

}
