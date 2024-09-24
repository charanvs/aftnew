<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseRegistration extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Define the relationship with CaseDependency
    public function caseDependencies()
    {
        return $this->hasMany(CaseDependency::class, 'regid');
    }

    public function caseDependency()
    {
        return $this->hasOne(CaseDependency::class, 'regid', 'id');
    }

    public function interimJudgements()
    {
        return $this->hasMany(InterimJudgement::class, 'regid', 'id')
            ->orderByRaw("STR_TO_DATE(dol, '%d-%m-%Y') ASC");
    }

    
}
