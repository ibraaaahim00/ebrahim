
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Pulse Blog</title>
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
            <span class="eyebrow">Create account</span>
            <h1>Start your profile with a clean, modern first step.</h1>
            <p class="lead">

            </p>
        </div>

        <div class="grid-2">
            <div class="feature-box">
                <h3>Readable layout</h3>
                <p class="muted">.</p>
            </div>
            <div class="feature-box">
                <h3>Warm branding</h3>
                <p class="muted">.</p>
            </div>
        </div>
    </section>

    <section class="panel auth-card">
        <span class="eyebrow">Join now</span>
        <h2 style="margin-top:18px;">Create your account</h2>
        <p class="muted">.</p>

        <form class="form-grid" action="../logic/auth/register.php" method="POST" style="margin-top:24px;">
            <div class="form-row">
                <div>
                    <label for="first-name">First name</label>

                    <label for=>First name</label>
                    <input id="first-name" type="text" name="first_name" placeholder="First name">
                </div>

                <div>
                    <label for="last-name">Last name</label>
                    <input id="last-name" type="text" name="last_name" placeholder="Last name">
                </div>

            </div>

            <div>
                <label for="register-email">Email</label>
                <input id="register-email" type="email" name="email" placeholder="name@example.com">
            </div>

            <div>

                <label for="register-username">Username</label>
                <input id="register-username" type="text" name="username" placeholder="Choose a username">
            </div>

            <div class="form-row">
                <div>
                    <label for="register-password">Password</label>
                    <input id="register-password" type="password" name="password" placeholder="Create a password">
                </div>
                <div>
                    <label for="confirm-password">Confirm password</label>
                    <input id="confirm-password" type="password" name="password_confirmation" placeholder="Confirm password">
                </div>
            </div>


            <button type="submit" class="btn btn-primary" style="width:100%;">Create account</button>
        </form>

        <div class="split-actions" style="margin-top:18px;">
            <span class="muted">Already registered?</span>
            <a href="login.php" class="btn btn-secondary">Go to login</a>
        </div>
    </section>
</main>
</body>
</html>