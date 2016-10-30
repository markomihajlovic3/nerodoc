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
        $this->table = strtolower($this->extractModelName(get_class($this)) . 's');
    }


    /**
     * Magic get method for accessing properties
     *
     * @param string $name 
     * @return mixed
     */
    public function __get($name)
    {
        if(! in_array($name, array_keys($this->attributes)))
            return false;

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


    /**
     * Implement dynamic methods for querying the db
     *
     * @param string $name
     * @param array $arguments        
     * @return Model instance
     */
    public static function __callStatic($name, $arguments)
    {
        if(stringStartsWith("where", $name)){
            $propertyName = strtolower(substr($name, 5));

            $instance = new static;

            $result = QB::table($instance->table)->where($propertyName, '=', $arguments[0])->get();

            return $instance->packResults($result);
        }


        throw new \Exception("Calling nonexistant method {$name}.");
    }


    //test method
    public function testQB()
    {
        //return QB::table('users AS u, posts AS p')->select('u.username', 'u.email', 'p.title')->get();
        return QB::table($this->table)->select('username','bio')->where('id', '=', 1)->get();
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
     * Create a model from array
     *
     * @param array $data 
     * @return Model instance
     */
    public static function fromArray(array $data)
    {
        $instance = new static;

        $instance->attributes = $data;

        return $instance;
    }


    /**
     * Create and save an instance to db
     *
     * @param array $data 
     * @return created isntance
     */
    public static function create(array $data)
    {
        $instance = static::fromArray($data);
        $instance->save();

        return $instance;
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
        
        $instance->attributes = QB::table($instance->table)->where('id', '=', $id)->get()[0];

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
        
        $instance->attributes = QB::table($instance->table)->where('id', '=', $id)->get()[0];

        if(empty($instance->attributes))
            throw new \Exception("Lookup for an id of {$id} on table {$instance->table} failed.");

        return $instance;
    }


    /**
     * Implement retrival of models based on column 
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

        $queryResult = QB::table($tableName)->where($foreignKey, '=', $this->id)->limit(1)->get();

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
        $foreignKey = $this->createHasManyForeignKey($foreignKey);
        
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

        $queryResult = QB::table($tableName)->where('id', '=', $this->{$foreignKey})->limit(1)->get();

        return $this->packResults($queryResult);
    }


    /**
     * Implement saving of a model to a db row
     *
     * @return bool
     */
    public function save()
    {
        if($this->id)
            //we need to update the model in the db
            return QB::table($this->table)
                     ->set($this->attributes)
                     ->where('id', '=', $this->id)
                     ->update();
        else{
            //we need to insert into db, it is a new model
            $lastInsertedId = QB::table($this->table)->insert($this->attributes);
            
            $this->attributes['id'] = $lastInsertedId;

            return $lastInsertedId;
        }
    }


    /**
     * Implement deleting a row from the db
     *
     * @return bool
     */
    public function delete()
    {
        if($this->id){
            $result = QB::table($this->table)->where('id', '=', $this->id)->delete();

            $this->attributes = [];

            return $result;
        } 
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

        return $exploded[count($exploded) - 1];
    }


    /**
     * Utility for parsing the query results into model response
     *
     * @param array $queryResult 
     * @return mixed
     */
    private function packResults($queryResult)
    {
        if($queryResult){
            if(isMultidimensional($queryResult))
                return $this->packModelsIntoArray($queryResult);
            else{
                //we have a single assoc array, convert it to model and return it
                $this->attributes = $queryResult[0];
                return $this;
            }
        }

        //query returned false, no results, return empty array
        return [];
    }


    /**
     * Create an array of models
     *
     * @param array $queryResult 
     * @return array of models
     */
    private function packModelsIntoArray($queryResult)
    {
        $packedResult = [];

        foreach($queryResult as $result){
            $model = new static;
            $model->attributes = $result;

            $packedResult[] = $model;
        }

        return $packedResult;
    }


    /**
     * Create a foreign key to be used in has many relationships queries
     *
     * @param string $foreignKey 
     * @return string
     */
    private function createHasManyForeignKey($foreignKey)
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
