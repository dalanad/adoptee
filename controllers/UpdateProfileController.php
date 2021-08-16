<?php

class UpdateProfileController extends Controller{

    function view(){
        View::render("auth/profile/update_profile");
    }

    function submit(){
        UpdateProfile::updateProfile($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address']);
    }
}

?>