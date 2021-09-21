<?php

/**
 * Class for processing uploaded files as images 
 * Validates for file type, file size
 * */
class MultipleImages
{
    private $target_dir = "uploads/";
    private $urls = [];

    public function __construct(string $field_name)
    {
        $this->file_name = $field_name;


        $file_count = sizeof($_FILES[$field_name]["name"]);

        for ($i = 0; $i < $file_count; $i++) {

            $file_path = "";

            $file_path = $this->target_dir . time() . "_" . rand(1, 100) . "." .  pathinfo($_FILES[$field_name]["name"][$i], PATHINFO_EXTENSION);

            $file_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES[$field_name]["tmp_name"][$i]);

            if ($check == false) {
                throw new Exception("File is not an image.", 400);
            }

            if (file_exists($file_path)) {
                throw new  Exception("Sorry, file already exists.", 400);
            }

            if ($_FILES[$field_name]["size"][$i] > 5000000) {
                throw new  Exception("Sorry, your file is too large.", 413);
            }

            if (!in_array(strtolower($file_ext), array("jpg", "png", "jpeg", "gif"))) {
                throw new  Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", 400);
            }

            if (move_uploaded_file($_FILES[$field_name]["tmp_name"][$i], $file_path)) {
                // File has been successfully uploaded and moved
                array_push($this->urls, $file_path);
            } else {
                // file move has failed
                throw new  Exception("Sorry, there was an error uploading your file.", 500);
            }
        }
    }

    public function getURL()
    {
        return $this->urls;;
    }
}
