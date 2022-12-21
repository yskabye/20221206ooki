<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'user_id',
        'restrant_id'
    ];

    public function restrant()
    {
        return $this->belongsTo('App\Models\Restrant');
    }
}