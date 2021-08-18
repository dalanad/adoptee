<?php

class ProfileController extends Controller{

    function view(){
        View::render("auth/profile/update_profile");
        View::render("auth/sign_up");
    }

    function sign_up(){
        User::createUser($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address'], $_POST[`password`]);
    }

    function update(){
        User::updateProfileData($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address']);
    }

}

?>