<?php
require_once('../controller/check_login.php');
include '../view/header_login.php';
?>
<main>
    <h1>User's List</h1>

    <form action="../controller/process.php" method="get">
        <fieldset>
            <legend>Search</legend>
            <label for="usersearch">Find a profile by NAME</label>
            <input type="text" name="usersearch">
            <input type="hidden" name="action" value="search">
            <input type="submit" name="submit" value="Search">
        </fieldset>
    </form>

    <section>
        <table class='table'>
            <thead class='thead-dark'>
                <tr>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Social Media</th>
                    <th>Skills</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($profiles as $profile) : ?>
                    <tr>
                        <td><img src='../images/" <?php $profile["pic"] ?> "' alt='" <?php $profile["pic"] ?> "'></td>
                        <td><?php echo $profile["name"]; ?></td>
                        <td><?php echo $profile["email"]; ?></td>
                        <td><?php echo $profile["location"]; ?></td>
                        <td><?php echo "<a href = '" . $profile["social_media"] . "'>Link</a>"; ?></td>
                        <td><?php echo $profile["skills"]; ?></td>
                        <td>
                            <form action="." method="post">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="user_id" value="<?php echo $profile["user_id"]; ?>">
                                <?php if ($_SESSION['id'] == $profile["user_id"]) : ?>
                                    <button type="submit" formaction="../controller/process.php?action=delete">Delete</button>
                                <?php else : ?>
                                    <button disabled>You can not delete this profile</button>
                                <?php endif; ?>
                            </form>
                        </td>
                        <td>
                            <form action="." method="post">
                                <input type="hidden" name="action" value="create_form">
                                <input type="hidden" name="user_id" value="<?php echo $profile["user_id"]; ?>">
                                <?php if ($_SESSION['id'] == $profile['user_id']) : ?>
                                    <button type="submit" formaction="../controller/process.php?action=create_form">Update</button>
                                <?php else : ?>
                                    <button disabled>You can not update this profile</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p class=" last_paragraph"><a href="../view/register.php">Register New User</a></p>
    </section>
</main>
<?php include '../view/footer.php'; ?>