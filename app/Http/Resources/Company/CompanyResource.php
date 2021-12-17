<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Product\ProductResource;
use App\Model\Category\Entity\Category;
use App\Model\Company\Entity\CompanyDescription;
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
 * @property Collection<CompanyDescription> $descriptions
 */
class CompanyResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CompanyResource",
     *     type="object",
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="isAdmin", type="boolean"),
     *     @SWG\Property(property="url", type="string"),
     *     @SWG\Property(property="ssl", type="string"),
     *     @SWG\Property(property="settings", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="companySettingId", type="integer"),
     *              @SWG\Property(property="code", type="string"),
     *              @SWG\Property(property="key", type="string"),
     *              @SWG\Property(property="value", type="string"),
     *              @SWG\Property(property="isSerialized", type="boolean")
     *          )
     *     ),
     *     @SWG\Property(property="descriptions", type="array",
     *          @SWG\Items(type="object",
     *              @SWG\Property(property="companyDescriptionId", type="integer"),
     *              @SWG\Property(property="languageId", type="integer"),
     *              @SWG\Property(property="name", type="string"),
     *              @SWG\Property(property="longName", type="string"),
     *              @SWG\Property(property="keyword", type="string")
     *          )
     *     )
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
            'settings' => $this->settings->map(
                function (CompanySetting $setting) {
                    return [
                        'companySettingId' => $setting->company_setting_id,
                        'code' => $setting->code,
                        'key' => $setting->key,
                        'value' => $setting->value,
                        'isSerialized' => $setting->is_serialized,
                    ];
                }),
            'descriptions' => $this->descriptions->map(
                function (CompanyDescription $description) {
                    return [
                        'companyDescriptionId' => $description->company_description_id,
                        'languageId' => $description->language_id,
                        'name' => $description->name,
                        'longName' => $description->long_name,
                        'keyword' => $description->keyword,
                    ];
                }),
            'productConstructors' => $this->productConstructors->map(
                function (ProductConstructor $productConstructor){
                    return [
                        'basis' => new CategoryResource($productConstructor->basis),
                        'mainProduct' => new ProductResource($productConstructor->mainProduct),
                        'sauce' => new CategoryResource($productConstructor->sauce),
                        'status' => $productConstructor->status,
                        'deleted' => $productConstructor->deleted,
                        'toppings' => $productConstructor->toppings->map(
                            function (Category $topping){
                                return [
                                    'categoryId' => $topping->category_id,
                                    'name' => $topping->getName()
                                ];
                            }
                        )
                    ];
                })
        ];
    }
}
