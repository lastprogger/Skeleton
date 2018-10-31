<?php
/**
 * Created by PhpStorm.
 * User: S.Karavaev
 * Date: 20.09.2018
 * Time: 22:16
 */

namespace App\Repositories;


use App\Domain\Repositories\IPbxSchemeNodeRepository;
use App\Domain\Entity\PbxScheme\PbxSchemeNode;

class PbxSchemeNodeEloquentRepository implements IPbxSchemeNodeRepository
{
    /**
     * @inheritdoc
     */
    public function findById(string $id): ?PbxSchemeNode
    {
        return PbxSchemeNode::find($id);
    }

    /**
     * @inheritdoc
     */
    public function save(PbxSchemeNode $node): PbxSchemeNode
    {
        $node->save();
        return $node;
    }
}
