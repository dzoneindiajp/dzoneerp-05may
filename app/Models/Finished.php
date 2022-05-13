<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finished extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function processing(){
        return $this->belongsTo(Processing::class,'processing_id');
    }
}
