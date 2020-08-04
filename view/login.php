<?php include '../view/header.php'; ?>
<main class="container">
    <form action="../controller/process.php" method="post">
        <fieldset>
            <legend>Come Join Us</legend>
            <input type="hidden" name="action" value="login">
            <label for="user_name">Username</label>
            <input type="text" name="user_name" class="form-control">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
            <input type="submit" class="btn btn-primary" value="Login">
            <p>Don't have an account? <a href="../view/register.php">Register here</a>.</p>
        </fieldset>
    </form>
</main>
<?php include '../view/footer.php'; ?>