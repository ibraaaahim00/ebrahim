<?php
session_start();
require_once "../../helpers/helpers.php";
//هنقوله يعم لو بيانات اليوزر مش متسجله ع السيشن رجعه لصفحه الهخووم
if (!isset ($_SESSION['user'])){header('location: ../../views/home.php');
exit ();
}
//هنعرف متفير اليوزر ف السيشن وبعدين نساله لو الريكويست اللي جيالك م نوع بوست يبقا نعرف االمغيرات بتاعاتنا ونعملها فلتره وفالديت
$user=($_SESSION['user']);
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $first_name = (sanitizestring($_POST['first_name']));
    $last_name = (sanitizestring($_POST['last_name']));
    $email = (sanitizeemail($_POST['email']));
    $username = (sanitizestring($_POST['username']));
    $password = (sanitizestring($_POST['password']));
    $confirm_password = (sanitizestring($_POST['password_confirmation']));

    $errors = [];
//   ونقوله الفالديت لو الاسم واليوز والباسورد وهكذا مش موجودين قوله ايرور احنا محتاجينه
    if (empty($first_name)) {
        $errors['first_name'] = 'firs name is required';
    }
    if (empty($last_name)) {
        $errors['last_name'] = 'last name is required';
    }
    if (empty($username)) {
        $errors['username'] = 'username is required';
    }
    if (empty($email)) {
        $errors['email'] = 'email is required';
    }
    if (empty($password)) {
        $errors['password'] = 'password is required';
    }
    if (empty($confirm_password)) {
        $errors['password_confirmation'] = 'password is required';
    }

    if (!empty($email) && !validateemail($email)) {
        $errors['email'] = 'email is not valid';
    }
    if (!empty($password) && !empty($confirm_password) && $password != $confirm_password) {
        $errors['password_confirmation'] = 'passwords do not match';
    }
    if (empty($errors)) {
//لو مفيش ايرور هتروح تعرف صفحه الجيسون وتقول للجيسون يحط البيانات دي عنده لما يعمل ابديت وياخدهم يحولهم اراي
        $file = "../../storage/users.json";
        $json = file_get_contents($file);
        $data = json_decode($json, true);
//لو مفيش داتا ينشا داتا م نفسه ف اراي
        if (!$data) {
            $data = [];
        }
//بننشا متغير بالايميل الحالي ونسجله باليوزر والايميل ونعمل هاش للباسةرد
        $currentEmail = $_SESSION['user']['email'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//وبعد كده هيعدي يعمل ابديت لكل كي بالفاليو بتاعتها وبعدها يروح يتخزن ف الجيسون ويتحول ل اراي وبعدها يروح يرجع للهوم
        foreach ($data as $key => $user) {
            if ($user['email'] == $currentEmail) {
                $data[$key]['email'] = $email;
                $data[$key]['username'] = $username;
                $data[$key]['first_name'] = $first_name;
                $data[$key]['last_name'] = $last_name;
                $data[$key]['password'] = $hashedPassword;
            }
        }

        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['password'] = $hashedPassword;

        header('Location: ../../views/home.php');
        exit;
    }
}