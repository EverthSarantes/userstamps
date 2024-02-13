<?php

namespace Everth\UserStamps\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class UserStampsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Blueprint::macro('nullableUserStamps', function () {
            $this->unsignedBigInteger('created_by')->nullable();
            $this->unsignedBigInteger('updated_by')->nullable();
            $this->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $this->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });

        Blueprint::macro('userStamps', function () {
            $this->unsignedBigInteger('created_by');
            $this->unsignedBigInteger('updated_by')->nullable();
            $this->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $this->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function boot(): void
    {
        // Puedes agregar cualquier código de arranque aquí
    }
}
