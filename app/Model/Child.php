<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Child extends BaseModel
{
     protected $guarded = ['id'];
     protected $table = 'childs';
    // public $timestamps = false;
    use LogsActivity;

}
