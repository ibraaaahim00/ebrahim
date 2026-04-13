<?php

require_once "../../helpers/helpers.php";
//نتاكد ان الريكويست جايا بيمثود بوست لو كدا عرفلي متغير الايميل والباسوررد واعملهم فلتره
if($_SERVER['REQUEST_METHOD']=="POST") {
    $email = (sanitizestring($_POST['email']));
    $password = (sanitizestring($_POST['password']));
//لو ف اي ايرور هتقوله
    $errors = [];
    if (empty($email)) {
        $errors[] = 'email is required';
    }
    if (empty($password)) {
        $errors[] = 'password is required';
    }
//لو مفيش ايرورز هنعرف الجيسون وناخد الفايل ونحفظه ونحول المتغيرات نحفظها لاراي
    if (empty($errors)) {
        $file = '../../storage/users.json';
        $json = file_get_contents($file);
        $users = json_decode($json, true);
//لو مفيش يوزر هننشا يوزر
        if (!$users) {
            $users = [];
        }
    } else {
        $users = [];

    }
// لو تمام اديني ترو//    هنقول متغير الساكسيس بيساوي فولس ونمشي ع كل متغير الايميل نشوفه نفس اللي اليوزر كاتبه ولا لا هو والباسورد
    $success = false;
    foreach ($users as $user) {
        if ($email == $user['email']) {
            if (password_verify($password, $user['password'])) {
                $success = true;

            } else {
                $errors[] = 'Wrong email and password';
            }
            break;
        }
        }
//    لو مدانيش ترو اداني ايرور هنديله ايرور الايميل والباسورد غلط
    if (!$success && empty($errors)) {
            $errors[] = 'Wrong email and password';
        }
//    لو اداني ترو هنبدا سيشن ويحطلي اسم اليوزرولعدها يروح للهووم
        if ($success) {
            session_start();
            $_SESSION['user'] = $user;

            header('location: ../../views/home.php');


            exit ;
        }



}




