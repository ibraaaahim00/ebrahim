<?php
session_start();
require_once "../../helpers/helpers.php";
//لو اليوزر مش متخزن غي متغير السيشن ارجعلي روح لصفحه اللوجين
if (!isset($_SESSION['user'])) {
    header("Location: ../../views/login.php");
    exit;
}
//لو الريكويست  بتاعه السيرفر بوست يبقا اعمل فلتره لمتغير التايتل والكونتنت اللي متخزنين ف البوست ميثود
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = sanitizestring($_POST['title']);
    $content = sanitizestring($_POST['content']);
//لو ففي ايرور اديني اراي
    $errors = [];
//لو التايتل فاضي قول ايرور التايتل محتاجينه
    if (empty($title)) {
        $errors['title'] = "title is required";
    }
//لو الكونتكت فاضي اديله ايرور قوله محتاجينه
    if (empty($content)) {
        $errors['content'] = "content is required";
    }
//لو مفيش ايرور ف انت هتعرف فايل الحيسون بوستس
    if (empty($errors)) {
        $file = "../../storage/posts.json";
//لو الفايل موجود روح اقرا محتويات الفايل وحوله من اراي لاوبجكتيف//
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $posts = json_decode($json, true);
//لو مفيش بوست كريتلي متغير للبوست فيه اراي فاضيه
            if (!$posts) {
                $posts = [];
            }
//            غير كده لو رجعت فاضيه ابدا اراي فاضيه وضيف بوست جديد فيه المتغيرات دي
        } else {
            $posts = [];
        }

        $posts[] = [
            "title" => $title,
            "content" => $content,
            "author_username" => $_SESSION['user']['username'],
        ];
//بعد كده هتاخدهم وتروح تحولهم ل اراي ف االجيسون وبعد كده ترجع لصفحه الهووم
        file_put_contents($file, json_encode($posts, JSON_PRETTY_PRINT));
        header("Location: ../../views/home.php");
        exit;
    }

}