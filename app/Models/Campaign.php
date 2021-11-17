<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Campaign extends Model
{
    use HasFactory;
    use MediaAlly;

    // protected $guarded = [];
    // // Table
    // protected $table = 'campaigns';

    // // Primary Key
    // public $primaryKey = 'id';

    // // Time Stamp
    // public $timestamps = true;

    // //Model relationship
    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }
}
