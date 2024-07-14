<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudgementThree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getCorumDescriptionsAttribute()
    {
        $corumIds = explode(',', $this->corum);
        return Corum::whereIn('id', $corumIds)->pluck('name')->toArray();
    }
}
