<?php
include_once "helpers/DBConnector.php";

class FileUploader
{

    private static $target_dir = "../uploads/";
    private $upload_ok = false;
    private static $size_limit = 50000;
    private $file_original_name;
    private $file_type;
    private $file_size;
    private $final_file_path;
    private $db;
    private $msg;

    public function __construct()
    {
        $this->db = new DBConnector;
    }

    /* Getters and setters */

    //Original name
    public function setOriginalName($name)
    {
        $this->file_original_name = $name;
    }

    public function getOriginalName()
    {
        return $this->file_original_name;
    }

    //File type
    public function setFileType($type)
    {
        $this->file_type = $type;
    }

    public function getFileType()
    {
        return $this->file_type;
    }

    //File size
    public function setFileSize($size)
    {
        $this->file_size = $size;
    }

    public function getFileSize()
    {
        return $this->file_size;
    }

    //File path
    public function setPath($path)
    {
        $this->final_file_path = $path;
    }

    public function getPath()
    {
        return $this->final_file_path;
    }

    //File path
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    /* Methods */
    public function uploadFile()
    {
        $folder = self::$target_dir;
        $status = false;
        $msg = "";

        if (isset($_FILES['image'])) {
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $name_exp = explode('.', $_FILES['image']['name']);
            $file_ext = strtolower(end($name_exp));
            $path = $folder . $file_name;

            if (!$this->fileAlreadyExists($path)) {
                $is_valid = false;

                //File validations
                if ($this->fileTypeIsCorrect($file_ext)) {
                    $msg = "Only image files are allowed";
                } else if ($this->fileSizeIsCorrect($file_size)) {
                    $msg = "File cannot be greater than 50KB";
                } else {
                    $is_valid = true;
                }

                //Upload file if there are no errors caught
                if ($is_valid == true) {
                    $status = move_uploaded_file($file_tmp, $folder . $file_name);
                    $msg = $status ? "Profile picture uploaded" : "Error uploading file";
                }

            } else {
                $status = true;
                $msg = "File already exists";
            }
            $this->setOriginalName($file_name);
            $this->setPath($path);
        }

        $this->setMsg($msg);
        $this->setFileSize($file_size);
        $this->setFileType($file_ext);
        return $status;
    }

    public function fileAlreadyExists($path)
    {
        //$path = $this->final_file_path;
        if (file_exists($path)) {
            return true;
        }
        return false;
    }

    public function fileTypeIsCorrect($file_ext)
    {
        $extensions = array("jpeg", "jpg", "png");
        return (!in_array($file_ext, $extensions));
    }

    public function fileSizeIsCorrect($file_size)
    {
        if ($file_size > self::$size_limit) {
            return true;
        }
        return false;
    }

    public function updatePath($username)
    {
        $path = $this->getPath();
        $conn = $this->db->conn;

        $stmt = $conn->prepare("UPDATE user SET file_path = ? WHERE username = ?");
        $stmt->bind_param("ss", $path, $username);
        $stmt->execute();
    }

    public function fileWasSelected()
    {}

    public function saveFilePathTo()
    {}

}
