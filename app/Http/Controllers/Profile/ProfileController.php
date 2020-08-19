<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Services\ProfileService;
use App\Model\Profile;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends BaseController
{
    public function index()
    {
        $profile=  new ProfileService();
        print_r($profile->Index());
        die;
    }

    public function step1()
    {
        return view('profile.step1');
    }

    public function step2(Request $request)
    {
        $profile=  new ProfileService();
        // $profile->Validation($request);
        $rules=$profile->rules();
        $messages=$profile->messages();
        //  $data= $this->validate($request, $rules, $messages);
        //Log::debug("messages: " . json_encode($validator->messages()));

        $validator = \Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
            
            $json= json_decode($validator->errors());
        //print_r($json->fullname['0']);

            //<div id="error" class="mt-3 text-danger"></div>
          //  $fullname=$json->fullname['0'];
        } else {
            try {
                $input = $request->all();
                $input['name'] = $input['fullname'];
                $input['phone_no'] = $input['phone'];
                $input['user_id'] =auth()->user()->id;
                $input['marital_status'] =$input['mstatus'];
                $input['gender'] =$input['gender'];
                $input['pincode'] =$input['pincode'];
                $input['state'] =$input['state'];
                $input['city'] =$input['city'];
                $input['place'] =$input['place'];
                $profile = Profile::create($input);
                return response()->json(['message'=>'success']);
            } catch (\Exception $exe) {
                throw $exe;
            }
            
            //return redirect()->route('products.index')
//->with('success', 'Product created successfully.');
        }
    }


    public function getpincode(Request $request)
    {
        // return $request->all();
        $input = $request->all();
        $pincode=$input['pincode'];
        $getPin = file_get_contents('https://api.postalpincode.in/pincode/'.$pincode);
        $pincodeRes=json_decode($getPin);

        //$pincodeRes['0']->PostOffice['0']->Name
        //  print_r($pincodeRes['0']->PostOffice['0']->District);
       
        return response()->json(['city'=>$pincodeRes['0']->PostOffice['0']->District,'state'=>$pincodeRes['0']->PostOffice['0']->State,'Result'=>$pincodeRes['0']->PostOffice]);
    }
}
