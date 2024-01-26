<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    public function images()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function stock()
    {
       return $this->hasOne(ProductStock::class,'product_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
	{
	    parent::boot();
	    static::deleting(function($deletion) {
            $deletion->stock()->delete();
            $deletion->images()->delete();
	    });
	}
}
