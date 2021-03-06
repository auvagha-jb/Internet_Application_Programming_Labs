<?php
include "helpers/DBConnector.php";
class ApiHandler
{

    private $db;
    private $meal_name;
    private $meal_units;
    private $unit_price;
    private $status;
    private $user_api_key;

    public function __construct()
    {
        $this->db = new DBConnector();
    }

    /**
     * Get the value of meal_name
     */
    public function getMealName()
    {
        return $this->meal_name;
    }

    /**
     * Set the value of meal_name
     *
     * @return  self
     */
    public function setMealName($meal_name)
    {
        $this->meal_name = $meal_name;

        return $this;
    }

    /**
     * Get the value of meal_units
     */
    public function getMealUnits()
    {
        return $this->meal_units;
    }

    /**
     * Set the value of meal_units
     *
     * @return  self
     */
    public function setMealUnits($meal_units)
    {
        $this->meal_units = $meal_units;

        return $this;
    }

    /**
     * Get the value of unit_price
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Set the value of unit_price
     *
     * @return  self
     */
    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of user_api_key
     */
    public function getUserApiKey()
    {
        return $this->user_api_key;
    }

    /**
     * Set the value of user_api_key
     *
     * @return  self
     */
    public function setUserApiKey($user_api_key)
    {
        $this->user_api_key = $user_api_key;

        return $this;
    }

    public function checkApiKey()
    {
        $api_key = $this->getUserApiKey();
        $query = "SELECT api_key FROM api_keys WHERE api_key = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function fetchUserApiKey($user_id)
    {
        $query = "SELECT api_key FROM api_keys WHERE user_id = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array();

        //Returns the api_key and num_rows
        return $row['api_key'];
    }
    public function checkContentType()
    {
        return null;
    }

    public function createOrder($data)
    {
        $query = "INSERT INTO `orders`(`user_id`, `order_name`, `units`, `unit_price`, `order_status`) 
        VALUES (?, ?, ?, ?, ?)";
        // $this->db->conn->auto_commit(false);
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("sssss", $data['user_id'], $data["order_name"], $data["units"], $data["unit_price"], $data["order_status"]);
        return $stmt->execute();
    }

    public function fetchUserOrders($user_id)
    {
        $query = "SELECT * FROM `orders` WHERE `user_id` = ? ORDER BY order_id DESC";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function fetchOrderStatus($order_id)
    {
        $query = "SELECT `order_status` FROM `orders` WHERE `order_id` = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_array();
    }

    public function fetchAllOrders()
    {
        $query = "SELECT * FROM `orders`";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function checkOrderStatus()
    {

    }

}