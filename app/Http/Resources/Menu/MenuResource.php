<?php

namespace App\Http\Resources\Menu;

use App\Model\Company\Entity\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Swagger\Annotations as SWG;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $menu_id
 * @property string $name
 * @property Collection<Company> $companies
 */
class MenuResource extends JsonResource
{
    /**
     * @SWG\Definition(
     *     definition="MenuResource",
     *     type="object",
     *     @SWG\Property(property="menuId", type="integer"),
     *     @SWG\Property(property="name", type="string"),
     *     @SWG\Property(property="companies", type="array",
     *          @SWG\Items(type="integer")
     *      )
     *  )
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'menuId' => $this->menu_id,
            'name' => $this->name,
            'companies' => $this->companies->map(
                function (Company $company) {
                    return $company->company_id;
                }
            )
        ];
    }
}
