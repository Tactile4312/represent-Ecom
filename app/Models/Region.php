<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'refregion';
    protected $primaryKey = 'regCode';
    public $incrementing = false;
    protected $keyType = 'string';

    public function provinces()
    {
        return $this->hasMany(Province::class, 'regCode', 'regCode');
    }
}
