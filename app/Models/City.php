<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','country_id'
    ];
    public $timestamps = false;

    public function addresses()
    {
        return $this->hasMany(Address::class,'city_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class,'city_id','id');
    }
}
