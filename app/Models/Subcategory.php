<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    public $table = 'categories';


    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function subcategories()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

}
