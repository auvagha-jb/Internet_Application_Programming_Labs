<?php
include_once 'interfaces/crud.php';
include_once 'interfaces/authenticator.php';
include_once 'helpers/DBconnector.php';

class User implements Crud, Authenticator
{

    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    private $username;
    private $password;
    private $db;

    public function __construct($first_name = "", $last_name = "", $city_name = "", $username = "", $password = "")
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->username = $username;
        $this->password = $password;
        $this->db = new DBConnector;
    }

    /**
     * A pseudo constructor
     * We need this because in some cases, we don't have all the
     * parameters that the constructor takes
     * It is static therefore can be accessed without creating a method
     */
    public static function create()
    {
        $instance = new self();
        return $instance;
    }

    /* Setters and Getters*/

    //user_id
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    //username
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    //password
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /* Implemented methods */
    /**
     * Adds new user
     */
    public function save()
    {
        $conn = $this->db->conn;

        $fname = $this->first_name;
        $lname = $this->last_name;
        $city = $this->city_name;
        $username = $this->username;
        $this->hashPassword();
        $password = $this->password;

        $query = "INSERT INTO user (`first_name`, `last_name`, `user_city`, `username`, `password`)
                    VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $fname, $lname, $city, $username, $password);
        return $stmt->execute();
    }

    public function usernameAvailable()
    {
        $conn = $this->db->conn;
        $username = $_POST['username'];

        //Execute query
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        //Fetch results
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? false : true;
    }

    public function readAll($table)
    {
        $conn = $this->db->conn;
        $query = "SELECT * FROM " . $table;

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function validateForm()
    {
        $input_field = array(
            "fname" => $this->first_name,
            "lname" => $this->last_name,
            "city" => $this->city_name,
            "username" => $this->username,
            "password" => $this->password,
        );

        foreach ($input_field as $name => $input) {
            if ($input == "") {
                return false;
            }
        }
        return true;
    }

    public function createFormErrorSessions($error)
    {
        session_start();
        $_SESSION['form_errors'] = $error;
    }

    /**
     * Creates password hash using Bcrypt Algorithm
     * @param $password
     */
    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function isPasswordCorrect()
    {
        $username = $this->getUsername();
        $password = $this->getPassword();
        $conn = $this->db->conn;
        $found = false;

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_array();

            if (password_verify($this->getPassword(), $row['password'])) {
                $found = true;
            } else {
                //Password is incorrect
                $this->createFormErrorSessions("Password is incorrect");
            }

        } else {
            //username doesn't exist
            $this->createFormErrorSessions("Username doesn't exist");
        }
        return $found;
    }

    public function login()
    {
        if ($this->isPasswordCorrect()) {
            header("location: ../private-page.php");
        }
    }

    public function createUserSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['username'] = $this->getUsername();
    }

    public function logout()
    {
        unset($_SESSION['username']);
        session_destroy();
        header("location: ../lab1.php");
    }

    public static function show_form_error()
    {
        if (!empty($_SESSION['form_errors'])) {
            echo $_SESSION['form_errors'];
            unset($_SESSION['form_errors']);
        }
    }
    /**
     * Because we implemented an INTERFACE we have to
     * implement all the methods otherwise we wil run into an error
     */

    public function readUnique()
    {
        return null;
    }

    public function search()
    {
        return null;
    }

    public function update()
    {
        return null;
    }

    public function removeOne()
    {
        return null;
    }

    public function removeAll()
    {
        return null;
    }

}