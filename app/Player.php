<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = ['first_name', 'last_name', 'age', 'weight', 'height', 'market_value'];

    protected $casts = [
        'post' => 'array'
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
