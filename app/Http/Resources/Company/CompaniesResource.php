<?php

namespace App\Http\Resources\Company;

use App\Model\Company\Entity\CompanySetting;
use App\Model\Product\Entity\ProductConstructor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Support\Collection;

/**
 * @property int $company_id
 * @property bool $is_admin
 * @property string $url
 * @property string $ssl
 * @property Collection<CompanySetting> $settings
 * @method getName(?int $languageId = null)
 */
class CompaniesResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CompaniesResource",
     *     type="object",
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="isAdmin", type="boolean"),
     *     @SWG\Property(property="url", type="string"),
     *     @SWG\Property(property="ssl", type="string"),
     *     @SWG\Property(property="name", type="string"),
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'companyId' => $this->company_id,
            'isAdmin' => $this->is_admin,
            'url' => $this->url,
            'ssl' => $this->ssl,
            'name' => $this->getName($request->query->get('languageId')),
            'productConstructors' => $this->productConstructors->map(
                function (ProductConstructor $productConstructor) {
                    return [
                        'productConstructorId' => $productConstructor->product_constructor_id,
                        'mainProduct' => $productConstructor->mainProduct,
                        'basis' => $productConstructor->basis,
                        'sauce' => $productConstructor->sauce,
                        'toppings' => $productConstructor->toppings,
                        'status' => $productConstructor->status,
                        'deleted' => $productConstructor->deleted
                    ];
                })
        ];
    }
}
