<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function content()
    {
        return $this->belongsToMany(Content::class);
    }
}
