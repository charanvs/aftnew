<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scuritinies()
    {
        return $this->belongsTo(Scrutiny::class, 'sid');
    }
}
