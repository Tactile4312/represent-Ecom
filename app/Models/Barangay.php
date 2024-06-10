<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'refbrgy';
    protected $primaryKey = 'brgyCode';
    public $incrementing = false;
    protected $keyType = 'string';

    public function city()
    {
        return $this->belongsTo(City::class, 'citymunCode', 'citymunCode');
    }
}
