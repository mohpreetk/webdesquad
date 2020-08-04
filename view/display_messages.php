<?php 
session_start();
if (empty($_SESSION['id'])){
    include '../view/header.php';
}
else {
    include '../view/header_login.php';
} ?>
<main role="main">
    <h1>Welcome to WEBDESQUAD</h1>
    <?php echo $msg ?> <br>
  </main>
<?php include '../view/footer.php'; ?>