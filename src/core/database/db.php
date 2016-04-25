<?php namespace Nero\Core\Database;

/******************************************************
 * DB singleton class, manages the connection to db,
 * and provides basic db query functionality.
 *****************************************************/
class DB
{
    private static $instance = null;
    private $pdo = null;
    private $result = null;
    

    /**
     * Get the db instance
     *
     * @return DB
     */
    public static function getInstance()
    {
        if(static::$instance == null){
            static::$instance = new static();
        }

        return static::$instance;
    }


    /**
     * Query the db and get the results
     *
     * @param string $sql
     * @param array $arguments
     * @return mixed
     */
    public function query($sql, array $arguments = [])
    {
        try{
            if(empty($arguments)){
                //simple query
                $stmt = $this->pdo->query($sql);
                $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            else{
                //prepared query
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute($arguments);
                $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            //lets return our results
            return $this->getResults();
        }
        catch(\PDOException $e){
            echo 'Database error. ' . $e->getMessage();
        }
    }


    /**
     * Return the results of the query
     *
     * @return mixed
     */
    private function getResults()
    {
        if(!empty($this->result)){
            //if there are multiple results return an indexed array
            if(count($this->result) > 1)
                return $this->result;
            else
                //else return just single result
                return $this->result[0];
        }
        else
            //we dont have any results
            return false;
    }


    /**
     * Constructor, connect to the db through PDO
     *
     * @return void
     */
    private function __construct()
    {
        try{
            //get the config parameters
            $config = require '../src/config/conf.php';
            $hostname = $config['db_hostname'];
            $dbname   = $config['db_name'];
            $username = $config['db_username'];
            $password = $config['db_password'];

            //instantiate the pdo - connect
            $this->pdo = new \PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e){
            echo "PDO exception, " . $e->getMessage();
        }
    }

    
    /**
     * Disable cloning of the singleton
     *
     * @return void
     */
    private function __clone(){}
}
