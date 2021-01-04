<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchUser extends Model//classe responsável pela aposta do usuário
{
    protected $fillable = [
        'match_id',
        'user_id',
        'result',
        'scoreboard_a',
        'scoreboard_b',
        
    ];

    protected $table = 'match_user';
}
