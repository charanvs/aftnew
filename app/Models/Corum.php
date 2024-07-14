<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corum extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'designation'];

    public function cases()
    {
        return $this->belongsToMany(CasePdf::class, 'case_corum');
    }
}
