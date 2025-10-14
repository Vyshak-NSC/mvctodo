<?php $pageTitle = 'login' ?>



<div class="auth-form">   
    <h1>Login</h1>
    <?php if(!empty($result) && !empty($result['message'])):?>
        <p style="color: <?= $result['success'] ? 'green' : 'red'; ?>">
            <?= htmlspecialchars($result['message']); ?>
        </p>
    <?php endif; ?>
    <form method="post" action="<?= BASE_URL; ?>auth/login">
        <input type="hidden" name="csrf_token" value="<?= CSRF::generateToken(); ?>">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Submit</button>
        
    </form>
    <p>Don't have an account? <a href="<?= BASE_URL; ?>auth/register">Register</a>"</p>
</div>