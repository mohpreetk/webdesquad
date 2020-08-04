<?php
function get_profiles() {
    global $db;
    $sql = "SELECT * FROM Mohpreet200448160.`profiles`;";
    $statement = $db->prepare($sql);
    $statement->execute();
    $profiles = $statement->fetchAll();
    $statement->closeCursor();
    return $profiles;
}


function get_profile($user_id) {
    global $db;
    $sql = "SELECT * FROM Mohpreet200448160.`profiles`
              WHERE user_id = :user_id;";
    $statement = $db->prepare($sql);
    $statement->bindParam(":user_id", $user_id);
    $statement->execute();
    $profile = $statement->fetch();
    $statement->closeCursor();
    return $profile;
}

function check_profile($user_id) {
    global $db;
    $sql = "SELECT * FROM Mohpreet200448160.`profiles`
              WHERE user_id = :user_id;";
    $statement = $db->prepare($sql);
    $statement->bindParam(":user_id", $user_id);
    $statement->execute();
    if ($statement->rowCount() == 0) {
        return false;
    }
    else{
        return true;
    }
    $statement->closeCursor();
}

function create_profile($user_id, $pic, $name, $email, $location, $social_media, $skills) {
    global $db;
    $sql = "INSERT INTO Mohpreet200448160.`profiles`
                 (user_id, pic, name, email, location, social_media, skills)
              VALUES
                 (:user_id, :pic, :name, :email, :location, :social_media, :skills);";
                 
    $statement = $db->prepare($sql);
    $statement->bindParam(":user_id", $user_id);
    $statement->bindParam(":pic", $pic);
    $statement->bindParam(":name", $name);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":location", $location);
    $statement->bindParam(":social_media", $social_media);
    $statement->bindParam(":skills", $skills);
    $statement->execute();
    $statement->closeCursor();
}

function update_profile($user_id, $pic, $name, $email, $location, $social_media, $skills) {
    global $db;
    $sql = "UPDATE Mohpreet200448160.`profiles` SET pic = :pic, name = :name, email = :email, location = :location, social_media = :social_media , skills = :skills WHERE user_id = :user_id;";
              
    $statement = $db->prepare($sql);
    $statement->bindParam(":user_id", $user_id);
    $statement->bindParam(":pic", $pic);
    $statement->bindParam(":name", $name);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":location", $location);
    $statement->bindParam(":social_media", $social_media);
    $statement->bindParam(":skills", $skills);
    $statement->execute();
    $statement->closeCursor();
}

function delete_profile($user_id) {
    global $db;
    $sql = "DELETE FROM Mohpreet200448160.`profiles` WHERE user_id = :user_id;";
    $statement = $db->prepare($sql); 
    $statement->bindParam(':user_id', $user_id ); 
    $statement->execute(); 
    $statement->closeCursor();
}

function search($searchwords) {
    global $db;
    $sql = "SELECT * FROM Mohpreet200448160.`profiles` WHERE "; 
    $where = ""; 
    foreach($searchwords as $word) {
    $where = $where . "name LIKE '%$word%' OR "; 
    }
    $where = substr($where, 0, strlen($where) - 4);
    $finalsql = $sql . $where;
    $statement = $db->prepare($finalsql);  
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

?>