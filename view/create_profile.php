<?php 
require_once('../controller/check_login.php');
include '../view/header_login.php'; 
?>
<main>
    <form enctype="multipart/form-data" action="../controller/process.php" method="post">
        <fieldset>
            <legend>Create or Update your Profile</legend>
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="action" value="create">
            <label for="profile_pic"> Profile Picture </label>
            <input type="file" name="pic" class="form-control" id="pic" value="<?php echo $profile['pic']; ?>">
            <label for="name"> Your Name </label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo $profile['name']; ?>">
            <label for="email"> Your Email </label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $profile['email']; ?>">
            <label for="location"> Your Location </label>
            <?php require('countries_dropdown.php') ?>
            <label for="social_media"> Social Media Link</label>
            <input type="url" name="social_media" class="form-control" id="social_media" value="<?php echo $profile['social_media']; ?>">
            <label for="skills"> Skills </label>
            <input type="text" name="skills" class="form-control" id="skills" value="<?php echo $profile['skills']; ?>">
            <input type="submit" name="submit" value="Submit" class="btn-success">
        </fieldset>
    </form>
</main>
<?php include '../view/footer.php'; ?>