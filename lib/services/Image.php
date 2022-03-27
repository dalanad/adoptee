<?php

/**
 * Class for processing uploaded files as images 
 * Validates for file type, file size
 * */
class Image
{
    private static $target_dir = "uploads/";
    private $file_path = "";
    private static $file_number = 0;

    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;

        $this->file_path = self::$target_dir . time() . "_" . rand(1, 100) . "." .  pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);

        $file_ext = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES[$file_name]["tmp_name"]);

        if ($check == false) {
            throw new Exception("File is not an image.", 400);
        }

        if (file_exists($this->file_path)) {
            throw new  Exception("Sorry, file already exists.", 400);
        }

        if ($_FILES[$file_name]["size"] > 5500000) {
            throw new  Exception("Sorry, your file is too large. (5Mb max)", 413);
        }

        if (!in_array(strtolower($file_ext), array("jpg", "png", "jpeg", "gif"))) {
            throw new  Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 400);
        }

        if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $this->file_path)) {
            // File has been successfully uploaded and moved
        } else {
            // file move has failed
            throw new  Exception("Sorry, there was an error uploading your file.", 500);
        }
    }

    public function getURL()
    {
        return "/" . $this->file_path;
    }

    public function __toString()
    {
        return $this->getURL();
    }

    private static function processFile($file_data)
    {

        $file_ext = strtolower(pathinfo($file_data["name"], PATHINFO_EXTENSION));
        $dst_path = self::$target_dir . time() . "_" . (self::$file_number++) . rand(1, 100) . "." .  $file_ext;

        $check = getimagesize($file_data["tmp_name"]);

        if ($check == false) {
            throw new Exception("File is not an image.", 400);
        }

        if (file_exists($dst_path)) {
            throw new  Exception("Sorry, file already exists.", 400);
        }

        if ($file_data["size"] > 5000000) {
            throw new  Exception("Sorry, your file is too large.", 413);
        }

        if (!in_array(strtolower($file_ext), array("jpg", "png", "jpeg", "gif"))) {
            throw new  Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 400);
        }

        if (move_uploaded_file($file_data["tmp_name"], $dst_path)) {
            // File has been successfully uploaded and moved
            return $dst_path;
        } else {
            // file move has failed
            throw new  Exception("Sorry, there was an error uploading your file.", 500);
        }
    }

    public static function single(string $field_name)
    {
        return "/" . self::processFile($_FILES[$field_name]);
    }

    public static function multi(string $field_name)
    {
        $urls = [];
        // echo "<pre>";
        // print_r($_FILES);
        $file_count = sizeof($_FILES[$field_name]["name"]);

        for ($i = 0; $i < $file_count; $i++) {
            $file = [
                "name" => $_FILES[$field_name]["name"][$i],
                "tmp_name" => $_FILES[$field_name]["tmp_name"][$i],
                "size" => $_FILES[$field_name]["size"][$i],
            ];

            $url = self::processFile($file);
            array_push($urls, $url);
        }

        return json_encode($urls);
    }
}
