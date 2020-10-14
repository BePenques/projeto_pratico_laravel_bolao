<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Betting extends Model
{
    protected $fillable = [
        'user_id',//usuario_id
        'title',//titulo
        'current_round',//rodadaAtual
        'score_points',//pontosResultado
        'extra_points',//pontosExtras
        'rate_points'//pontosTaxa
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }
}

