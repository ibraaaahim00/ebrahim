<?php
//هنقوله روح استدعيلي الفانكشن من الهيلبر عشان هنعمل فلتره بالساناتاسز للامتغيرات اللي عندي
require_once "../../helpers/helpers.php";
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $first_name = (sanitizestring($_POST['first_name']));
    $last_name = (sanitizestring($_POST['last_name']));
    $email = (sanitizeemail($_POST['email']));
    $username = (sanitizestring($_POST['username']));
    $password = (sanitizestring($_POST['password']));
    $confirm_password = (sanitizestring($_POST['password_confirmation']));

//لو ف ايرور اديني اراي
    $errors = [];
//هنعمل فالاديت ونتاكد لو الاسم او الايميل او اليوزر او الباسورد مش مكتوب قولي لا انا محتاجه
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
//    لو الباسوردين مش شبه بعض يعني الباسورد الاساسي والتالكيد قوله مش شبه بعض
    if (!empty($password) && !empty($confirm_password) && $password != $confirm_password) {
        $errors['password_confirmation'] = 'passwords do not match';
    }

//لو مفيش ايرور روح عرف الجيسون وقوله يخزن فيه المتغيرات دي ويحولها من اوبحيكت ل اراري
    if (empty($errors)) {
        $file = "../../storage/users.json";

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $users = json_decode($json, true);
//لز مفيش يوزر اعملي اراي باليوزر
            if (!$users) {
                $users = [];
            }
        } else {
            $users = [];
        }
//هنمشي ع الايميل نتاكد هل هو زي م اليوزر كاتبه لة موجود قوله موجود قبل كده وهكذا لليوزر نيم
        foreach ($users as $user) {
            if ($email == $user['email']) {
                $errors['email'] = 'email already exists';
            }

            if ($username == $user['username']) {
                $errors['username'] = 'username already exists';
            }
        }
//لو مفيش ايرور هنعمل اراري باليوزر زي مقولنا فوق وننقول ان كل متغير بيساوي القيمه بتاعته بمعني الاسم الاول بيساوي متغيره وهكذا بالنسبه للايميل واليوزر والباسورد
        if (empty($errors)) {
            $users[] = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
//بعد كده هتاخدهم وتحولهم ف الجيسون وتروح لصفحه اللوجين
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
            header('Location: ../../views/login.php');
            exit;
        } else {
            print_r($errors);
        }
    }
}
