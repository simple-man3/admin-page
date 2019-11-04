<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\SystemSettings
 *
 * @property int $id
 * @property string $name Название настройки
 * @property array $value Значение настройки
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SystemSettings whereValue($value)
 * @mixin \Eloquent
 */
class SystemSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'array',
    ];
}
