<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait OrderIdTrait
{
    public static function bootOrderIdTrait(): void
    {
        static::creating(function ($model) {
            $model->order_id = (string) Str::uuid();
        });
    }
}
