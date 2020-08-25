<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Helper;
use App\Http\Controllers\BaseController;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends BaseController
{
    public function step1()
    {
        // abort(404);
        //  Log::info('This is Step 1.', ['id' => auth()->user()->id]);
        //$deleted = DB::delete('delete from user_profiles');

        return view('profile.step1');
    }

    /**
     * Function used the get user Profile Details.
     */
    public function getProFileDetails(Request $request)
    {
        try {
            $profile = new ProfileService();
            //$res = $profile->getAllProfileDetails($request); // get all profile
            $res = $profile->getProfileDetails($request); // get all profile based on request param

            return response()->json($res);
        } catch (\Exception $exe) {
            Log::error('ProfileController__profile_create()__LineNo_38', ['error' => Helper::failed($exe->getMessage())]);

            return response()->json(['errors' => Helper::failed($exe->getMessage())]);
        }
    }

    /**
     * step1 profile create.
     *
     * @author Hari Yadav
     *
     * @return null|string
     */
    public function profile_create(Request $request)
    {
        try {
            $input = $request; // What is use of $input extra varriable
            $profile = new ProfileService();
            $validator = \Validator::make($request->all(), $profile->rules(), $profile->messages());
            if ($validator->fails()) {
                throw new \Exception(json_encode($validator->errors()->all()));
            }
            $res = $profile->create_profile_step1($request);

            $res['mstatus'] = $input['marital_status'];

            return response()->json($res);
        } catch (\Exception $exe) {
            Log::error('ProfileController__profile_create()__LineNo_38', ['error' => Helper::failed($exe->getMessage())]);

            return response()->json(['errors' => Helper::failed($exe->getMessage())]);
        }
    }

    public function family_information()
    {
        return view('profile.step2');
    }

    /**
     * family information create.
     *
     * @author Hari Yadav
     *
     * @return null|string
     */
    public function family_information_create(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request;
            $profile = new ProfileService();
            $validator = \Validator::make($request->all(), $profile->family_rules(), $profile->family_val_msg());
            if ($validator->fails()) {
                throw new \Exception(json_encode($validator->errors()->all()));
            }
            $rt = $profile->create_family_info($request);
            DB::commit();

            return response()->json($rt);
        } catch (\Exception $exe) {
            DB::rollBack();
            Log::error(app_path().'/Http/Controllers/family_information_create__Line_No_75', ['error' => Helper::failed($exe->getMessage())]);

            return response()->json(['errors' => Helper::failed($exe->getMessage())]);
        }
    }

    public function step3()
    {
        return view('profile.step3');
    }

    public function getpincode(Request $request)
    {
        $input = $request->all();
        $pincode = $input['pincode'];
        $getPin = file_get_contents('https://api.postalpincode.in/pincode/'.$pincode);
        $pincodeRes = json_decode($getPin);

        return response()->json(['city' => $pincodeRes['0']->PostOffice['0']->District, 'state' => $pincodeRes['0']->PostOffice['0']->State, 'Result' => $pincodeRes['0']->PostOffice]);
    }
}
