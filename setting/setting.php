<?php

function check_login($connect)
{
    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' limit 1";

        $result = mysqli_query($connect, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header('location: login.php');
    exit;
}

function random_num($lenght)
{

    $text = '';

    if ($lenght < 5) {
        $lenght = 5;
    }

    $len = rand(4, $lenght);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}
