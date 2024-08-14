<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRangeRequest;
use App\Models\UnitRange;
use App\Repositories\UnitRangeRepository;
use Illuminate\Http\Request;

class UnitRangeController extends Controller
{
    protected $unitRangeRepository = "";

    public function __construct(UnitRangeRepository $unitRangeRepository)
    {
        $this->unitRangeRepository = $unitRangeRepository;
    }

    public function index()
    {
        $unitRanges = $this->unitRangeRepository->getUnitRangeData();

        return view('portal.unitrange.index', compact('unitRanges'));
    }

    public function create()
    {
        return view('portal.unitrange.create');
    }

    public function storeOrUpdate(UnitRangeRequest $request)
    {
        $unitRangeDetails = $request->units;
        try {
            $this->unitRangeRepository->storeOrUpdateUnitRangeData($unitRangeDetails);

            return redirect()->route('unitrange')->with('success', 'Unit range records saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Something went wrong. Try again please..!!');
        }

    }

    public function destroy($id)
    {
        try {
            $this->unitRangeRepository->deleteUnitRange($id);

            return redirect('unitrange')->with('status', 'Unit Range Delete Successfully.');
        } catch (\Exception $e) {
            return redirect()->route('unitrange')->with('status', 'Something went wrong. Try again please..!!');
        }
    }
}
