<?php

namespace App\Models;

/**
 * App\Models\Setting.
 *
 * @property int $id
 * @property string $key
 * @property string $value
 */
class Setting extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'settings';

    public $timestamps = false;

    protected $fillable = ['key', 'value'];

    public static array $validationRules = [
        'key' => 'required|string|between:1,255',
        'value' => 'string',
    ];
}
