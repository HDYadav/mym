<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class ProfileService
{
    public function Index()
    {
        return "Hello";
    }

    public function rules()
    {
        return [
            'fullname' => 'required',
            'phone' => 'required|min:10'
        ];
    }

    public function messages()
    {
        return[
                'fullname.required'=> 'Your Name is Required', // custom message
                'phone.required'=> 'Phone Number is Required',
                'phone.min'=> 'Phone Number Should be Minimum of 10 Character'
        ];
    }
    
    public function Validation($request)
    {
        /* $errorMSg=  request()->validate([
            'fullname' => 'required'
            ]);
        echo $errorMSg; */

        return $validatedData = $request->validate(
            [
            'fullname' => 'required',
            'phone' => 'required|min:10'
            ],
            [
                'fullname.required'=> 'Your  Name is Required', // custom message
                'phone.required'=> 'Phone Number is Required',
                'phone.min'=> 'Phone Number Should be Minimum of 10 Character'
            ]
        );



        /* $validator = Validator::make($request->all(), [
             'fullname' => 'required'
         ]); */
    }
}
