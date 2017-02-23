<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'caffeine',
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function getCaffeineAttribute()
    {
        return number_format($this->attributes['caffeine'] / 100, 2);
    }

    public function setCaffeineAttribute($value)
    {
        $this->attributes['caffeine'] = round($value * 100);
    }
}
