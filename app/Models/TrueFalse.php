<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrueFalse extends Model
{
    use HasFactory;

    protected $table = 't_assesment_tf'; 

    // Kolom yang dapat diisi
    protected $fillable = [
        'story_id',
        'question',
        'answer',
        'is_delete',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_asses'; // Primary key di tabel

    // Relasi ke model Story
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id', 'story_id');
    }
}
