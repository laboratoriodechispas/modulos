<?php if ($this->auth->is_logged_in()) : ?>
    <a href="<?= site_url('logout') ?>">Logout</a>
<?php else: ?>

    <?= form_open('forgot_password', 'class="login"') ?>

    <input type="email" name="email" placeholder="Email">

    <input class="btn btn-primary" type="submit" name="send" value="Send Password">
    <?= form_close(); ?>
<?php endif; ?>