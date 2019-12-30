<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    protected $fillable=['title','active','content'];
}
