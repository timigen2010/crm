<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\Product\ProductImageResource;
use App\Model\Product\Entity\Product;
use App\Model\Product\Entity\ProductImage;
use App\Model\Product\Service\Image\Delete\ImageDeleteInterface;
use App\Model\Product\Service\Image\Factory\ImageFactoryInterface;
use App\Model\Product\Service\Image\Factory\Data as ImageFactoryData;
use App\Service\File\Upload\UploadFileInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class ProductImageController extends BaseController
{
    private UploadFileInterface $uploadFile;
    private ImageDeleteInterface $imageDelete;
    private ImageFactoryInterface $imageFactory;

    public function __construct(UploadFileInterface $uploadFile,
                                ImageDeleteInterface $imageDelete,
                                ImageFactoryInterface $imageFactory)
    {
        $this->uploadFile = $uploadFile;
        $this->imageDelete = $imageDelete;
        $this->imageFactory = $imageFactory;
    }

    /**
     * @SWG\Post(
     *     path="api/products/{product_id}/images/upload",
     *     tags={"Products"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImageRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Upload image for product",
     *         @SWG\Schema(type="string")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Product $product
     * @param ImageRequest $request
     * @return string
     */
    public function uploadImageAction(Product $product, ImageRequest $request)
    {
        $path = $this->uploadFile->upload($request, 'image', "products/{$product->product_id}");
        return new ProductImageResource($this->imageFactory->create(
            new ImageFactoryData($product->product_id, $path))
        );
    }

    /**
     * @SWG\Delete(
     *     path="api/products/images/{product_image_id}/delete",
     *     tags={"Products"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImagePathRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Delete image of product",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ProductImage $productImage
     * @return JsonResponse
     */
    public function deleteImageAction(ProductImage $productImage)
    {
        $this->imageDelete->delete($productImage);
        return new JsonResponse(true);
    }
}
