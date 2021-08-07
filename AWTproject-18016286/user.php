<?php
class User
{
    // database connection and table name
    private $conn;
    //private $table_name = "users";
    private $table_name = " Practical3";

    // object properties
    public $id;
    public $username;
    public $password;
    public $created;

    /**
     * Constructor with `$db` as database connection.
     */
    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Signs up a user inserting it into the db if it doesn't exist already.
     * 
     * @return true/false whether the user was inserted into the db or not
     */
    function signup()
    {
        if ($this->isAlreadyExist()) {
            return false;
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET username=:username, password=:password, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->created = htmlspecialchars(strip_tags($this->created));
        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    /**
     * Logs in a user.
     * 
     * @return $stmt the executed statement
     */
    function login()
    {
        // select all query
        $query = "SELECT `id`, `username`, `password`, `created` FROM " . $this->table_name . " WHERE username='" . $this->username . "' AND password='" . $this->password . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    /**
     * Returns whether a user already exists or not.
     * 
     * @return true/false whether the user already exists or not
     */
    function isAlreadyExist()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username='" . $this->username . "'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
