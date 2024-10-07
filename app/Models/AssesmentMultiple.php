<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssesmentMultiple extends Model
{
    use HasFactory;

    protected $table = 't_assesment_multiple';
    
    // Menentukan kolom yang dapat diisi
    protected $fillable = [
        'story_id',
        'question',
        'opt_1',
        'opt_2',
        'opt_3',
        'opt_4',
        'answer',
    ];

    public $timestamps = false;

    protected $primaryKey = 'id_asses';

     public function story()
    {
        return $this->belongsTo(Story::class, 'story_id', 'story_id');
    }
}
