<ul class="nav nav-pills">
    <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/usuario') ?>">Posts</a>
    </li>
    <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/usuario/create') ?>">New Post</a>
    </li>
</ul>