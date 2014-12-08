<?= Template::message(); ?>

<img src="/assets/images/frog.jpg">
<div class="panel right">
    <h1>New to Ribbit?</h1>
    <?= form_open(REGISTER_URL); ?>
    <input type="hidden" name="redirect_url" value="/">

    <input name="email" type="text" placeholder="Email" value="<?= set_value('email') ?>">
    <input name="username" type="text" placeholder="Username" value="<?= set_value('username') ?>">
    <input name="password" type="text" placeholder="Password">
    <input name="pass_confirm" type="password" placeholder="Password (again)">
    <input type="submit" name="register" value="Create Account">
    <?= form_close(); ?>
</div>