<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GCashDetail extends Model
{

    protected $table = 'gcash_details'; // Ensure this matches the table name in the database

    protected $fillable = ['number', 'qr_code_path'];
}

