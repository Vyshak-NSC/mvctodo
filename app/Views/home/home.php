<?php $pageTitle = "Home"; ?>
<!-- <?php if(!empty($_GET["message"])): ?>
    <p style="color: green;">
        <?= htmlspecialchars($_GET["message"]) ?>
    </p>
<?php endif;?> -->

<div>
    <h1>Welcome, <?= User::currentUser() ?? 'Guest' ?></h1>
    <p>This is main content area</p>
</div>