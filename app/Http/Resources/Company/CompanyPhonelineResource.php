<?php

namespace App\Http\Resources\Company;

use App\Model\Company\Entity\Phoneline\CompanyPhonelineDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $company_phoneline_id
 * @property int $company_id
 * @property string $keyword
 * @property Collection<CompanyPhonelineDescription> $descriptions
 */
class CompanyPhonelineResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CompanyPhonelineResource",
     *     type="object",
     *     @SWG\Property(property="companyPhonelineId", type="integer"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="keyword", type="string"),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="companyPhonelineDescriptionId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="languageId", type="integer")
     *          )
     *      ),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'companyPhonelineId' => $this->company_phoneline_id,
            'companyId' => $this->company_id,
            'keyword' => $this->keyword,
            'descriptions' => $this->descriptions->map(
                function (CompanyPhonelineDescription $description) {
                    return [
                        'companyPhonelineDescriptionId' => $description->company_phoneline_description_id,
                        'name' => $description->name,
                        'languageId' => $description->language_id,
                    ];
                })
        ];
    }
}
