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
        if ($this->nameAlreadyInDb()) {
            return "userAlreadyExists";
        } else if ($this->nameAlreadyInDb() == "stmtProblem") {
            return "stmtPrepError";
        }

        if ($this->phoneAlreadyInDb()) {
            return "phoneAlreadyExists";
        } else if ($this->phoneAlreadyInDb() == "stmtProblem") {
            return "stmtPrepError";
        }
        // query to insert record
        $query = "INSERT INTO " . $this->table_name .
            " (" . $this->col_names['user'] . ", " . $this->col_names['pho'] . ", " . $this->col_names['ema'] . ", " . $this->col_names['pass'] . ") 
            VALUES (?,?,?,?)";

        $stmt = mysqli_stmt_init($this->conn);

        if (!mysqli_stmt_prepare($stmt, $query)) {
            return "stmtPrepError";
        } else {
            // store user password as hash so data breaches won't compromise them
            $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

            // bind values to statement
            mysqli_stmt_bind_param($stmt, "siss", $this->username, $this->phone, $this->email, $hashed_password);
            // execute
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt); // delete stored stmt
            mysqli_close($this->conn); // close connection
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
     * @return true/false/"stmtProblem" whether the user already exists or not, or if there was a problem with the stmt
     */
    function nameAlreadyInDb()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $this->col_names['user'] . "=?";
        // prepare query statement
        $stmt = mysqli_stmt_init($this->conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            return "stmtProblem";
        } else {
            // bind parameters
            mysqli_stmt_bind_param($stmt, "s", $this->username);
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

    /**
     * Returns whether a phone is already registered or not.
     * 
     * @return true/false"stmtProblem" whether the phone already exists or not, or if there was a problem with the stmt
     */
    function phoneAlreadyInDb()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $this->col_names['pho'] . "=?";
        // prepare query statement
        $stmt = mysqli_stmt_init($this->conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            return "stmtProblem";
        } else {
            // bind parameters
            mysqli_stmt_bind_param($stmt, "i", $this->phone);
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
