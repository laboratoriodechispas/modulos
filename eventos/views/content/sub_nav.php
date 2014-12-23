<ul class="nav nav-pills">
    <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/eventos') ?>">Eventos</a>
    </li>
    <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url(SITE_AREA .'/content/eventos/agregar') ?>">Nuevo Evento</a>
    </li>
</ul>