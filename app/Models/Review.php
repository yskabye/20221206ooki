<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'reserve_id',
        'values',
        'comment',
    ];

    public function restrant()
    {
        return $this->belongsTo('App\Models\Restrant');
    }
}
