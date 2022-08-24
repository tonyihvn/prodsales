<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function personnel()
    {
        return $this->hasMany(User::class, 'setting_id', 'id');
    }

    public function businessgroup()
    {
        return $this->belongsTo(businessgroups::class, 'id', 'businessgroup_id');
    }

    public function audits()
    {
        return $this->hasMany(audits::class, 'setting_id', 'id');
    }

    public function accountheads()
    {
        return $this->hasMany(accountheads::class, 'setting_id', 'id');
    }

    public function distributions()
    {
        return $this->hasMany(distribution::class, 'setting_id', 'id');
    }

    public function distributors()
    {
        return $this->hasMany(distributor::class, 'setting_id', 'id');
    }

    public function finishedproducts()
    {
        return $this->hasMany(finished_products::class, 'setting_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(inventory::class, 'setting_id', 'id');
    }

    public function checkouts()
    {
        return $this->hasMany(material_checkouts::class, 'setting_id', 'id');
    }

    public function stocks()
    {
        return $this->hasMany(product_stocks::class, 'setting_id', 'id');
    }

    public function jobs()
    {
        return $this->hasMany(production_jobs::class, 'setting_id', 'id');
    }

    public function materials()
    {
        return $this->hasMany(materials::class, 'setting_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(products::class, 'setting_id', 'id');
    }

    public function suppliers()
    {
        return $this->hasMany(suppliers::class, 'setting_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(attendance::class, 'setting_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(transactions::class, 'setting_id', 'id');
    }

    public function programmes()
    {
        return $this->hasMany(programmes::class, 'setting_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(tasks::class, 'setting_id', 'id');
    }

    public function followups()
    {
        return $this->hasMany(followups::class, 'setting_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(categories::class, 'setting_id', 'id');
    }
}
