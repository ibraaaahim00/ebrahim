
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Pulse Blog</title>
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
            <span class="eyebrow">Welcome back</span>
            <h1>Login and continue your writing journey.</h1>
            <p class="lead">
            </p>
        </div>

        <div class="list">
            <div class="list-item">
                <strong>Quick access</strong>
            </div>
            <div class="list-item">
                <strong>Clean layout</strong>
            </div>
            <div class="list-item">
                <strong>Backend ready</strong>
            </div>
        </div>
    </section>

    <section class="panel auth-card">
        <span class="eyebrow">Sign in</span>
        <h2 style="margin-top:18px;">Access your account</h2>
        <p class="muted"></p>

        <form class="form-grid" action="../logic/auth/login.php" method="POST" style="margin-top:24px;">
            <div>
                <label for="login-email">Email</label>
                <input id="login-email" type="email" name="email" placeholder="name@example.com">
            </div>

            <div>
                <label for="login-password">Password</label>
                <input id="login-password" type="password" name="password" placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
        </form>

        <div class="split-actions" style="margin-top:18px;">
            <a href="register.php" class="btn btn-secondary">Create account</a>
            <a href="home.php" class="btn btn-secondary">Back to home</a>
        </div>
    </section>
</main>
</body>
</html>