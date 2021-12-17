<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Requests\Category\CategoryBadgeRequest;
use App\Http\Requests\ImagePathRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Resources\Category\CategoryBadgeResource;
use App\Model\Category\Entity\CategoryBadge;
use App\Model\Category\Service\Badge\Delete\BadgeDeleteInterface;
use App\Model\Category\Service\Badge\Factory\BadgeFactoryAbstract;
use App\Model\Category\Service\Badge\Factory\Data as BadgeFactoryData;
use App\Model\Category\Service\Badge\Get\GetBadgesInterface;
use App\Service\File\Delete\FileDeleteInterface;
use App\Service\File\Upload\UploadFileInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;

class CategoryBadgeController extends BaseController
{
    private BadgeFactoryAbstract $badgeFactory;

    private BadgeDeleteInterface $badgeDelete;

    private GetBadgesInterface $getBadges;

    private UploadFileInterface $uploadFile;

    private FileDeleteInterface $deleteFile;

    public function __construct(BadgeFactoryAbstract $badgeFactory,
                                BadgeDeleteInterface $badgeDelete,
                                GetBadgesInterface $getBadges,
                                UploadFileInterface $uploadFile,
                                FileDeleteInterface $deleteFile)
    {
        $this->badgeFactory = $badgeFactory;
        $this->badgeDelete = $badgeDelete;
        $this->getBadges = $getBadges;
        $this->uploadFile = $uploadFile;
        $this->deleteFile = $deleteFile;
    }


    /**
     * @SWG\Post(
     *     path="api/categories/badges/new",
     *     tags={"Category badges"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CategoryBadgeRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create category badge",
     *         @SWG\Schema(ref="#/definitions/CategoryBadgeResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CategoryBadgeRequest $request
     * @return CategoryBadgeResource
     */
    public function createAction(CategoryBadgeRequest $request)
    {
        $badge = $this->badgeFactory->create(new BadgeFactoryData(
            $request->request->get('code'),
            $request->request->get('image') ?? "",
        ));
        return new CategoryBadgeResource($badge);
    }

    /**
     * @SWG\Put(
     *     path="api/categories/badges/edit/{badge_id}",
     *     tags={"Category badges"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CategoryBadgeRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit badge by id",
     *         @SWG\Schema(ref="#/definitions/CategoryBadgeResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CategoryBadge $badge
     * @param CategoryBadgeRequest $request
     * @return CategoryBadgeResource
     */
    public function editAction(CategoryBadge $badge, CategoryBadgeRequest $request)
    {
        $badge = $this->badgeFactory->create(new BadgeFactoryData(
            $request->request->get('code'),
            $request->request->get('image') ?? "",
        ), $badge);
        return new CategoryBadgeResource($badge);
    }

    /**
     * @SWG\Delete(
     *     path="api/categories/badges/delete/{badge_id}",
     *     tags={"Category badges"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete badge by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CategoryBadge $badge
     * @return JsonResponse
     */
    public function deleteAction(CategoryBadge $badge)
    {
        $this->badgeDelete->delete($badge);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/categories/badges",
     *     tags={"Category badges"},
     *     @SWG\Response(
     *         response=200,
     *         description="Get all badges",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/CategoryBadgeResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @return AnonymousResourceCollection
     */
    public function getBadgesAction()
    {
        return CategoryBadgeResource::collection($this->getBadges->getBadges([]));
    }

    /**
     * @SWG\Get(
     *     path="api/categories/badges/show/{badge_id}",
     *     tags={"Category badges"},
     *     @SWG\Response(
     *         response=200,
     *         description="Show badge by id",
     *         @SWG\Schema(ref="#/definitions/CategoryBadgeResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param CategoryBadge $badge
     * @return CategoryBadgeResource
     */
    public function getShowAction(CategoryBadge $badge)
    {
        return new CategoryBadgeResource($badge);
    }

    /**
     * @SWG\Post(
     *     path="api/categories/badges/images/upload",
     *     tags={"Category badges"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImageRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Upload image for badge",
     *         @SWG\Schema(type="string")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ImageRequest $request
     * @return string
     */
    public function uploadImageAction(ImageRequest $request)
    {
        return new JsonResponse(
            $this->uploadFile->upload($request, 'image', "category_badges")
        );
    }

    /**
     * @SWG\Post(
     *     path="api/categories/badges/images/delete",
     *     tags={"Category badges"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImagePathRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Delete image of badge",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param ImagePathRequest $request
     * @return string
     */
    public function deleteImageAction(ImagePathRequest $request)
    {
        $this->deleteFile->delete($request->request->get('path'));
        return new JsonResponse(true);
    }
}
