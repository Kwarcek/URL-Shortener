<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'original_url', 'shorten_url'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function($url){
            $url->shorten_url = Str::random();
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'shorten_url';
    }
}
