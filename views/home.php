<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$file = "../storage/posts.json";
$posts = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $posts = json_decode($json, true);

    if (!$posts) {
        $posts = [];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Pulse Blog</title>
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
            <a href="#quick-post" class="btn btn-primary">Create Post</a>
        </nav>
    </header>

    <section class="hero">
        <div class="panel hero-copy">
            <span class="eyebrow">Welcome back</span>
            <h1>Hello, <?php echo $user['first_name']; ?></h1>
            <p class="lead">
                Publish your posts and see them appear directly on your home page.
            </p>

            <div class="split-actions">
                <a href="profile.php" class="btn btn-primary">Go to Profile</a>
                <a href="#quick-post" class="btn btn-secondary">Write New Post</a>
            </div>

            <div class="stats-row">
                <div class="stat-box">
                    <strong><?php echo $user['username']; ?></strong>
                    <span class="muted">Current username</span>
                </div>

                <div class="stat-box">
                    <strong><?php echo $user['email']; ?></strong>
                    <span class="muted">Account email</span>
                </div>

                <div class="stat-box">
                    <strong><?php echo count($posts); ?></strong>
                    <span class="muted">Total posts</span>
                </div>
            </div>
        </div>

        <div id="quick-post" class="panel card">
            <span class="tag">Quick Post</span>
            <h3 style="margin-top:14px;">Create a post directly</h3>
            <p class="muted">Write your post here and publish it instantly.</p>

            <form class="form-grid" action="../logic/posts/createpost.php" method="POST" style="margin-top:20px;">
                <div>
                    <label for="post-title">Post Title</label>
                    <input id="post-title" type="text" name="title" placeholder="Enter post title">
                </div>

                <div>
                    <label for="post-content">Post Content</label>
                    <textarea id="post-content" name="content" rows="6" placeholder="Write your post content here"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Publish Post</button>
            </form>
        </div>
    </section>

    <section class="section">
        <div class="section-title">
            <div>
                <h2>Your Posts</h2>
                <p class="muted">All published posts will appear here.</p>
            </div>
        </div>

        <div class="grid-3">
            <?php if (!empty($posts)) { ?>
                <?php foreach ($posts as $post) { ?>
                    <article class="card">
                        <span class="tag"><?php echo $post['author_username']; ?></span>
                        <h3><?php echo $post['title']; ?></h3>
                        <p class="muted"><?php echo $post['content']; ?></p>

                        <?php if ($post['author_email'] == $user['email']) { ?>
                            <div class="split-actions" style="margin-top:16px;">
                                <a href="../logic/posts/deletepost.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Delete</a>
                            </div>
                        <?php } ?>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <article class="card">
                    <span class="tag">No Posts Yet</span>
                    <h3>You have not published anything yet.</h3>
                    <p class="muted">Use the form above to create your first post.</p>
                </article>
            <?php } ?>
        </div>
    </section>
</div>
</body>
</html>
