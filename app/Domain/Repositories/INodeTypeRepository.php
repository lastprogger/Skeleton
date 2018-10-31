<?php
/**
 * Created by PhpStorm.
 * User: S.Karavaev
 * Date: 20.09.2018
 * Time: 22:12
 */

namespace App\Domain\Repositories;


use App\Domain\Entity\PbxScheme\NodeType;

interface INodeTypeRepository
{
    /**
     * @param string $id
     *
     * @return NodeType|null
     */
    public function findById(string $id): ?NodeType;
}
