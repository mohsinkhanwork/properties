<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    
  protected $table = 'slider';
  protected $fillable = ['slider_title','slider_text2','slider_text2','image_name'];
}
