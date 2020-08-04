<?php include '../view/header.php'; ?>
<main>
    <form action="../controller/process.php" method="post">
        <fieldset>
            <legend>Come Join Us</legend>
            <input type="hidden" name="action" value="register">
            <label for="user_name"> UserName </label>
            <input type="text" name="user_name" class="form-control" id="user_name" value="<?php echo $user_name; ?>" required>
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" class="form-control" required>
            <input type="submit" name="submit" value="Submit" class="btn-success">
        </fieldset>
        <p>Already have an account? <a href="../view/login.php">Login here</a>.</p>
    </form>
</main>
<?php include '../view/footer.php'; ?>