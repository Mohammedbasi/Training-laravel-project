<?php

namespace App\Models;

use App\Filters\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    protected $fillable = ['name','notes','icon'];
    use HasFactory,SoftDeletes;

    public function items()
    {
        return $this->hasMany(Item::class,'brand_id','id');
    }
    public function scopeFilter(Builder $builder, $filters)
    {
        $filterable = new FilterFactory();
        $filterable->baseFilter($builder, $filters);
    }
}
