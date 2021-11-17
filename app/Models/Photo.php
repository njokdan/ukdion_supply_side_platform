<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Photo extends Model
{
    use HasFactory;
    use MediaAlly;


    //Model relationship
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\Campaign');
    // }
}
