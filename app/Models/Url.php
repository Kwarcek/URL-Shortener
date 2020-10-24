<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    /**
     * Database fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'original_url',
        'shorten_url',
        'user_id',
        'title'
    ];

    /**
     * Append to query path data
     *
     * @var array
     */
    protected $appends = ['path'];

    /**
     * Created automatically shorten_url on creating Url
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($url) {
            $url->shorten_url = Str::random(6);
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

    /**
     * Change created_at to human friendly version
     *
     * @param string
     *
     * @return Carbon
     */
    public function getCreatedAtAttribute(string $value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * Customizing original_url
     *
     * @return void
     */
    public function getPathAttribute()
    {
        return asset("u/$this->shorten_url");
    }
}
