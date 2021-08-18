<?php

class ProfileController extends Controller{

    function view(){
        View::render("auth/profile/update_profile");
        
    }
   
    function update(){
        User::updateProfileData($_POST['name'], $_POST['email'], $_POST['telephone'], $_POST['address']);
    }

}

?>