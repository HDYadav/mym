<?php

namespace App\Helpers;

class Helper
{
    public function human_file_size($bytes, $decimals = 2)
    {
        $sz = 'BKMGTPE';
        $factor = (int)floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . $sz[$factor];
    }
 
 
    public static function Gotra()
    {
        return  $sl=array(
             '' => '--Select Gotra--',
             '1' => 'Arean',
              '2' => 'Agarwal',
              '3' => 'Airan',
              '4' => 'Aitrichansiya'
        );
    }
 


 
    public static function Child()
    {
        return array(
              '' => '--Select--',
              '0' => 'Zero',
              '1' => 'One',
              '2' => 'Two',
              '3' => 'Three',
              '4' => 'Four'
        );
    }

    public static function edu()
    {
        return array(
             '' => '--Select qualification--',
              '1' => 'Graduate',
              '2' => 'PG',
              '3' => 'MBA',
              '4' => 'MCA',
              '5' => 'CA',
              '6' => 'BE'
        );
    }

    public static function bloodGroup()
    {
        return  array(
             '' => '--Select blood group--',
              '1' => 'A',
              '2' => 'A+',
              '3' => 'B',
              '4' => 'B+',
              '5' => 'O',
              '6' => 'O+'
        );
    }


    public static function prefix()
    {
        return  array(
             '' => '--Select prefix--',
              '1' => 'Mr.',
              '2' => 'Miss'
        );
    }

      public static function sucess($msg_code,$data=[])
        {  
            $msg='records sucessfully inserted';
            return ['status'=>'sucess','msg_code'=>$msg_code,'msg'=>$msg,'data'=>$data];
        }

        public static function failed($msg_code,$data=[])
        {
            $msg ="Failed"; 
            return ['status'=>'failed','msg_code'=>$msg_code,'msg'=>$msg,'data'=>$data];
        } 
}
