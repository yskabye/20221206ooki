<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'restrant_id',
        'subject',
        'message',
        'send_at',
    ];

    public function restrant()
    {
        return $this->belongsTo('App\Models\Restrant');
    }
}
