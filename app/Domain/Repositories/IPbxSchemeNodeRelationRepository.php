<?php
/**
 * Created by PhpStorm.
 * User: S.Karavaev
 * Date: 20.09.2018
 * Time: 22:35
 */

namespace App\Domain\Repositories;


use App\Domain\Entity\PbxScheme\PbxSchemeNodeRelation;

interface IPbxSchemeNodeRelationRepository
{
    /**
     * @param int $id
     *
     * @return PbxSchemeNodeRelation|null
     */
    public function findById(int $id): ?PbxSchemeNodeRelation;

    /**
     * @param PbxSchemeNodeRelation $relation
     *
     * @return PbxSchemeNodeRelation
     */
    public function save(PbxSchemeNodeRelation $relation): PbxSchemeNodeRelation;
}
