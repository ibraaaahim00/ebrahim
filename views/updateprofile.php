<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | Pulse Blog</title>
    <link rel="stylesheet" href="theme.css">
</head>
<body>
<main class="auth-shell">
    <section class="panel showcase">
        <div class="brand">
            <span class="brand-mark">P</span>
            <span>Pulse Blog</span>
        </div>

        <div style="margin-top:28px;">
            <span class="eyebrow">Update profile</span>
            <h1>Edit your account information.</h1>
            <p class="lead">
                Update your data, save it, and return to your profile page.
            </p>
        </div>

        <div class="list">
            <div class="list-item">
                <strong>Live data</strong>
                The inputs are pre-filled with your current account information.
            </div>
            <div class="list-item">
                <strong>Quick changes</strong>
                Edit your name, username, email, and password in one place.
            </div>
        </div>
    </section>

    <section class="panel auth-card">
        <span class="eyebrow">Edit account</span>
        <h2 style="margin-top:18px;">Update your profile</h2>

        <form class="form-grid" action="../logic/profile/updateprofile.php" method="POST" style="margin-top:24px;">
            <div class="form-row">
                <div>
                    <label for="first-name">First name</label>
                    <input id="first-name" type="text" name="first_name" value="<?php echo $user['first_name']; ?>">
                </div>

                <div>
                    <label for="last-name">Last name</label>
                    <input id="last-name" type="text" name="last_name" value="<?php echo $user['last_name']; ?>">
                </div>
            </div>

            <div>
                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="<?php echo $user['username']; ?>">
            </div>

            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo $user['email']; ?>">
            </div>

            <div>
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" placeholder="Enter new password">
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm new password">
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Save Changes</button>
        </form>

        <div class="split-actions" style="margin-top:18px;">
            <a href="profile.php" class="btn btn-secondary">Back to profile</a>
        </div>
    </section>
</main>
</body>
</html>

