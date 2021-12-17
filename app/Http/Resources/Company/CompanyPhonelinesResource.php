<?php

namespace App\Http\Resources\Company;

use App\Model\Company\Entity\Company;
use App\Model\Company\Entity\Phoneline\CompanyPhonelineDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $company_phoneline_id
 * @property Company $company
 * @property string $keyword
 * @property CompanyPhonelineDescription $description
 * @method getName(?int $languageId = null)
 */
class CompanyPhonelinesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CompanyPhonelinesResource",
     *     type="object",
     *     @SWG\Property(property="companyPhonelineId", type="integer"),
     *     @SWG\Property(property="company", type="object",
     *          @SWG\Property(property="companyId", type="integer"),
     *          @SWG\Property(property="name", type="string")
     *     ),
     *     @SWG\Property(property="keyword", type="string"),
     *     @SWG\Property(property="description", type="object",
     *          @SWG\Property(property="name", type="string")
     *     ),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'companyPhonelineId' => $this->company_phoneline_id,
            'company' => [
                'companyId' => $this->company->company_id,
                'name' => $this->company->getName($request->query->get('languageId')),
            ],
            'keyword' => $this->keyword,
            'description' => [
                'name' => $this->getName($request->query->get('languageId')),
            ],
        ];
    }
}
