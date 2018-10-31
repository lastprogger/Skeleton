<?php

namespace App\Domain\Entity\PbxScheme;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;


/**
 * App\Entity\CarBrand
 *
 * @property string $id
 * @property string $user_id
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PbxScheme extends Model
{
    use SoftDeletes;

    public $incrementing = false;

    protected $table = 'pbx_scheme';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return HasMany
     */
    public function nodes()
    {
        return $this->hasMany(PbxSchemeNode::class, 'pbx_scheme_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
