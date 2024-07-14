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
}
