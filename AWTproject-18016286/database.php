<?php
class Database
{
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "finalproj";
    private $username = "root";
    private $password = "";
    public $iConn;

    /**
     * Connects via `PDO` to the db using the previously defined credentials `$host`, `$db_name`, `$username`, `$password`.
     * 
     * @return $pdoConn the connection 
     */
    public function getPDOConnection()
    {
        try {
            $pdoConn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $pdoConn->exec("set names utf8");
            // throw exceptions
            $pdoConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "DB connection successful.";
        } catch (PDOException $exception) {
            echo "DB connection error: " . $exception->getMessage();
        }

        return $pdoConn;
    }

    /**
     * Connects via `mysqli_connect` to the db using the previously defined credentials `$host`, `$db_name`, `$username`, `$password`.
     * 
     * @return $iConn the connection 
     */
    public function getMySQLiConnection()
    {
        $iConn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        if (!$iConn) {
            die('DB mysqli connection error: ' . mysqli_error($iConn));
        }
        mysqli_select_db($iConn, "finalproj");

        return $iConn;
    }
}
