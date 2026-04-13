
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
    <title>Profile | Pulse Blog</title>
    <link rel="stylesheet" href="theme.css">
</head>
<body>
<div class="page-shell">
    <header class="topbar">
        <div class="brand">
            <span class="brand-mark">P</span>
            <span>Pulse Blog</span>
        </div>

        <nav class="nav-links">
            <a href="home.php" class="btn-secondary">Home</a>
            <a href="profile.php" class="btn-secondary">Profile</a>
        </nav>
    </header>

    <section class="profile-layout">
        <aside class="panel profile-card">
            <div class="avatar">
                <?php echo strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1)); ?>
            </div>

            <h2 style="margin-bottom:8px;">
                <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
            </h2>

            <p class="muted">@<?php echo $user['username']; ?></p>

            <p class="lead" style="font-size:.98rem; margin-bottom:22px;">
                Welcome to your profile page.
            </p>

            <div class="list">
                <div class="list-item">
                    <strong>First Name</strong>
                    <?php echo $user['first_name']; ?>
                </div>

                <div class="list-item">
                    <strong>Last Name</strong>
                    <?php echo $user['last_name']; ?>
                </div>

                <div class="list-item">
                    <strong>Username</strong>
                    <?php echo $user['username']; ?>
                </div>

                <div class="list-item">
                    <strong>Email</strong>
                    <?php echo $user['email']; ?>
                </div>
            </div>
        </aside>

        <div class="list" style="gap:24px;">
            <section class="panel card">
                <div class="section-title">
                    <div>
                        <h2>Profile Overview</h2>
                        <p class="muted">Your account information appears here after login.</p>
                    </div>

                    <div class="nav-links">
                        <a href="updateprofile.php" class="btn btn-primary">Update Profile</a>
                        <a href="../logic/profile/deleteprofile.php" class="btn btn-secondary" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</a>
                        <a href="../logic/auth/logout.php" class="btn btn-secondary">Logout</a>
                    </div>
                </div>

                <div class="grid-2">
                    <article class="card">
                        <span class="tag">Account</span>
                        <h3 style="margin-top:14px;">Personal Info</h3>
                        <p class="muted">
                            Your profile data is loaded from the current session.
                        </p>
                    </article>

                    <article class="card">
                        <span class="tag">Status</span>
                        <h3 style="margin-top:14px;">