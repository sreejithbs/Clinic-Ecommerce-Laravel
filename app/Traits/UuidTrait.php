<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    /**
     * Binds creating/saving events to create UUIDs (and also prevent them from being overwritten).
     *
     * @return void
     */
    protected static function bootUuidTrait()
    {
        self::creating(function ($model) {
            $model->unqId = Str::substr( Str::uuid()->toString(), 0, 8 );
        });
    }
}