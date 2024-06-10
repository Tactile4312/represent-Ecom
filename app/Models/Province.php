<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'refprovince';
    protected $primaryKey = 'provCode';
    public $incrementing = false;
    protected $keyType = 'string';

    public function cities()
    {
        return $this->hasMany(City::class, 'provCode', 'provCode');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'regCode', 'regCode');
    }
}
