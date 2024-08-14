<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;

use App\Helpers\FileUploadHelper;

use App\Interfaces\UserRepositoryInterface;
use App\Models\GameData;
use App\Models\StateExamination;
use App\Models\UserDemographicDetail;


class UserRepository implements UserRepositoryInterface
{
    public function createUser($request)
    {
        $user = User::create($request);
        return $user;
    }

    public function createDemographicDetail($request)
    {
        // $userDemographicDetail = new UserDemographicDetail;

        // $userDemographicDetail->user_id = $request->id;
        // $userDemographicDetail->gender = $request->gender;
        // $userDemographicDetail->date_of_birth = $request->date_of_birth;
        // $userDemographicDetail->educational_qualification = $request->educational_qualification;
        // $userDemographicDetail->occupation = $request->occupation;
        // $userDemographicDetail->nationality = $request->nationality;
        // $userDemographicDetail->state = $request->state;
        // $userDemographicDetail->marital_status = $request->marital_status;
        // $userDemographicDetail->dominant_hand = $request->dominant_hand;
        // $userDemographicDetail->smoking = ($request->smoking === 'Yes') ? UserDemographicDetail::YES : UserDemographicDetail::NO;
        // $userDemographicDetail->smoking_packs_per_week = $request->smoking_packs_per_week;
        // $userDemographicDetail->drinking_alcohol = ($request->drinking_alcohol === 'Yes') ?  UserDemographicDetail::YES  : UserDemographicDetail::NO;
        // $userDemographicDetail->drinking_times_per_month = $request->drinking_times_per_month;
        // $userDemographicDetail->intoxication = ($request->intoxication === 'Yes') ? UserDemographicDetail::YES  : UserDemographicDetail::NO;
        // $userDemographicDetail->substance_name = $request->substance_name;
        // $userDemographicDetail->intoxication_times_per_month = $request->intoxication_times_per_month;

        // $userDemographicDetail->save();
    }

    public function login($request)
    {
        $response = ['status' => false, 'data' => []];
        $field = $request->input('email_or_phone');
        $identifier = filter_var($field, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
        $request->merge([$identifier => $field]);
        if (Auth::attempt($request->only($identifier, 'password'))) {
            return redirect('dashboard')->with('success', 'You Have Successfully Logged in.');
        } else {
            return redirect()->back()->with('fail', 'You have entered an invalid email/phone or password.');
        }
        return $response;
    }

    public function updateUserWithId($id, $data)
    {
        $userData = User::find($id)->update($data);
        return $userData;
    }

    public function updateUser($request, $user)
    {
        $reqData = $request->all();

        if (!empty($reqData['profile_photo_path'])) {
            if ($user->profile_photo_path != null) {
                FileUploadHelper::imageDelete($user->profile_photo_path, 'users');
            }
            $reqData['profile_photo_path'] = FileUploadHelper::imageUpload($request->profile_photo_path, 'users');
        }
        $userData = $user->update($reqData);
        return $userData;
    }

    public function getUserData()
    {
        $paginate = config('constants.paginate');
        return User::where('id', '!=', auth()->id())->paginate($paginate);
    }

    public function storeUserData($userDetails)
    {

        $insertData = array(
            'name' => $userDetails['name'],
            'email' => $userDetails['email'],
            'phone_number' => $userDetails['phone_number'],
            'password' => Hash::make($userDetails['password']),
        );

        $user = User::create($insertData);
        $user->assignRole($userDetails['role']);
        return $user;
    }

    public function changeUserStatus($userId, $status)
    {
        return User::where('id', $userId)->update(['status' => $status]);
    }

    public function getUserDataById($id)
    {
        return User::findOrfail($id);
    }

    public function updateUserData($userDetails)
    {

        $updateData = array(
            'name' => $userDetails['name'],
            'email' => $userDetails['email'],
            'phone_number' => $userDetails['phone_number'],
        );

        $updateUser = User::find($userDetails['id']);
        $updateUser->update($updateData);

        DB::table('model_has_roles')->where('model_id', $userDetails['id'])->delete();

        $updateUser->assignRole($userDetails['role']);

        return $updateUser;
    }
    public function deleteUser($userId)
    {
        return User::where('id', $userId)->delete();
    }

    public function getUserDetailsAjax($request)
    {
        $draw = $request->query('draw', 0);
        $start = $request->query('start', 0);
        $length = $request->query('length', 100);
        $order = $request->query('order', array(1, 'desc'));
        $sortColumns = array(
            0 => 'users.id',
            1 => 'users.name',
            2 => 'users.email',
            3 => 'users.phone_number',
        );
        $query =  User::select('*')->where('id', '!=', auth()->id());
        $recordsTotal = $query->count();
        $rowPerPage =  $length == '-1' ? $recordsTotal :  $length;
        if (isset($request->search) && $request->search != null) {
            $search = $request->search;
            $query = $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        $recordsWithFilterTotal = $query->count();

        $sortColumnName = $sortColumns[$order[0]['column']];
        $query->orderBy($sortColumnName, $order[0]['dir'])
            ->take($rowPerPage)
            ->skip($start);
        $json = array(
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsWithFilterTotal,
            'data' => [],
        );
        $no = $start + 1;
        $userData = $query->get();

        foreach ($userData as $user) {
            $userRole = $user->roles->pluck('name', 'name')->all();
            $status = $user->status;
            $edit = route("admin-users.edit", $user['id']);
            $view = route('admin-users.show', $user['id']);
            $viewGameData = route('admin-users-game-data', $user['id']);
            $getId = $user['id'];
            $action = ' ';
            $statusToggle = "";

            if ($user->status == '1' ? 'checked' : '') {
                $statusToggle = $user->status == '1' ? 'checked' : '';
            }

            $status = '<div class="col-lg-8 d-flex align-items-center">
            <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                <input type="checkbox" name="select" class="form-check-input status_' . $getId . ' w-45px h-30px toggle-class status_check" data-id="' . $getId . '" id="status" data-on="Active" data-off="InActive" onchange="statusToggle();"' . $statusToggle . '>
               </div>
               </div>';

            $action = '';

            if (auth()->user()->can('user-edit')) {
                $action .= '<a href="' . $edit . '" title="Edit" class="navi-link" style="margin-right: 7px;">
                                       <span class="navi-icon">
                                           <i class="fa fa-edit text-primary" style="font-size:1.5rem;"></i>
                                       </span>
                                   </a>';
            }

            if (auth()->user()->can('user-delete')) {
                $action .= ' <a href="javascript:void(0);" data-id="' . $getId . '" class="navi-link delToolType deleteUser" title="Delete">
                                   <span class="navi-icon">
                                       <i class="fa fa-trash text-danger" style="font-size:1.5rem;"></i>
                                   </span>

                               </a> </div>';
            }
            if (auth()->user()->can('mmse-view') && in_array('User', $userRole)) {
                $action .= ' <div style="float:right;"><a href="' . $view . '" title="MMSE" class="navi-link" style="margin-right: 7px;">
                <span class="navi-icon">
                    <i class="fa fa-eye text-primary" style="font-size:1.5rem;"></i>
                </span>
            </a>';
                $action .= ' <div style="float:right;"><a href="' . $viewGameData . '" title="Game Data" class="navi-link" style="margin-right: 7px;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px;margin-top: -5px;" viewBox="0 0 512 512"><g data-name="Game"><path d="M335.853 238.251a12.579 12.579 0 1 1-12.577 12.58 12.578 12.578 0 0 1 12.577-12.58zM335.857 197.667a12.579 12.579 0 1 1-12.581 12.576 12.58 12.58 0 0 1 12.581-12.576zM173.698 211.007h-13.433v15.506h-15.508v13.435h15.508v15.511h13.433v-15.511h15.506v-13.435h-15.506v-15.506zM315.561 217.949a12.58 12.58 0 1 1-12.582 12.577 12.581 12.581 0 0 1 12.582-12.577zM356.154 217.954a12.579 12.579 0 1 1-12.58 12.577 12.576 12.576 0 0 1 12.58-12.577z"/><path d="M256.199 61.677c-107.326 0-194.322 87.005-194.322 194.325 0 107.316 87 194.32 194.322 194.32 107.314 0 194.324-87.004 194.324-194.32 0-107.32-87.01-194.325-194.324-194.325zM365.43 346.762h-18.97l-40.86-65.189H205.112l-40.864 65.189h-18.972a27.071 27.071 0 0 1-27.069-27.08l6.009-94.768c0-.304.038-.543.048-.824-.005-.3-.048-.595-.048-.905a57.947 57.947 0 0 1 57.937-57.947c13.275 0 22.454 4.514 32.223 12.02 12.496-3.63 18.716-6.755 35.667-7.689h10.617c16.95.934 23.174 4.06 35.666 7.688 9.775-7.505 18.953-12.02 32.218-12.02a57.947 57.947 0 0 1 57.937 57.949c0 .309-.037.603-.037.904.005.281.037.52.037.824l6.02 94.768a27.065 27.065 0 0 1-27.072 27.08z"/></g></svg>
            </a>';
            }

            $json['data'][] = [
                $no,
                $user['name'],
                $user['email'],
                $user['phone_number'],
                $status,
                $action
            ];
            $no++;
        }
        return $json;
    }
    public function getSingalUserData($column, $value)
    {
        return User::where($column, $value)->first();
    }

    public function updateData($id, $data)
    {
        $this->findData($id)->update($data);
        return $this->findData($id);
    }
    public function findData($id)
    {
        return UserDemographicDetail::find($id);
    }

    public function userDemographicDetails()
    {
        return UserDemographicDetail::where('user_id', auth()->user()->id)->first();
    }

    public function getMMSEDetailById($id)
    {
        return StateExamination::where('user_id', $id)->with('userDetail')->orderBy('id', 'ASC')->get();
    }

    public function getMMSEExaminationById($id)
    {
        return StateExamination::where('id', $id)->with('userDetail')->first();
    }

    public function getLastDataByUserID($userID)
    {
        return GameData::where('user_id', $userID)->orderBy('id', 'DESC')->first();
    }

    public function createUserWeb($request)
    {
        $user = User::create($request);
        $user->assignRole(['User']);
        return $user;
    }
}
