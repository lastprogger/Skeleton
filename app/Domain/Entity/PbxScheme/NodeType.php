<?php

namespace App\Domain\Entity\PbxScheme;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Entity\CarBrand
 *
 * @property integer $id
 * @property string  $name
 * @property string  $type
 * @property boolean $deleted
 * @property Carbon  $deleted_at
 * @property Carbon  $created_at
 */
class NodeType extends Model
{
    use SoftDeletes;

    public const NAME_CALL              = 'call';
    public const NAME_GROUP_CALL        = 'group_call';
    public const NAME_SMS_BUSINESS_CARD = 'sms_business_card';
    public const NAME_SMS_APOLOGIES     = 'sms_apologies';
    public const NAME_QUEUE             = 'queue';
    public const NAME_SMS               = 'sms';
    public const NAME_VOICE_ANNOUNCE    = 'voice_announce';

    public const TYPE_CONDITION = 'condition';
    public const TYPE_BASIC     = 'basic';

    protected $table = 'node_types';
    public $timestamps = false;

    protected $dates = ['created_at', 'deleted_at'];
}
