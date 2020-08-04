<?php 
session_start();
include '../view/header_login.php';
?>
<main role="main">
    <h1>Search Results</h1>
    <table class='table'>
    <thead class='thead-dark'>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $result) {
        echo "<tr>";
        echo "<td>" . $result['name'] . "</td><td>" . $result['email'] . "</td></tr>";
    } ?>  
    </tbody></table>
    </main>
<?php include '../view/footer.php'; ?>