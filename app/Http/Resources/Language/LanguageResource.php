<?php

namespace App\Http\Resources\Language;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $language_id
 * @property string $name
 * @property string $code
 * @property string $locale
 * @property string $image
 * @property boolean $status
 */
class LanguageResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="LanguageResource",
     *     type="object",
     *     @SWG\Property(property="languageId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="locale", type="string"),
     *     @SWG\Property(property="image", type="string"),
     *     @SWG\Property(property="status", type="boolean"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'languageId' => $this->language_id,
            'name' => $this->name,
            'code' => $this->code,
            'locale' => $this->locale,
            'image' => $this->image,
            'status' => $this->status,
        ];
    }
}
