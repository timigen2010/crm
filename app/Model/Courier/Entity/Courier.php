<?php

namespace App\Model\Courier\Entity;

use App\Model\Company\Entity\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $courier_id
 * @property string $name
 * @property string $telephone
 * @property float $percent
 * @property bool $deleted
 * @property Collection<Company> $companies
 */
class Courier extends Model
{
    protected $table = 'couriers';

    protected $primaryKey = 'courier_id';

    protected $fillable = ['name', 'telephone', 'percent', 'deleted'];

    public $timestamps = true;

    public function companies()
    {
        return $this->belongsToMany(
            Company::class,
            'couriers_to_companies',
            'courier_id',
            'courier_id'
        );
    }
}
