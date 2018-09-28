<?php

namespace App\Domain\Entity;

use App\Domain\Entity\PbxScheme\PbxScheme;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Entity\CarBrand
 *
 * @property integer        $id
 * @property integer        $pbx_scheme_id
 * @property integer        $user_id
 * @property Carbon         $deleted_at
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 * @property-read PbxScheme $scheme
 */
class Pbx extends Model
{
    use SoftDeletes;

    protected $table = 'pbx';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return HasOne
     */
    public function pbxScheme()
    {
        return $this->hasOne(PbxScheme::class, 'pbx_scheme_id');
    }
}
