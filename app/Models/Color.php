<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public $table = 'colors';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'color_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
