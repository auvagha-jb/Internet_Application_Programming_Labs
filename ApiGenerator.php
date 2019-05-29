<?php
include_once "helpers/DBConnector.php";

class ApiGenerator
{

    private $api_key;
    private $db;

    public function __construct()
    {
        $this->db = new DBConnector();
    }

    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
    }

    public function getApiKey()
    {
        return $this->api_key;
    }

    public function generateApiKey($str_length)
    {
        do {
            $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $bytes = openssl_random_pseudo_bytes(3 * $str_length / 4 + 1);
            $repl = unpack("C2", $bytes);
            $first = $chars[$repl[1] % 62];
            $second = $chars[$repl[2] % 62];

            $api_key = strtr(substr(base64_encode($bytes), 0, $str_length), "+/", "$first$second");
            $key_exists = $this->apiKeyExists($api_key);
        } while($key_exists);

        return $api_key;
    }

    public function saveApiKey($user_id)
    {
        $api_key = $this->getApiKey();
        $query = "INSERT INTO `api_keys`(`user_id`, `api_key`) VALUES (?, ?)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("ss", $user_id, $api_key);
        return $stmt->execute();
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
        return ['api_key' => $row['api_key'], "num_rows" => $result->num_rows];
    }

    public function generateResponse()
    {
        $saved = $this->saveApiKey($_SESSION['user_id']);
        $msg = $saved ? $this->getApiKey() : "Something went wrong, please try again later";
        $data = ['status' => $saved, 'msg' => $msg];
        return json_encode($data);
    }

    public function apiKeyExists($api_key)
    {
        $query = "SELECT api_key FROM api_keys WHERE api_key = ?";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bind_param("s", $api_key);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->num_rows > 0; 
    }

}