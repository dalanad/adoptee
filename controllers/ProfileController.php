<?php

class ProfileController extends Controller{

    function view(){
        View::render("auth/profile/update_profile");
    }

    function sign_up(){
        User::createUser($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address'], $_POST[`password`]);
    }

    function update(){
        User::updateProfileData($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address']);
    }

}

?>