<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyGallery extends Model
{
    use HasFactory;
    protected $table = 'property_gallery';

    protected $fillable = ['property_id','image_name'];
}
