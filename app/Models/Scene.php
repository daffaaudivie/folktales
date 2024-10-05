<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;

    protected $table = 't_scene_story';
    
    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'story_id',
        'picture',
        'narasi',
        'voice_over',
        'order',
    ];

    public $timestamps = false;

    protected $primaryKey = 'scene_story_id';

     public function story()
    {
        return $this->belongsTo(Story::class, 'story_id', 'story_id');
    }
}
