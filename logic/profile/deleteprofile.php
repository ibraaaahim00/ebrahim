:
<?php
session_start();
//لو اليوزر مش موجود ع السيشن وديه لصفحه اللوجن
if (!isset($_SESSION['user'])) {
    header("Location: ../../views/login.php");
    exit;
}
//نعرف فايل الجيسون
$file = "../../storage/users.json";
//لو الفايل موجود الجيسون هيخدهم ويحولهم من اوبجيت لاراي ويحفظهم
if (file_exists($file)) {
    $json = file_get_contents($file);
    $data = json_decode($json, true);
//لو مفيش داتا اعملي متغير داتا
    if (!$data) {
        $data = [];
    }
//هتشوف الايميل المتسجل واليوز  بتاعه والايميل المتسجل عالسيشن ةتشةف تمشي عليه لو هو هو نفس الايميل بتاع اليوزر واحذفلي الداتا والفاليو بتاع الكيي بتاعه
    $currentEmail = $_SESSION['user']['email'];

    foreach ($data as $key => $user) {
        if ($user['email'] == $currentEmail) {
            unset($data[$key]);
            break;
        }
    }

    $data = array_values($data);

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

session_unset();
session_destroy();

header("Location: ../../views/register.php");
exit;