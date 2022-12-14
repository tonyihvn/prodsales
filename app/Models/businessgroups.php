<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class businessgroups extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function settings()
    {
        return $this->hasMany(settings::class, 'businessgroup_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'id', 'user_id');
    }
}
