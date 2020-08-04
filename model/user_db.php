<?php
function add_user($user_name, $password)
{
    global $db;
    $sql = "INSERT INTO Mohpreet200448160.`users`
                (user_name, password)
              VALUES
                (:user_name, :password);";
    $statement = $db->prepare($sql);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $statement->bindParam(":user_name", $user_name);
    $statement->bindParam(":password", $hashed_password);
    $statement->execute();
    $statement->closeCursor();
    }

function verify_username($user_name){
    global $db;
    $sql = "SELECT user_name FROM Mohpreet200448160.`users` WHERE user_name = :user_name;";
    $statement = $db->prepare($sql);
    $statement->bindParam(":user_name", $user_name);
    $statement->execute();
    if ($statement->rowCount() > 0){
        $result = true;
    }
    $statement->closeCursor();
    return $result;
}

function verify_user($uname, $upassword)
{
    global $db;
    $sql = "SELECT id,user_name,password FROM Mohpreet200448160.`users` WHERE user_name = :user_name;";
    $statement = $db->prepare($sql);
    $statement->bindParam(":user_name", $uname);
    $statement->execute();
    if ($statement->rowCount() == 1) {
        if ($row = $statement->fetch()) {
            $id = $row["id"];
            $user_name = $row["user_name"];
            $hashed_password = $row["password"];
            if (password_verify($upassword, $hashed_password)) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $user_name;
                header('location:../controller/process.php?action=user_list');
            } else {
                $msg = "<p>Incorrect Password!!!</p>";
                include '../view/display_messages.php';
            }
        }
    }
    else {
        $msg = "<p>Something went wrong on our end. We are sorry for the inconvenience!!!</p>";
        include '../view/display_messages.php';
    }
    $statement->closeCursor();
}
?>
