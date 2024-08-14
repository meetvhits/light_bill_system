<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Helpers\FileUploadHelper;

use App\Interfaces\BillChargeRepositoryInterface;
use App\Models\BillCharge;
use App\Models\GameData;
use App\Models\StateExamination;
use App\Models\UserDemographicDetail;


class BillChargeRepository implements BillChargeRepositoryInterface
{
    public function updateBillCharge($BillChargeDetails, $id)
    {
        $billCharge = BillCharge::findOrFail($id);
        $billChargeData = $billCharge->update($BillChargeDetails);

        return $billChargeData;
    }
}
