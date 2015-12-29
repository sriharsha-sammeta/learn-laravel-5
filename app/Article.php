<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
        'published_at'
    ];

    protected $dates = ['published_at'];

    /*
     * for setting published_at attribute
     *
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = ($date > date('Y-m-d')) ? Carbon::parse($date) : Carbon::createFromFormat('Y-m-d', $date);
    }

    public function scopePublished($query, $op)
    {
        return $query->where('published_at', $op, Carbon::now());
    }
}
