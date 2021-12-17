<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Requests\Category\CategoryImageRequest;
use App\Http\Resources\Category\CategoryImageResource;
use App\Model\Category\Entity\Category;
use App\Model\Category\Entity\CategoryImage;
use App\Model\Category\Service\Image\Delete\ImageDeleteInterface;
use App\Model\Category\Service\Image\Factory\ImageFactoryInterface;
use App\Model\Category\Service\Image\Factory\Data as ImageFactoryData;
use App\Service\File\Upload\UploadFileInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CategoryImageController extends BaseController
{
    private ImageFactoryInterface $imageFactory;

    private ImageDeleteInterface $imageDelete;

    private UploadFileInterface $uploadFile;

    public function __construct(ImageFactoryInterface $imageFactory,
                                ImageDeleteInterface $imageDelete,
                                UploadFileInterface $uploadFile)
    {
        $this->imageFactory = $imageFactory;
        $this->imageDelete = $imageDelete;
        $this->uploadFile = $uploadFile;
    }

    /**
     * @SWG\Post(
     *     path="api/categories/{category_id}/images/upload",
     *     tags={"Categories"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CategoryImageRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Upload image for category",
     *         @SWG\Schema(ref="#/definitions/CategoryImageResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Category $category
     * @param CategoryImageRequest $request
     * @return string
     */
    public function uploadImageAction(Category $category, CategoryImageRequest $request)
    {
        $path = $this->uploadFile->upload($request, 'image', "categories/{$category->category_id}");
        return new CategoryImageResource($this->imageFactory->create(
            new ImageFactoryData($category->category_id, $path, $request->request->get('imageType')))
        );
    }

    /**
     * @SWG\Delete(
     *     path="api/categories/images/{category_image_id}/delete",
     *     tags={"Categories"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImagePathRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Delete image of category",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CategoryImage $categoryImage
     * @return JsonResponse
     */
    public function deleteImageAction(CategoryImage $categoryImage)
    {
        $this->imageDelete->delete($categoryImage);
        return new JsonResponse(true);
    }
}
