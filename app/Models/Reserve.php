<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'user_id',
        'reserve_date',
        'reserve_time',
        'restrant_id',
        'people_num',
        'visit_at',
        'liquid_id',
    ];

    public function restrant()
    {
        return $this->belongsTo('App\Models\Restrant');
    }

    public function review()
    {
        return $this->hasOne('App\Models\Review');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}