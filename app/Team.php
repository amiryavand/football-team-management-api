<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'type', 'rank'];

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }
}
