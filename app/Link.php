<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'url', 'short_url', 'user_id',
    ];

    public function stats()
	{
		return $this->hasMany(Statistic::class);
	}

    public function addView()
    {
        $this->views++;
        $this->save();
    }

    public function getRouteKeyName()
	{
	    return 'short_url';
	}
}