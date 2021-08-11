<?php
class User
{
    // database connection 
    private $conn;
    // user table name
    private $table_name = "user";
    // table columns names
    private $col_names = array("id" => "id", "user" => "username", "pho" => "phonenumber", "ema" => "emailaddress", "pass" => "passphrase");

    // properties of the user we are creating
    public $username;
    public $phone;
    public $email;
    public $password;

    /**
     * Constructor with `$dbConn` as database connection.
     */
    public function __construct($_dbConn, $_username, $_phone, $_email, $_password)
    {
        $this->conn = $_dbConn;
        $this->username = $_username;
        $this->phone = $_phone;
        $this->email = $_email;
        $this->password = $_password;
    }

    /**
     * Signs up a user inserting it into the db if it doesn't exist already.
     * 
     * @return true/false whether the user was inserted into the db or not
     */
    function signup()
    {
        if ($this->isAlreadyExist()) {
            return "userAlreadyExists";
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name .
            " (" . $this->col_names['user'] . ", " . $this->col_names['pho'] . ", " . $this->col_names['ema'] . ", " . $this->col_names['pass'] . ") 
            VALUES (?,?,?,?)";

        $stmt = mysqli_stmt_init($this->conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            return "stmtPrepError";
        } else {
            // password hashing
            //$hash_pass = password_hash($password, PASSWORD_DEFAULT);

            // bind values to statement
            mysqli_stmt_bind_param($stmt, "siss", $this->username, $this->phone, $this->email, $this->password);
            // execute
            mysqli_stmt_execute($stmt);
            // success
            return "success";
        }

        return "strangError";
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
        $stmt = mysqli_stmt_init($this->conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            return false;
        } else {
            // execute
            mysqli_stmt_execute($stmt);
            // without storing the result we can't count rows
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
}
