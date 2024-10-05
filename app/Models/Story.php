<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = 'm_story';
    protected $fillable = [
        'title',
        'desc',
        'province',
        'cover',
        'status',
    ];
    public $timestamps = false;
    protected $primaryKey = 'story_id';

}
