<?php
/**
 * Created by PhpStorm.
 * User: S.Karavaev
 * Date: 20.09.2018
 * Time: 22:12
 */

namespace App\Domain\Repositories;

use App\Domain\Entity\PbxScheme\PbxSchemeNode;

interface IPbxSchemeNodeRepository
{
    /**
     * @param string $id
     *
     * @return PbxSchemeNode|null
     */
    public function findById(string $id): ?PbxSchemeNode;

    /**
     * @param PbxSchemeNode $node
     *
     * @return PbxSchemeNode
     */
    public function save(PbxSchemeNode $node): PbxSchemeNode;
}
