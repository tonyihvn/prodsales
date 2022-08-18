<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class audits extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function settings()
    {
        return $this->belongsTo(settings::class, 'id', 'setting_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'id', 'user_id');
    }
}
