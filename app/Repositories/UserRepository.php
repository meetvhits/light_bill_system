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
}
