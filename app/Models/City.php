<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'refcitymun';
    protected $primaryKey = 'citymunCode';
    public $incrementing = false;
    protected $keyType = 'string';

    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'citymunCode', 'citymunCode');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provCode', 'provCode');
    }
}
