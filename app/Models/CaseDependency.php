<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseDependency extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Define the table if it's not the default 'case_dependencies'
    protected $table = 'case_dependencies';

    public function caseRegistration()
    {
        return $this->belongsTo(CaseRegistration::class, 'regid');
    }

    public function interimJudgements()
    {
        return $this->hasMany(InterimJudgement::class, 'regid', 'regid');
    }

    public function matchingInterimJudgements()
    {
        return $this->hasMany(InterimJudgement::class, 'regid', 'regid')
            ->whereColumn('dol', '=', 'case_dependencies.dol');
    }
}
