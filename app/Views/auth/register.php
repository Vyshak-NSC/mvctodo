<?php $pageTitle = 'Login'; ?>

<?php if(!empty($result) && !empty($result['message'])) :?>
    <p style="color: <?= $result['success'] ? 'green' : 'red'; ?>">
        <?= $result['message']; ?>
    </p>
<?php endif; ?>
    
<div class="auth-form">
    <h1>Register</h1>
    <form method="post" action="<?= BASE_URL; ?>auth/register">
        <input type="hidden" name="csrf_token" value="<?= CSRF::generateToken(); ?>">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Submit</button>
    </form>
    <p>Already have an account? <a href="<?= BASE_URL; ?>auth/login">Login</a>"</p>
</div>