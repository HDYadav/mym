<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class UserProfiles extends BaseModel
{
    use LogsActivity;
    protected $guarded = ['id'];
    protected $table = 'user_profiles';
    protected $primryKey = 'id';

    /**
     * Function use to fetch profile data based to input param.
     *
     * @param mixed $arrInput
     *
     * @return array
     */
    public function getProfileDetails($arrInput = [])
    {
        $objDB = DB::table($this->table);
        $this->createCommonQuery($objDB, $arrInput);

        return $this->getData($objDB);
    }

    protected function afterSave()
    {
        return true;
    }

    protected function afterUpdate()
    {
        return true;
    }

    /**
     * Function used to flush the cache key.
     *
     * @param mixed $id
     */
    private function flush($id = '')
    {
    }
}
