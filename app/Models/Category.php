<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function content()
    {
        return $this->belongsToMany(Content::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillable=['name','active'];
}
