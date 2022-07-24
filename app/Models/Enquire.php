<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
    use HasFactory;
    protected $table = 'enquire';
    protected $filliable= ['name', 'email', 'phone', 'message'];
}
