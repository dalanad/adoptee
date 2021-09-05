<?php

/**
 * Class for processing uploaded files as images 
 * Validates for file type, file size
 * */
class Image
{
    private $target_dir = "uploads/";
    private $file_path = "";

    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;

        $this->file_path = $this->target_dir . time() . "_" . rand(1, 100) . "." .  pathinfo($_FILES[$file_name]["name"], PATHINFO_EXTENSION);

        $file_ext = strtolower(pathinfo($this->file_path, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES[$file_name]["tmp_name"]);

        if ($check == false) {
            throw new Exception("File is not an image.", 400);
        }

        if (file_exists($this->file_path)) {
            throw new  Exception("Sorry, file already exists.", 400);
        }

        if ($_FILES[$file_name]["size"] > 5000000) {
            throw new  Exception("Sorry, your file is too large.", 413);
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
}
