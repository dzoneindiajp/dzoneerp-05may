<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public $table = 'sizes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'size_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /*public function products()
    {
        return $this->belongsToMany(Product::class);
    }*/
}
