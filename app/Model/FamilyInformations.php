<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class FamilyInformations extends Model
{
    protected $guarded = ['id'];
    use LogsActivity;
}
