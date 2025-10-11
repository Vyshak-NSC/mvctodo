<?php
$pageTitle = $pageTitle ?? "MVC Page";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle);?> | MVC Site</title>

    <link rel="stylesheet" href='<?= BASE_URL . "css/style.css?v" . time() ?>'>
    <link rel="stylesheet" href='<?= BASE_URL. "css{$style}?v=" .time(); ?>'> <!-- Fix: defined ASSET_VERSION in config -->
</head>
<body class="<?=(empty($aside)) ? 'no-sidemenu-body' : '' ?>">  
    <header>
        <nav>
            <ul>
                <a href="<?= BASE_URL; ?>home">Home</a>
                <?php if(User::isLoggedIn()) : ?>
                    <!-- <a href="<?= BASE_URL; ?>home/profile">Profile</a> -->
                    <a href="<?= BASE_URL; ?>auth/logout" id="logout">Logout</a>
                <?php else: ?>
                    <a href="<?= BASE_URL; ?>auth/login">Login</a>
                    <a href="<?= BASE_URL; ?>auth/register">Register</a>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <?php if(!empty($aside)):?>
        <aside>
            <?php require_once $aside?>
        </aside>
    <?php endif;?>

    <main>
        <?php require_once $content; ?>
    </main>


    <footer>
        <p>&copy;<?= date('Y'); ?> MVC Site</p>
    </footer>
</body>
</html>