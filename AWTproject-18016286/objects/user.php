<?php
class User
{
    // database connection and table name
    private $conn;
    private $table_name = "user";

    // properties
    public $id;
    public $username;
    public $phone;
    public $email;
    public $password;

    /**
     * Constructor with `$dbConn` as database connection.
     */
    public function __construct($dbConn)
    {
        $this->conn = $dbConn;
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
        $query = "INSERT INTO " . $this->table_name .
            " SET username=:username, phonenumber=:phone, emailaddress=:email, password=:password";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->phone = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);

        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId(); // keep track of id
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
