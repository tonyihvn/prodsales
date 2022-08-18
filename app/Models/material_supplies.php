<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_supplies extends Model
{
    use HasFactory;

    public function settings()
    {
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }

    public function supplier()
    {
        return $this->belongsToMany(suppliers::class, 'id', 'supplier_id');
    }

    public function material()
    {
        return $this->hasOne(materials::class, 'id', 'material_id');
    }
}
