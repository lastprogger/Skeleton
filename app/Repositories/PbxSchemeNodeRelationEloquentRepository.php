<?php
/**
 * Created by PhpStorm.
 * User: S.Karavaev
 * Date: 20.09.2018
 * Time: 22:16
 */

namespace App\Repositories;

use App\Domain\Repositories\IPbxSchemeNodeRelationRepository;
use App\Domain\Entity\PbxScheme\PbxSchemeNode;
use App\Domain\Entity\PbxScheme\PbxSchemeNodeRelation;

class PbxSchemeNodeRelationEloquentRepository implements IPbxSchemeNodeRelationRepository
{
    /**
     * @inheritdoc
     */
    public function findById(int $id): ?PbxSchemeNodeRelation
    {
        return PbxSchemeNode::find($id);
    }

    /**
     * @inheritdoc
     */
    public function save(PbxSchemeNodeRelation $node): PbxSchemeNodeRelation
    {
        $node->save();
        return $node;
    }
}
