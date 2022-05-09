<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Symfony\Component\String\b;

class Supplier extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
