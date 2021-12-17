<?php

namespace App\Http\Controllers\Api\Language;

use App\Http\Requests\ImagePathRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\Language\GetLanguagesRequest;
use App\Http\Requests\Language\LanguageRequest;
use App\Http\Resources\Language\LanguageResource;
use App\Model\Language\Entity\Language;
use App\Model\Language\Service\Delete\LanguageDeleteInterface;
use App\Model\Language\Service\Factory\LanguageFactoryInterface;
use App\Model\Language\Service\Factory\Data as LanguageFactoryData;
use App\Model\Language\Service\Get\GetLanguagesInterface;
use App\Model\Language\Service\Get\GetLanguages\Data as GetLanguagesData;
use App\Service\File\Delete\FileDeleteInterface;
use App\Service\File\Upload\UploadFileInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class LanguageController extends BaseController
{
    private LanguageDeleteInterface $languageDelete;

    private GetLanguagesInterface $getLanguages;

    private UploadFileInterface $uploadFile;

    private FileDeleteInterface $deleteFile;

    private LanguageFactoryInterface $languageFactory;

    public function __construct(LanguageDeleteInterface $languageDelete,
                                GetLanguagesInterface $getLanguages,
                                UploadFileInterface $uploadFile,
                                FileDeleteInterface $deleteFile,
                                LanguageFactoryInterface $languageFactory)
    {
        $this->languageDelete = $languageDelete;
        $this->getLanguages = $getLanguages;
        $this->uploadFile = $uploadFile;
        $this->deleteFile = $deleteFile;
        $this->languageFactory = $languageFactory;
    }


    /**
     * @SWG\Post(
     *     path="api/languages/new",
     *     tags={"Languages"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LanguageRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Create language",
     *         @SWG\Schema(ref="#/definitions/LanguageResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param LanguageRequest $request
     * @return LanguageResource
     */
    public function createAction(LanguageRequest $request)
    {
        $language = $this->languageFactory->create(new LanguageFactoryData(
            $request->request->get('name'),
            $request->request->get('code'),
            $request->request->get('locale'),
            $request->request->get('image'),
            $request->request->get('status'),
        ));
        return new LanguageResource($language);
    }

    /**
     * @SWG\Put(
     *     path="api/languages/{language_id}/edit",
     *     tags={"Languages"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LanguageRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Edit language by id",
     *         @SWG\Schema(ref="#/definitions/LanguageResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Language $language
     * @param LanguageRequest $request
     * @return LanguageResource
     */
    public function editAction(Language $language, LanguageRequest $request)
    {
        if ($language->deleted) {
            throw new NotFoundHttpException('This language was deleted');
        }
        $language = $this->languageFactory->create(new LanguageFactoryData(
            $request->request->get('name'),
            $request->request->get('code'),
            $request->request->get('locale'),
            $request->request->get('image'),
            $request->request->get('status'),
        ), $language);
        return new LanguageResource($language);
    }

    /**
     * @SWG\Delete(
     *     path="api/languages/{language_id}/delete",
     *     tags={"Languages"},
     *     @SWG\Response(
     *         response=200,
     *         description="Delete language by id",
     *         @SWG\Schema(type="boolean")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Language $language
     * @return JsonResponse
     */
    public function deleteAction(Language $language)
    {
        if ($language->deleted) {
            throw new NotFoundHttpException('This language was deleted');
        }
        $this->languageDelete->delete($language);
        return new JsonResponse(true);
    }

    /**
     * @SWG\Get(
     *     path="api/languages",
     *     tags={"Languages"},
     *     @SWG\Parameter(name="orderBy", in="query", required=false, type="string"),
     *     @SWG\Parameter(name="orderDirection", in="query", required=false, type="string"),
     *     @SWG\Response(
     *         response=200,
     *         description="Get all languages",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/LanguageResource")
     *         ),
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param GetLanguagesRequest $request
     * @return AnonymousResourceCollection
     */
    public function getLanguagesAction(GetLanguagesRequest $request)
    {
        return LanguageResource::collection($this->getLanguages->getLanguages(new GetLanguagesData(
            $request->query->get('orderBy'),
            $request->query->get('orderDirection'),
        )));
    }

    /**
     * @SWG\Get(
     *     path="api/languages/{language_id}/show",
     *     tags={"Languages"},
     *     @SWG\Response(
     *         response=200,
     *         description="Language by id",
     *         @SWG\Schema(ref="#/definitions/LanguageResource")
     *      ),
     *      security={{"Bearer": {}, "OAuth2": {}}}
     * )
     * @param Language $language
     * @return LanguageResource
     */
    public function getShowAction(Language $language)
    {
        if ($language->deleted) {
            throw new NotFoundHttpException('This language was deleted');
        }
        return new LanguageResource($language);
    }

    /**
     * @SWG\Post(
     *     path="api/languages/images/upload",
     *     tags={"Languages"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImageRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Upload image for language",
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
            $this->uploadFile->upload($request, 'image', "languages")
        );
    }

    /**
     * @SWG\Post(
     *     path="api/languages/images/delete",
     *     tags={"Languages"},
     *     @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ImagePathRequest")
     *      ),
     *     @SWG\Response(
     *         response=200,
     *         description="Delete image of language",
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
