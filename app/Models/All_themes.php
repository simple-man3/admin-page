<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\All_themes
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name_dir
 * @property string $name_theme
 * @property string $name_author
 * @property string $description_theme
 * @property int $use_theme
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereDescriptionTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereNameAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereNameDir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereNameTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\All_themes whereUseTheme($value)
 */
class All_themes extends Model
{
    protected $fillable = [
        'name_dir',
        'name_theme',
        'name_author',
        'description_theme',
        'use_theme',
    ];
}
