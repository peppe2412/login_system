<?php
session_start();
include('./config/config.php');
include('./setting/setting.php');

$title = 'Login';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = trim($_POST['user_name']);
    $password = trim($_POST['password']);

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        $query = "SELECT * FROM users WHERE user_name = '$user_name' limit 1";

        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);

            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header('location: index.php');
                die;
            } else {
                $_SESSION['alert'] = 'Password non è corretta';
                header('location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        }
    } else {
        $_SESSION['alert'] = 'Inserisci informazioni valide';
        header('location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<?php

ob_start();

?>

<?php if (isset($_SESSION['message'])): ?>
    <div class="fs-4 alert alert-success text-center mt-4 w-25 mx-4" id="alert-success">
        <p class="m-0"><?php echo $_SESSION['message'] ?></p>
    </div>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-4 my-5 bg-light shadow p-5 rounded form-custom">
            <?php if (isset($_SESSION['alert'])): ?>
                <div class="fs-4 alert alert-danger text-center">
                    <p><?php echo $_SESSION['alert'] ?></p>
                </div>
                <?php unset($_SESSION['alert']) ?>
            <?php endif ?>
            <h1>Accesso</h1>
            <h5 class="text-secondary">Accedi al tuo account</h5>
            <form method="post">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Username</label>
                    <input name="user_name" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Accedi</button>
                <div class="my-4">
                    <p>Nuovo Utente? <a href="register.php">Crea un account</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

include('./components/layout.php');

?>