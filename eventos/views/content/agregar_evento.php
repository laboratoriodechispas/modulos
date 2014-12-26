<div class="admin-box" xmlns="http://www.w3.org/1999/html">

    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>

    <div class="control-group <?php if (form_error('nombre_evento')) echo 'error'; ?>">
        <label for="title">Nombre</label>
        <div class="controls">
            <input type="text" name="nombre_evento" class="input-xlarge" value="<?php echo isset($post) ? $post->nombre_evento : set_value('nombre_evento'); ?>" />
            <?php if (form_error('nombre_evento')) echo '<span class="help-inline">'. form_error('nombre_evento') .'</span>'; ?>
        </div>
    </div>

    <div class="control-group <?php if (form_error('fecha')) echo 'error'; ?>">
        <label for="fecha">Fecha</label>
        <div class="controls">
            <input type="text" name="fecha" class="input-xlarge" value="<?php echo isset($post) ? $post->fecha : set_value('fecha'); ?>" />
            <?php if (form_error('fecha')) echo '<span class="help-inline">'. form_error('fecha') .'</span>'; ?>
        </div>
    </div>


    <div class="control-group <?php if (form_error('img_thumb')) echo 'error'; ?>">
        <label for="img_thumb">Imagen miniatura</label>
        <div class="controls">
            <input type="text" name="img_thumb" class="input-xlarge" value="<?php echo isset($post) ? $post->img_thumb : set_value('img_thumb'); ?>" />
            <?php if (form_error('img_thumb')) echo '<span class="help-inline">'. form_error('img_thumb') .'</span>'; ?>
        </div>
    </div>

    <div class="control-group <?php if (form_error('img_destacada')) echo 'error'; ?>">
        <label for="img_destacada">Imagen destacada</label>
        <div class="controls">
            <input type="text" name="img_destacada" class="input-xlarge" value="<?php echo isset($post) ? $post->img_destacada : set_value('img_destacada'); ?>" />
            <?php if (form_error('img_destacada')) echo '<span class="help-inline">'. form_error('img_destacada') .'</span>'; ?>
        </div>
    </div>

    <div class="control-group <?php if (form_error('ruta')) echo 'error'; ?>">
        <label for="ruta">Ruta</label>
        <div class="controls">
            <input type="text" name="ruta" class="input-xlarge" value="<?php echo isset($post) ? $post->ruta : set_value('ruta'); ?>" />
            <?php if (form_error('ruta')) echo '<span class="help-inline">'. form_error('ruta') .'</span>'; ?>
        </div>
    </div>

    <div class="control-group <?php if (form_error('descripcion')) echo 'error'; ?>">
        <label for="descripcion">Descripcion</label>
        <div class="controls">

                <input type="text" name="descripcion" class="input-xlarge" value="<?php echo isset($post) ? $post->descripcion : set_value('descripcion'); ?>" />

            <?php if (form_error('descripcion')) echo '<span class="help-inline">'. form_error('descripcion') .'</span>'; ?>
            <p class="help-block">Una breve descripcion del evento, no confundir con convocatoria</p>
        </div>
    </div>

    <div class="control-group <?php if (form_error('convocatoria')) echo 'error'; ?>">
        <label for="convocatoria">Convocatoria</label>
        <div class="controls">
            <textarea name="convocatoria" class="input-xxlarge" rows="15"><?php echo isset($post) ? $post->convocatoria : set_value('convocatoria') ?></textarea>
            <?php if (form_error('convocatoria')) echo '<span class="help-inline">'. form_error('convocatoria') .'</span>'; ?>
        </div>
    </div>

    <div class="control-group <?php if (form_error('tipo_evento')) echo 'error'; ?>">
        <label for="tipo_evento">Tipo de evento</label>
        <div class="controls">
            <?php $select = isset($post) ? $post->tipo_evento : "null"; ?>

            <select name="tipo_evento" class="input-xlarge"  />

            <?php  foreach($tipo_evento['data'] as $key): ?>

                <?php   if($select == $key->id): ?>
                    <option value="<?php echo $key->id; ?>" selected="selected">
                    <?php else: ?>
                    <option value="<?php echo $key->id; ?>">
                <?php endif; ?>

                  <?php echo $key->tipo; ?>
                </option>

            <?php endforeach; ?>
                </select>

            <?php if (form_error('tipo_evento')) echo '<span class="help-inline">'. form_error('tipo_evento') .'</span>'; ?>
        </div>
    </div>



    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Post" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/eventos') ?>">Cancel</a>
    </div>

    <?php echo form_close(); ?>
</div>