<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = [
        'betting_id',
        'title',
        'date_start',
        'date_end'
    ];

    public function betting()
    {
        return $this->belongsTo('App\Betting','betting_id');
    }
    public function getBettingTitleAttribute()
    {
        return $this->betting->title;
    }
    public function getDateStartAttribute($value)
    {
        return date("d/m/Y", strtotime(str_replace('-','/',$value)));
    }
    public function getDateEndAttribute($value)
    {
         return date("d/m/Y", strtotime(str_replace('-','/',$value)));
      
    }

}
