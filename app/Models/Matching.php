<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matching extends Model
{
    use HasFactory;

    protected $table = 't_assesment_matching'; 

    protected $fillable = [
        'story_id',
        'picture_1',
        'picture_2',
        'picture_3',
        'name_1',
        'name_2',
        'name_3',

    ];

    public $timestamps = false;

    protected $primaryKey = 'id_asses'; // Primary key di tabel

    // Relasi ke model Story
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id', 'story_id');
    }
}
