<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposed extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function interimJudgements()
    {
        return $this->hasMany(InterimJudgement::class, 'regid', 'regid');
    }
}
