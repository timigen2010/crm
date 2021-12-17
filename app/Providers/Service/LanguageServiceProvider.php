<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Language\LanguageController;
use App\Model\Language\Service\Delete\LanguageDelete;
use App\Model\Language\Service\Delete\LanguageDeleteInterface;
use App\Model\Language\Service\Factory\LanguageFactory;
use App\Model\Language\Service\Factory\LanguageFactoryInterface;
use App\Model\Language\Service\Get\GetLanguages\GetLanguages;
use App\Model\Language\Service\Get\GetLanguagesInterface;
use App\Service\File\Delete\FileDeleteInterface;
use App\Service\File\Delete\FileDeletePublicDisk;
use App\Service\File\Upload\UploadFile;
use App\Service\File\Upload\UploadFileInterface;
use Illuminate\Support\ServiceProvider;

class LanguageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(LanguageController::class)
            ->needs(LanguageFactoryInterface::class)
            ->give(LanguageFactory::class);

        $this->app->when(LanguageController::class)
            ->needs(LanguageDeleteInterface::class)
            ->give(LanguageDelete::class);

        $this->app->when(LanguageController::class)
            ->needs(GetLanguagesInterface::class)
            ->give(GetLanguages::class);

        $this->app->when(LanguageController::class)
            ->needs(UploadFileInterface::class)
            ->give(UploadFile::class);

        $this->app->when(LanguageController::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
