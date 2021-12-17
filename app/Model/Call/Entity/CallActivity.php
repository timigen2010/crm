<?php

namespace App\Model\Call\Entity;

use App\Model\Company\Entity\Company;
use App\Model\Company\Entity\Phoneline\CompanyPhoneline;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $call_activity_id
 * @property int $source_type
 * @property int $source_id
 * @property string $source
 * @property int $destination_type
 * @property int $destination_id
 * @property string $destination
 * @property int $company_id
 * @property int $company_phoneline_id
 * @property string $phoneline
 * @property string $comment
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property int $duration
 * @property int $duration_live
 * @property string $record
 * @property string $unique_id
 * @property int $disposition
 * @property int $status_dial
 * @property CompanyPhoneline $phoneLine
 */
class CallActivity extends Model
{
    protected $table = 'calls_activity';

    protected $primaryKey = 'call_activity_id';

    protected $fillable = [
        'source_type',
        'source_id',
        'source',
        'destination_type',
        'destination_id',
        'company_id',
        'company_phoneline_id',
        'phoneline',
        'comment',
        'date_start',
        'date_end',
        'duration',
        'duration_live',
        'record',
        'unique_id',
        'disposition',
        'status_dial',
    ];

    public $timestamps = false;

    public function phoneLine()
    {
        return $this->belongsTo(
            CompanyPhoneline::class,
            'company_phoneline_id',
            'company_phoneline_id'
        );
    }

    public function statusDial(){
        return $this->belongsTo(
            DialStatus::class,
            'status_dial',
            'dial_status_id'
        );
    }

    public function company(){
        return $this->belongsTo(
            Company::class,
            'company_id',
            'company_id'
        );
    }
}
