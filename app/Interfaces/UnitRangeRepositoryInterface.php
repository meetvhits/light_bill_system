<?php

namespace App\Interfaces;

interface UnitRangeRepositoryInterface
{
    public function getUnitRangeData();
    public function storeOrUpdateUnitRangeData($unitRangeDetails);
    public function deleteUnitRange($id);
}
