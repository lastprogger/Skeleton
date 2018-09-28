<?php

namespace App\Domain\Entity\PbxScheme;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Entity\CarBrand
 *
 * @property integer $id
 * @property string $userId
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PbxScheme extends Model
{
    use SoftDeletes;

    protected $table = 'pbx_scheme';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return HasMany
     */
    public function nodes()
    {
        return $this->hasMany(PbxSchemeNode::class, 'pbx_scheme_id');
    }
}
