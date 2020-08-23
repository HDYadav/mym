<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ChildDetails extends BaseModel
{
    protected $guarded = ['id'];
    use LogsActivity;
}
