<?php

namespace Everth\UserStamps;
use Illuminate\Support\Facades\Auth;

trait UserStampsTrait
{
    protected static function bootUserStampsTrait()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}
