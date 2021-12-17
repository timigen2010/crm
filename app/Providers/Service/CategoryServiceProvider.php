<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Category\CategoryBadgeController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Category\CategoryImageController;
use App\Http\Controllers\Api\Category\CategoryMenuController;
use App\Model\Category\Service\Badge\Delete\BadgeDelete;
use App\Model\Category\Service\Badge\Delete\BadgeDeleteInterface;
use App\Model\Category\Service\Badge\Factory\BadgeFactory;
use App\Model\Category\Service\Badge\Factory\BadgeFactoryAbstract;
use App\Model\Category\Service\Badge\Get\GetBadges;
use App\Model\Category\Service\Badge\Get\GetBadgesInterface;
use App\Model\Category\Service\Delete\CategoryDelete;
use App\Model\Category\Service\Delete\CategoryDeleteInterface;
use App\Model\Category\Service\Factory\CategoryFactory;
use App\Model\Category\Service\Factory\CategoryFactoryAbstract;
use App\Model\Category\Service\Get\GetCategoriesByParams\GetCategories;
use App\Model\Category\Service\Get\GetByMenu\GetCategories as GetCategoriesByMenu;
use App\Model\Category\Service\Get\GetCategoriesInterface;
use App\Model\Category\Service\Image\Delete\ImageDelete;
use App\Model\Category\Service\Image\Delete\ImageDeleteInterface;
use App\Model\Category\Service\Image\Factory\ImageFactory;
use App\Model\Category\Service\Image\Factory\ImageFactoryInterface;
use App\Service\File\Delete\FileDeleteInterface;
use App\Service\File\Delete\FileDeletePublicDisk;
use App\Service\File\Upload\UploadFile;
use App\Service\File\Upload\UploadFileInterface;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(CategoryDelete::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);

        $this->app->when(CategoryController::class)
            ->needs(CategoryFactoryAbstract::class)
            ->give(CategoryFactory::class);

        $this->app->when(CategoryController::class)
            ->needs(CategoryDeleteInterface::class)
            ->give(CategoryDelete::class);

        $this->app->when(CategoryController::class)
            ->needs(GetCategoriesInterface::class)
            ->give(GetCategories::class);

        $this->app->when(BadgeDelete::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);

        $this->app->when(CategoryBadgeController::class)
            ->needs(BadgeFactoryAbstract::class)
            ->give(BadgeFactory::class);

        $this->app->when(CategoryBadgeController::class)
            ->needs(BadgeDeleteInterface::class)
            ->give(BadgeDelete::class);

        $this->app->when(CategoryBadgeController::class)
            ->needs(GetBadgesInterface::class)
            ->give(GetBadges::class);

        $this->app->when(CategoryBadgeController::class)
            ->needs(UploadFileInterface::class)
            ->give(UploadFile::class);

        $this->app->when(CategoryBadgeController::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);

        $this->app->when(ImageDelete::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);

        $this->app->when(CategoryImageController::class)
            ->needs(ImageDeleteInterface::class)
            ->give(ImageDelete::class);

        $this->app->when(CategoryImageController::class)
            ->needs(UploadFileInterface::class)
            ->give(UploadFile::class);

        $this->app->when(CategoryImageController::class)
            ->needs(ImageFactoryInterface::class)
            ->give(ImageFactory::class);

        $this->app->when(CategoryMenuController::class)
            ->needs(GetCategoriesInterface::class)
            ->give(GetCategoriesByMenu::class);
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
