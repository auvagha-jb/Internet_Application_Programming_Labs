<?php
include_once 'interfaces/crud.php';
include_once 'DBconnector.php';

class User implements Crud
{

    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $db;

    public function __construct($first_name = "", $last_name = "", $city_name = "")
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->db = new DBConnector;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Adds new user
     */
    public function save()
    {
        $fname = $this->first_name;
        $lname = $this->last_name;
        $city = $this->city_name;
        $conn = $this->db->conn;

        $query = "INSERT INTO user (first_name, last_name, user_city) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $fname, $lname, $city);

        return $stmt->execute();
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
        );

        foreach ($input_field as $name => $input) {
            if ($input == "") {
                return false;
            }
        }
        return true;
    }

    public function createFormErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
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
