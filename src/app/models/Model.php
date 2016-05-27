<?php

namespace Nero\App\Models;

use Nero\Core\Database\DB;
use Nero\Core\Database\QB;

/********************************************************
 * Simple Model base class, has a db connection handle.
 * Users will extend this base Model class and implement
 * their own methods for interfacing with the database.
 * Lets implement some kind of abstraction into the db
 ********************************************************/
class Model
{
    protected $db = null;
    protected $table;
    protected $attributes = [];

    /**
     * Constructor, init the db handle
     *
     * @return void
     */
    public function __construct()
    {
        //lets get the db handle
        $this->db = DB::getInstance();

        //lets parse the table name the default way, adding s at the end
        $this->table = $this->extractModelName(get_class($this)) . 's';
    }


    /**
     * Magic get method for accessing properties
     *
     * @param string $name 
     * @return mixed
     */
    public function __get($name)
    {
        if(!in_array($name, array_keys($this->attributes)))
            throw new \Exception('Trying to get non existant property.');

        return $this->attributes[$name];
    }


    /**
     * Magic method for setting properties
     *
     * @param string $name 
     * @param mixed $value 
     * @return void
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }


    //test method
    public function getAll()
    {
        //return QB::table($this->table)->insert(['name' => 'Jana', 'username' => 'jani', 'email' => 'jani@yahoo.com']);
        return QB::table($this->table)
                 ->whereIn('id', 4,5,6)
                 ->get();
    }


    /**
     * Return the attributes as array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }


    /**
     * Get all models
     *
     * @return array
     */
    public static function all()
    {
        $instance = new static;

        $queryResult = QB::table($instance->table)->get();

        return $instance->packResults($queryResult);
    }


    /**
     * Find by id
     *
     * @param int $id 
     * @return array
     */
    public static function find($id)
    {
        $instance = new static;
        
        $instance->attributes = QB::table($instance->table)->where('id', '=', $id)->get();

        return $instance;
    }

    
    /**
     * Find by id or throw an exception
     *
     * @param int $id 
     * @return array
     */
    public static function findOrFail($id)
    {
        $instance = new static;
        
        $instance->attributes = QB::table($instance->table)->where('id', '=', $id)->get();

        if(empty($instance->attributes))
            throw new \Exception("Lookup for an id of {$id} on table {$instance->table} failed.");

        return $instance;
    }


    /**
     * Implement retrival of rows based on column 
     *
     * @param string $column 
     * @param string $operator 
     * @param string $value 
     * @return array
     */
    public static function where($column, $operator, $value)
    {
        $instance = new static;

        $queryResult = QB::table($instance->table)->where($column, $operator, $value)->get();

        return $instance->packResults($queryResult);
    }


    /**
     * Implement the has one relationship
     *
     * @param string $tableName 
     * @param string $foreignKey 
     * @return type
     */
    public function hasOne($tableName, $foreignKey = "")
    {
        $foreignKey = $this->createForeignKey($foreignKey);

        $queryResult = QB::table($tableName)->where($foreignKey, '=', $this->id)->get();

        return $this->packResults($queryResult);
    }
    


    /**
     * Implement the has many relationship
     *
     * @param string $tableName 
     * @param string $idColumn 
     * @return array
     */
    public function hasMany($tableName, $foreignKey = "")
    {
        $foreignKey = $this->createForeignKey($foreignKey);
        
        $queryResult = QB::table($tableName)->where($foreignKey, '=', $this->id)->get();

        return $this->packResults($queryResult);
    }


    /**
     * Implements the belongs to relationship
     *
     * @param string $tablename 
     * @param string $foreignKey 
     * @return array
     */
    public function belongsTo($tableName, $foreignKey = "")
    {
        $foreignKey = $this->createBelongsToForeignKey($foreignKey, $tableName);

        $queryResult = QB::table($tableName)->where('id', '=', $this->{$foreignKey})->get();

        return $this->packResults($queryResult);
    }


    /**
     * Used for setting custom table names
     *
     * @param string $table 
     * @return void
     */
    public function setTable($table)
    {
        $this->table = $table;
    }


    /**
     * Return the model table name
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->table;
    }

 
    /**
     * Extract the model name only,without namespace
     *
     * @param string $fullModelName 
     * @return string
     */
    private function extractModelName($fullModelName)
    {
        $exploded = explode('\\', $fullModelName);

        return strtolower($exploded[count($exploded) - 1]);
    }


    /**
     * Utility for checking if the array is multidimensional
     *
     * @param array $array 
     * @return bool
     */
    private function isMultidimensional(array $array)
    {
        if (count($array) == count($array, COUNT_RECURSIVE))
            return false;
        else
            return true;
    }


    /**
     * Utility for parsing the query results into model response
     *
     * @param Model $modelInstance
     * @param array $queryResult 
     * @return mixed
     */
    private function packResults($queryResult)
    {
        //lets check for multidimensional array 
        if($this->isMultidimensional($queryResult)){
            //we need to return array of models
            $packedResult = [];

            //lets pack the result set
            foreach($queryResult as $result){
                $model = new static;
                $model->attributes = $result;
                $packedResult[] = $model;
            }

            return $packedResult;
        }
        else{
            //return just one instance of the model
            $this->attributes = $queryResult;
            return $this;
        }
        
    }


    /**
     * Create a foreign key to be used in has many relationships queries
     *
     * @param string $foreignKey 
     * @return string
     */
    private function createForeignKey($foreignKey)
    {
        if($foreignKey == ""){
            $modelName = $this->extractModelName(get_class($this));
            return strtolower($modelName) . "_id";
        }
        else
            return $foreignKey;
    }


    /**
     * Create a foreign key to be used in belongs to relationships queries
     *
     * @param string $foreignKey 
     * @param string $tableName 
     * @return string
     */
    private function createBelongsToForeignKey($foreignKey, $tableName)
    {
        if($foreignKey == ""){
            return rtrim(strtolower($tableName), 's') . "_id";
        }
        else
            return $foreignKey;
    }
}
