<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Collection;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
