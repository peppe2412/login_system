<?php

session_start();
include('./config/config.php');
include('./setting/setting.php');

$user_data = check_login($connect);

$title = 'Home';

ob_start();

date_default_timezone_set('Europe/Rome');
$time = date('G');

if($time >= 6 && $time <= 8){
    $print = 'Buongiornissimo, caffe?';
}elseif($time >= 9 && $time <= 11){
    $print = 'Buongiorno';
}elseif($time >= 12 && $time <= 13){
    $print = 'Buon pranzo';
}elseif($time >= 14 && $time <= 17){
    $print = 'Buon pomeriggio';
}elseif($time >= 18 && $time <= 22){
    $print = 'Buonasera';
}else{
    $print = 'Ancora svegli?';
}

?>


<header class="container py-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-10 mt-5">
            <h1 class="text-center display-1 title-index"><?php echo $print ?> <?php echo $user_data['user_name'] ?></h1>
            <div class="d-flex justify-content-center mt-4">
                <a href="logout.php" class="logout rounded p-2 fs-2">Logout</a>
            </div>
        </div>
    </div>
</header>

<?php
$content = ob_get_clean();

include('./components/layout.php');
?>