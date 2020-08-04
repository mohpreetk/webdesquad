<?php
require('../model/connect.php');
require('../model/profile_db.php');
require('../model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        header("Location: ../view/register.php");
    }
}

if ($action == 'register') {
    $user_name = trim(filter_input(INPUT_POST, 'user_name'));
    $password = trim(filter_input(INPUT_POST, 'password'));
    $confirm = trim(filter_input(INPUT_POST, 'confirm'));

    $ok = true;

    if (empty($user_name)) {
        $msg = "<p>Please provide a username</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else if (empty($password)) {
        $msg = "<p>Please provide a password</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else if (empty($confirm)) {
        $msg = "<p>Please confirm your password</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else if (verify_username($user_name)) {
        $msg = "<p>Username already exists!!!</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else if ($confirm != $password) {
        $msg = "<p>Your passwords do not match. Have a look again!!!</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else if($confirm == $password) {
        if (strlen($_POST["password"]) <= '8') {
            $msg = "<p>Your Password Must Contain At Least 8 Characters!";
            include'../view/display_messages.php';
            $ok = false;
        }
        else if(!preg_match("#[0-9]+#",$password)) {
            $msg = "<p>Your Password Must Contain At Least 1 Number!";
            include'../view/display_messages.php';
            $ok = false;
        }
        else if(!preg_match("#[A-Z]+#",$password)) {
            $msg = "<p>Your Password Must Contain At Least 1 Capital Letter!";
            include'../view/display_messages.php';
            $ok = false;
        }
        else if(!preg_match("#[a-z]+#",$password)) {
            $msg = "<p>Your Password Must Contain At Least 1 Lowercase Letter!";
            include'../view/display_messages.php';
            $ok = false;
        }
    }
    if ($ok == true){
        add_user($user_name, $password);
        $msg = "<p> Welcome! You are now registered!!!<a href='../view/login.php'> Login here</a>. </p>";
        include'../view/display_messages.php';
    }
}

else if ($action == 'login') {
    $user_name = trim(filter_input(INPUT_POST, 'user_name'));
    $password = trim(filter_input(INPUT_POST, 'password'));
    
    $ok = true;

    if (empty($user_name)) {
        $msg1 = "<p>Please provide a username</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else{
        $uname = trim($user_name);
    }
    if (empty($password)) {
        $msg2 = "<p>Please provide a password</p>";
        include'../view/display_messages.php';
        $ok = false;
    }
    else{
        $upassword = trim($password);
    }
    verify_user($uname, $password);
} 

else if ($action == 'user_list') {
    require_once('../controller/check_login.php');
    $profiles = get_profiles();
    include('../view/view.php');
}

else if ($action == 'create_form') {
    require_once('../controller/check_login.php');
    $profile = get_profile($_SESSION['id']);
    include('../view/create_profile.php');
}

else if ($action == 'create' || $action == 'update') {
    $user_id = filter_input(INPUT_POST, 'user_id');
    $pic = $_FILES["pic"]["name"];
    $pic_type = $_FILES["pic"]["type"];
    $pic_size = $_FILES["pic"]["size"];
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $location = filter_input(INPUT_POST, 'location');
    $social_media = filter_input(INPUT_POST, 'social_media');
    $skills = filter_input(INPUT_POST, 'skills');

    $ok = true;
    define("UPLOADPATH", "../images/");
    define("MAXFILESIZE", 32786);

    if ((($pic_type !== "image/gif") || ($pic_type !== "image/jpeg") || ($pic_type !== "image/jpg") || ($pic_type !== "image/png")) && ($pic_size < 0) && ($pic_size >= MAXFILESIZE)) {
        $ok = false;
        $msg = "Please submit a photo that is a jpg, png or gif and less than 32kb";
        include'../view/display_messages.php';
    }

    else if (empty($user_id)) {
        $msg = "<p class='error'>Something went wrong! </p>";
        include'../view/display_messages.php';
        $ok = false;
    }

    else if (empty($name)) {
        $msg = "<p class='error'>Please provide your name! </p>";
        include'../view/display_messages.php';
        $ok = false;
    }

    else if (empty($email) || $email === false) {
        $msg = "<p class='error'>Please include your email in the proper format!</p>";
        include'../view/display_messages.php';
        $ok = false;
    }

    else if (empty($location) || $location === 'Default') {
        $msg = "<p class='error'>Please include your location!</p>";
        include'../view/display_messages.php';
        $ok = false;
    }

    else if (empty($social_media) || $social_media === false) {
        $msg = "<p class='error'>Please include the link to your social media in the proper format!</p>";
        include'../view/display_messages.php';
        $ok = false;
    }

    else if (empty($skills)) {
        $msg = "<p class='error'>Please add atleast one skill!</p>";
        include'../view/display_messages.php';
        $ok = false;
    }

    if ($ok === true) {
        $target = UPLOADPATH . $pic;
        move_uploaded_file($_FILES["pic"]["tmp_name"], $target);
        if (check_profile($user_id) == false) {
            create_profile($user_id, $pic, $name, $email, $location, $social_media, $skills);
            $msg = "<p> Your profile has been successfully created.";
            include'../view/display_messages.php';
        }
        else {
            update_profile($user_id, $pic, $name, $email, $location, $social_media, $skills);
            $msg = "<p> Your profile has been successfully updated.";
            include'../view/display_messages.php';
        }
    }
} 

else if ($action == 'delete') {
    $user_id = filter_input(INPUT_POST, 'user_id');
    delete_profile($user_id);
    header("Location: ../controller/process.php?action=user_list");
}

else if ($action == 'search'){
    $search_term = filter_input(INPUT_GET, 'usersearch'); 
    $searchwords = explode(' ', $search_term);
    $results = search($searchwords);
    include'../view/search.php';
}

?>