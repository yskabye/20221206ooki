<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restrant extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'name',
        'area_id',
        'ganre_id',
        'overview',
        'image',
        'period',
        'limit',
        'holiday',
        'rsv_start',
        'rsv_end',
        'timespan',
        'rsv_min',
        'rsv_max'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}