<?php

namespace App\Providers\Service;

use App\Http\Controllers\Api\Product\ForeignProductCPFCController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Product\ProductCPFCController;
use App\Http\Controllers\Api\Product\ProductImageController;
use App\Http\Controllers\Api\Product\ProductMenuController;
use App\Http\Controllers\Api\Product\ProductTypeController;
use App\Http\Controllers\Api\Report\ProductComplect\ProductComplectController;
use App\Model\DB\Service\GetIdsByForeignIds\GetIdsByForeignIds;
use App\Model\DB\Service\GetIdsByForeignIds\GetIdsByForeignIdsInterface;
use App\Model\Product\Service\CPFC\Calculate\Calculate;
use App\Model\Product\Service\CPFC\Calculate\CalculateInterface;
use App\Model\Product\Service\CPFC\Edit\EditCPFC;
use App\Model\Product\Service\CPFC\Edit\EditCPFCInterface;
use App\Model\Product\Service\CPFC\Factory\CPFCFactory;
use App\Model\Product\Service\CPFC\Factory\CPFCFactoryAbstract;
use App\Model\Product\Service\CPFC\GetByProductId\GetCPFCByForeignProductId;
use App\Model\Product\Service\CPFC\GetByProductId\GetCPFCByProductId;
use App\Model\Product\Service\CPFC\GetByProductId\GetCPFCByProductIdInterface;
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByForeignProductIds;
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByProductIds;
use App\Model\Product\Service\CPFC\GetByProductIds\GetCPFCByProductIdsInterface;
use App\Model\Product\Service\Delete\ProductDelete;
use App\Model\Product\Service\Delete\ProductDeleteInterface;
use App\Model\Product\Service\Factory\ProductFactory;
use App\Model\Product\Service\Factory\ProductFactoryAbstract;
use App\Model\Product\Service\Get\GetByCategories\GetProductsByCategories;
use App\Model\Product\Service\Get\GetByCategories\GetProductsByCategoriesInterface;
use App\Model\Product\Service\Get\GetProductsByParams\GetProducts;
use App\Model\Product\Service\Get\GetByMenu\GetProducts as GetProductByMenu;
use App\Model\Product\Service\Get\GetProductsInterface;
use App\Model\Product\Service\Image\Delete\ImageDelete;
use App\Model\Product\Service\Image\Delete\ImageDeleteInterface;
use App\Model\Product\Service\Image\Factory\ImageFactory;
use App\Model\Product\Service\Image\Factory\ImageFactoryInterface;
use App\Model\Product\Service\ProductType\Get\GetProductTypes;
use App\Model\Product\Service\ProductType\Get\GetProductTypesInterface;
use App\Model\Report\ProductComplect\Service\Get\GetProductComplectsByParams\GetProductComplects;
use App\Model\Report\ProductComplect\Service\Get\GetProductComplectsInterface;
use App\Service\File\Delete\FileDeleteInterface;
use App\Service\File\Delete\FileDeletePublicDisk;
use App\Service\File\Upload\UploadFile;
use App\Service\File\Upload\UploadFileInterface;
use App\Service\Product\CreateUpdate\CreateUpdateInterface;
use App\Service\Product\CreateUpdate\CreateUpdateService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ProductController::class)
            ->needs(ProductDeleteInterface::class)
            ->give(ProductDelete::class);

        $this->app->when(ProductDelete::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);

        $this->app->when(ProductController::class)
            ->needs(GetProductsInterface::class)
            ->give(GetProducts::class);

        $this->app->when(ProductController::class)
            ->needs(CreateUpdateInterface::class)
            ->give(CreateUpdateService::class);

        $this->app->when(CreateUpdateService::class)
            ->needs(ProductFactoryAbstract::class)
            ->give(ProductFactory::class);

        $this->app->when(ProductImageController::class)
            ->needs(UploadFileInterface::class)
            ->give(UploadFile::class);

        $this->app->when(ProductImageController::class)
            ->needs(ImageDeleteInterface::class)
            ->give(ImageDelete::class);

        $this->app->when(ProductImageController::class)
            ->needs(ImageFactoryInterface::class)
            ->give(ImageFactory::class);

        $this->app->when(ImageDelete::class)
            ->needs(FileDeleteInterface::class)
            ->give(FileDeletePublicDisk::class);

        $this->app->when(ProductTypeController::class)
            ->needs(GetProductTypesInterface::class)
            ->give(GetProductTypes::class);

        $this->app->when(ProductMenuController::class)
            ->needs(GetProductsInterface::class)
            ->give(GetProductByMenu::class);

        $this->app->when(ProductComplectController::class)
            ->needs(GetProductComplectsInterface::class)
            ->give(GetProductComplects::class);

        $this->app->when(ProductCPFCController::class)
            ->needs(CPFCFactoryAbstract::class)
            ->give(CPFCFactory::class);

        $this->app->when(ProductCPFCController::class)
            ->needs(EditCPFCInterface::class)
            ->give(EditCPFC::class);

        $this->app->when(EditCPFC::class)
            ->needs(CPFCFactoryAbstract::class)
            ->give(CPFCFactory::class);

        $this->app->when(EditCPFC::class)
            ->needs(CalculateInterface::class)
            ->give(Calculate::class);

        $this->app->when(Calculate::class)
            ->needs(CPFCFactoryAbstract::class)
            ->give(CPFCFactory::class);

        $this->app->when(ProductCPFCController::class)
            ->needs(GetCPFCByProductIdsInterface::class)
            ->give(GetCPFCByProductIds::class);

        $this->app->when(ForeignProductCPFCController::class)
            ->needs(GetCPFCByProductIdsInterface::class)
            ->give(GetCPFCByProductIds::class);

        $this->app->when(ForeignProductCPFCController::class)
            ->needs(GetCPFCByProductIdInterface::class)
            ->give(GetCPFCByProductId::class);

        $this->app->when(ProductController::class)
            ->needs(GetProductsByCategoriesInterface::class)
            ->give(GetProductsByCategories::class);

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
