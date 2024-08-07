<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Judgement extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCorumDescriptionsAttribute()
    {
        $corumIds = explode(',', $this->corum);
        return Corum::whereIn('id', $corumIds)->pluck('name')->toArray();
    }

    public function disposed()
    {
        return $this->hasOne(Disposed::class, 'regno', 'regno');
    }

    // Method to get related interim judgments
    public function getInterimJudgements()
    {
        // Access the associated Disposed record
        $disposed = $this->disposed;

        // Check if the disposed record exists
        if ($disposed) {
            // Fetch related interim judgments using regid from the disposed record
            $interimJudgements = DB::table('interim_judgements')
                ->where('regid', $disposed->regid)
                ->orderByRaw("STR_TO_DATE(dol, '%d-%m-%Y') ASC")
                ->get();

            return $interimJudgements;
        }

        // Return an empty collection if no disposed record was found
        return collect();
    }
}
