<?php
session_start();

include('./config/config.php');
include('./setting/setting.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (!empty($user_name) && !empty($password_confirm) && !is_numeric($user_name)) {

        if ($password == $password_confirm) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $user_id = random_num(15);

            $query = "INSERT INTO users (user_id, user_name, password) values ('$user_id', '$user_name', '$password_hash')";

            if (mysqli_query($connect, $query)) {
                $_SESSION['message'] = "Registrazione completata, effettua l'accesso";
                header('location: ../login.php');
                exit;
            } else {
                $_SESSION['alert'] = 'Inserisci informazioni valide';
                header('location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        } elseif ($password !== $password_confirm) {
            $_SESSION['alert'] = 'Le password non coincidono';
            header('location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>



<?php

$title = 'Registrazione';

ob_start();
?>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-4 my-5 bg-light shadow p-5 rounded form-custom">
            <?php if (isset($_SESSION['alert'])): ?>
                <div class="alert alert-danger text-center d-flex justify-content-around">
                    <p class="m-0"><?php echo $_SESSION['alert'] ?></p>
                </div>
                <?php unset($_SESSION['alert']) ?>
            <?php endif ?>
            <h1>Registrati</h1>
            <h5 class="text-secondary">Crea un nuovo account</h5>
            <form method="post">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Username</label>
                    <input name="user_name" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Conferma Password</label>
                    <input name="password_confirm" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Registrati</button>
            </form>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

include('./components/layout.php')


?>