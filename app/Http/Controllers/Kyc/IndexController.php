<?php

namespace App\Http\Controllers\Kyc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KycService;

class IndexController extends Controller
{
    //
    public function kycTest()
    {
        $kyc=  new KycService();
        print_r($kyc->Index());
        die;
    }
}
