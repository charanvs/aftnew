<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasePdf extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_number',
        'petitioner',
        'respondent',
        'petitioner_advocate',
        'respondent_advocate',
        'date',
        'type',
        'corum_id',
    ];

    public function corums()
    {
        return $this->belongsToMany(Corum::class, 'case_corum');
    }
}
