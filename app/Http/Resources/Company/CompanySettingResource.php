<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;

/**
 * @property int $company_setting_id
 * @property int $company_id
 * @property string $code
 * @property string $key
 * @property string $value
 * @property bool $is_serialized
 */
class CompanySettingResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="CompanySettingResource",
     *     type="object",
     *     @SWG\Property(property="companySettingId", type="integer"),
     *     @SWG\Property(property="companyId", type="integer"),
     *     @SWG\Property(property="code", type="string"),
     *     @SWG\Property(property="key", type="string"),
     *     @SWG\Property(property="value", type="string"),
     *     @SWG\Property(property="isSerialized", type="boolean"),
     *  )
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'companySettingId' => $this->company_setting_id,
            'companyId' => $this->company_id,
            'code' => $this->code,
            'key' => $this->key,
            'value' => $this->value,
            'isSerialized' => $this->is_serialized,
        ];
    }
}
