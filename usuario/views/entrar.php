<?php if ($this->auth->is_logged_in()) : ?>
    <a href="<?= site_url('logout') ?>">Logout</a>
<?php else: ?>

    <?= form_open(LOGIN_URL, 'class="login"') ?>
    <input type="hidden" name="redirect_url" value="/">

    <input type="email" name="login" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" name="log-me-in" value="Login">or <a href="<?php echo site_url('usuario/recuperar') ?>">recuperar</a>
    <label class="checkbox" for="remember_me">
        <input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3">
        <span class="inline-help">Remember me</span>
    </label>
    <?= form_close(); ?>
<?php endif; ?>