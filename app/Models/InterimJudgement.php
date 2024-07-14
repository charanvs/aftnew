<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterimJudgement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function caseDependency()
    {
        return $this->belongsTo(CaseDependency::class, 'regid', 'regid');
    }
}
