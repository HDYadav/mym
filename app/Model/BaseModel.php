<?php

/*
 * This file is part of the Surface package.
 * (c) Kaleyra India <technology@kaleyra.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Base Model class.
 *
 * @since  0.0.1
 *
 *  @author Ganesh  <>
 */
class BaseModel extends Model
{
    public $timestamps = false;
    protected $table = '';
    protected $guarded = [];
    protected $cache = false;
    protected $data = [];
    protected $insertID = '';
    protected $primryKey = '';

    public static function beginTransaction()
    {
        self::getConnectionResolver()->connection()->beginTransaction();
    }

    public static function commit()
    {
        self::getConnectionResolver()->connection()->commit();
    }

    public static function rollBack()
    {
        self::getConnectionResolver()->connection()->rollBack();
    }

    /**
     * Sets the ID of the last record this model inserted.
     *
     * @param mixed Last inserted ID
     * @param mixed $id
     */
    public function setInsertID($id)
    {
        $this->insertID = $id;
    }

    /**
     * Returns the ID of the last record this model inserted.
     *
     * @return mixed Last inserted ID
     */
    public function getInsertID()
    {
        return $this->insertID;
    }

    public function getAllData($cache = false, $ttl = false)
    {
        return parent::all();
    }

    /**
     * Funtion used to get data by given query.
     *
     * @param mixed $query
     * @param mixed $cache
     * @param mixed $ttl
     *
     * @return mixed array
     */
    public function getData($query, $cache = false, $ttl = false)
    {
        // app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering get in MysqlBaseModel');

        try {
            $sql = $this->getSql($query);  // Log the Query
            // echo $sql.PHP_EOL; die();
            // app('Klog')->info(__CLASS__, __FUNCTION__, __LINE__, ' | '.$this->getParentFunctionName().' | Query : '.$sql);

            if ($cache && $ttl) {
                // TO DO - If query result is found in cache, get data from the cache and return
            }

            $rows = $query->get();
            $count = $query->count();

            if ($cache) {
                // TO DO - cache the query result
            }

            return [
                'data' => json_decode($rows, true),
                'total' => $count,
            ];
        } catch (\Illuminate\Database\QueryException $ex) {
            // app('Klog')->error(__CLASS__, __FUNCTION__, __LINE__, 'DBException on '.$this->getParentFunctionName().' | errorMsg : '.$ex->getMessage());

            return $this->errorResponse();
        }
    }

    /**
     * Function used to execute query and return the count.
     *
     * @param mixed $query
     * @param mixed $cache
     * @param mixed $ttl
     *
     * @return string
     */
    public function getCount($query, $cache = false, $ttl = false)
    {
        // app('Klog')>trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering getCount in MysqlBaseModel');
        try {
            $sql = $this->getSql($query);  // Log the Query
            // app('Klog')>info(__CLASS__, __FUNCTION__, __LINE__, 'Query : '.$sql);

            if ($cache) {
                // TO DO - If query result is found in cache, get data from the cache and return
            }

            return $query->count();
        } catch (\Illuminate\Database\QueryException $ex) {
            // app('Klog')>error(__CLASS__, __FUNCTION__, __LINE__, 'DBException on '.self:: getParentFunctionName(). ' | errorMsg : '.$ex->getMessage());

            return $this->errorResponse();
        }
    }

    /*
     * Function used to create new data in the table.
     *
     * @param array $save
     *
     * @return int $id
     */
    public function createData(array $data = [])
    {
        // app('Klog')>trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering createData in MysqlBaseModel');

        // TODO
        // $data['created_at'] = add created at time
        // $data['created_by'] = add created by

        try {
            $this->setData($data);

            if ($this->beforeSave()) {
                $id = parent::create($data)->id;
                $this->setInsertID($id);
                if ($id) {
                    $this->afterSave();
                }
            }

            return $id;
        } catch (\Illuminate\Database\QueryException $ex) {
            // app('Klog')>error(__CLASS__, __FUNCTION__, __LINE__, 'DBException on '.$this->getParentFunctionName(). ' | errorMsg : '.$ex->getMessage());

            return $this->errorResponse();
        }
    }

    /*
     * Function used to create new data in the table.
     *
     * @param array $save
     *
     * @return int $id
     */
    public function createMultipleData(array $data = [])
    {
        // app('Klog')>trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering createMultipleData in MysqlBaseModel');

        try {
            $this->setData($data);

            if ($this->beforeSave()) {
                return parent::insert($data);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            // app('Klog')>error(__CLASS__, __FUNCTION__, __LINE__, 'DBException on '.$this->getParentFunctionName(). ' | errorMsg : '.$ex->getMessage());

            return $this->errorResponse();
        }
    }

    /**
     * Function used to update existing data in the table.
     *
     * @param type $data
     * @param type $where
     *
     * @return bool
     */
    public function updateData(array $where = [], array $data = [])
    {
        // app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering updateData in MysqlBaseModel');

        //TODO
        // $data['modified_at'] = set modified time
        // $data['modified_by'] = set modified by

        try {
            $this->setData($data);

            if ($this->beforeUpdate()) {
                $status = parent::where($where)->update($data);
                if ($status) {
                    $this->afterUpdate();
                }
            }

            return $status;
        } catch (\Illuminate\Database\QueryException $ex) {
            // app('Klog')->error(__CLASS__, __FUNCTION__, __LINE__, 'DBException on '.$this->getParentFunctionName().' | errorMsg : '.$ex->getMessage());

            return $this->errorResponse();
        }
    }

    /**
     * Function used to delete the data.
     *
     * @param type  $data
     * @param type  $where
     * @param mixed $field_name
     * @param mixed $ids
     *
     * @return bool
     */
    public function deleteData($field_name = 'id', $ids = [])
    {
        // app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering deleteData in MysqlBaseModel');

        try {
            if ($this->beforeDelete()) {
                $status = parent::whereIn($field_name, $ids)->delete();
                if ($status) {
                    $this->afterDelete();
                }
            }

            return $status;
        } catch (\Illuminate\Database\QueryException $ex) {
            // app('Klog')->error(__CLASS__, __FUNCTION__, __LINE__, 'DBException on '.$this->getParentFunctionName().' | errorMsg : '.$ex->getMessage());

            return $this->errorResponse();
        }
    }

    protected function beforeSave()
    {
        //// app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' In before Save');

        return true;
    }

    protected function afterSave()
    {
        //// app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' In after Save');

        return true;
    }

    protected function beforeUpdate()
    {
        //// app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' In before Update');

        return true;
    }

    protected function afterUpdate()
    {
        //// app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' In after Update');

        return true;
    }

    protected function beforeDelete()
    {
        //// app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' In before Delete');

        return true;
    }

    protected function afterDelete()
    {
        //// app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' In after Delete');

        return true;
    }

    /**
     * Sets the request data.
     *
     * @param array $data
     */
    protected function setData($data)
    {
        $this->data = $data;
    }

    /**
     * FQYar the data.
     */
    protected function clean()
    {
        $this->data = [];
    }

    /**
     * Function used to get complete SQL query from the query object.
     *
     * @param object $query
     *
     * @return string $sql
     */
    protected function getSql($query)
    {
        // app('Klog')->trace(__CLASS__, __FUNCTION__, __LINE__, ' Entering getSql in MysqlBaseModel');
        $sql = $query->toSql();
        foreach ($query->getBindings() as $binding) {
            $value = is_numeric($binding) ? $binding : "'".$binding."'";
            $sql = preg_replace('/\?/', $value, $sql, 1);
        }

        return $sql;
    }

    /**
     * @param mixed $db
     * @param mixed $arrInput
     * @param mixed $objDB
     */
    protected function createCommonQuery($objDB, $arrInput)
    {
        if (!empty($arrInput['id'])) {
            $objDB->where($this->primaryKey, $arrInput['id']);
        }

        if (!empty($arrInput['offset'])) {
            $objDB->offset($arrInput['offset']);
        }

        if (!empty($arrInput['limit'])) {
            $objDB->limit($arrInput['limit']);
        }

        if (!empty($arrInput['sort']) && empty($arrInput['orderBy'])) {
            $objDB->orderBy($arrInput['sort']);
        }

        if (!empty($arrInput['sort']) && !empty($arrInput['orderBy'])) {
            $objDB->orderBy($arrInput['sort'], $arrInput['orderBy']);
        }

        return $objDB;
    }

    /**
     * TODO
     * Make the proper error response.
     */
    private function errorResponse()
    {
        return [
            'code' => 'EROOR_CODE',
            'error' => 'ERROR_MSG',
        ];
    }

    /**
     * Function used to return parent calling function.
     *
     * @return string
     */
    private function getParentFunctionName()
    {
        return debug_backtrace()[2]['function'];
    }
}
