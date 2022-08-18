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
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }

}
