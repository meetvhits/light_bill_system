<?php

namespace App\Repositories;

use App\Interfaces\UnitRangeRepositoryInterface;
use App\Models\UnitRange;

class UnitRangeRepository implements UnitRangeRepositoryInterface
{
    public function getUnitRangeData()
    {
        return UnitRange::where('deleted_at', '=', NULL)->get();
    }

    public function storeOrUpdateUnitRangeData($unitRangeDetails)
    {

        foreach ($unitRangeDetails as $unitData) {
            if (isset($unitData['id'])) {
                $unitRange = UnitRange::find($unitData['id']);
                $unit = $unitRange->update($unitData);
            } else {
                $unit = UnitRange::create($unitData);
            }
        }

        return $unit;
    }

    public function deleteUnitRange($id)
    {
        return UnitRange::where('id', $id)->delete();
    }
}
