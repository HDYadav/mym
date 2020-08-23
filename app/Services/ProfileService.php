<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Model\UserProfiles;
use App\Model\FamilyInformations;
use App\Model\ChildDetails; 

class ProfileService
{
    
    
    public function rules()
    {
        return [
            'name' => 'required',
            'phone_no' => 'required|min:10'
        ];
    }

    public function messages()
    {
        return [
                'name.required'=> 'Your Name is Required', // custom message
                'phone_no.required'=> 'Phone Number is Required',
                'phone_no.min'=> 'Phone Number Should be Minimum of 10 Character'
        ];
    }
/**
     * create profile .
     *
     * @author Hari Yadav
     * @return string|null
     */

     public function create_profile_step1($request){   
        try{      
                $input = $request->all();                 
                $input['user_id'] =auth()->user()->id;
                UserProfiles::create($input);
                return ['status'=>'true','message'=>'sucessfully']; 
        }catch (\Exception $exe) {
            return ['status'=>'false','message'=>$exe->getMessage()];
        } 
    }


    /**
     * family information validations rules.
     *
     * @author Hari Yadav
     * @return string|null
     */


     public function family_rules()
        {
            return [
                'spouse_name' => 'required',               
                'spouse_blood_group' => 'required',
                'total_child' => 'required',
            ];
        }
 /**
     * family information validations messages.
     *
     * @author Hari Yadav
     * @return string|null
     */

    public function family_val_msg()
        {
            return [
                    'spouse_name.required'=> 'Please enter spouse name', // custom message
                    'spouse_blood_group.required'=> 'Please select blood group',
                    'total_child.required'=> 'Please select total child'
            ];
        }

    public function Validation($request)
    {
        return $validatedData = $request->validate(
            [
            'name' => 'required',
            'phone_no' => 'required|min:10'
            ],
            [
                'name.required'=> 'Your name is required', // custom message
                'phone_no.required'=> 'Phone number is required',
                'phone_no.min'=> 'Phone number should be minimum of 10 character'
            ]
        ); 
 
    }
/// for erray validation

/* $this->validate($request, [
    '*.item_id' => 'required|integer',
    '*.item_no' => 'required|integer',
    '*.size'    => 'required|max:191',
]); */

   
 public function create_family_info($request){   
        try{      
                $input = $request->all();                 
                $input['user_id'] =auth()->user()->id;
                FamilyInformations::create($input);
                return ['status'=>'true','message'=>'sucessfully']; 
        }catch (\Exception $exe) {
            return ['status'=>'false','message'=>$exe->getMessage()];
        } 
    }
    
}
