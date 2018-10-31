<?php
/**
 * Created by PhpStorm.
 * User: S.Karavaev
 * Date: 20.09.2018
 * Time: 22:16
 */

namespace App\Repositories;


use App\Domain\Repositories\INodeTypeRepository;
use App\Domain\Entity\PbxScheme\NodeType;

class NodeTypeEloquentRepository implements INodeTypeRepository
{
    /**
     * @inheritdoc
     */
    public function findById(string $id): ?NodeType
    {
        return NodeType::find($id);
    }

}
