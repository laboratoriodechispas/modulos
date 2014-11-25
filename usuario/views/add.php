<div class="admin-box">
    <h3>New Usuarios</h3>

    <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>

    <div class="control-group <?php if (form_error('nombre')) echo 'error'; ?>">
        <label for="nombre">Nombre</label>
        <div class="controls">
            <input type="text" name="nombre" class="input-xxlarge" value="<?php echo isset($post) ? $post->nombre : set_value('nombre'); ?>" />
            <?php if (form_error('nombre')) echo '<span class="help-inline">'. form_error('nombre') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('apellido_paterno')) echo 'error'; ?>">
        <label for="apellido_paterno">Apellido Paterno</label>
        <div class="controls">
            <input type="text" name="apellido_paterno" class="input-xxlarge" value="<?php echo isset($post) ? $post->apellido_paterno : set_value('apellido_paterno'); ?>" />
            <?php if (form_error('apellido_paterno')) echo '<span class="help-inline">'. form_error('apellido_paterno') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('apellido_materno')) echo 'error'; ?>">
        <label for="apellido_materno">Apellido Materno</label>
        <div class="controls">
            <input type="text" name="apellido_materno" class="input-xxlarge" value="<?php echo isset($post) ? $post->apellido_materno : set_value('apellido_materno'); ?>" />
            <?php if (form_error('apellido_materno')) echo '<span class="help-inline">'. form_error('apellido_materno') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('fecha_nacimiento')) echo 'error'; ?>">
        <label for="fecha_nacimiento">Fecha Nacimiento</label>
        <div class="controls">
            <input type="text" name="fecha_nacimiento" class="input-xxlarge" value="<?php echo isset($post) ? $post->fecha_nacimiento : set_value('fecha_nacimiento'); ?>" />
            <?php if (form_error('fecha_nacimiento')) echo '<span class="help-inline">'. form_error('fecha_nacimiento') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('pais_nacimiento')) echo 'error'; ?>">
        <label for="pais_nacimiento">Pais Nacimiento</label>
        <div class="controls">
            <input type="text" name="pais_nacimiento" class="input-xxlarge" value="<?php echo isset($post) ? $post->pais_nacimiento : set_value('pais_nacimiento'); ?>" />
            <?php if (form_error('pais_nacimiento')) echo '<span class="help-inline">'. form_error('pais_nacimiento') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('residencia')) echo 'error'; ?>">
        <label for="residencia">Residencia</label>
        <div class="controls">
            <input type="text" name="residencia" class="input-xxlarge" value="<?php echo isset($post) ? $post->residencia : set_value('residencia'); ?>" />
            <?php if (form_error('residencia')) echo '<span class="help-inline">'. form_error('residencia') .'</span>'; ?>
        </div>
    </div><div class="control-group <?php if (form_error('direccion')) echo 'error'; ?>">
        <label for="direccion">Direccion</label>
        <div class="controls">
            <input type="text" name="direccion" class="input-xxlarge" value="<?php echo isset($post) ? $post->direccion : set_value('direccion'); ?>" />
            <?php if (form_error('direccion')) echo '<span class="help-inline">'. form_error('direccion') .'</span>'; ?>
        </div>
    </div><div class="control-group <?php if (form_error('colonia')) echo 'error'; ?>">
        <label for="colonia">Colonia</label>
        <div class="controls">
            <input type="text" name="colonia" class="input-xxlarge" value="<?php echo isset($post) ? $post->colonia : set_value('colonia'); ?>" />
            <?php if (form_error('colonia')) echo '<span class="help-inline">'. form_error('colonia') .'</span>'; ?>
        </div>
    </div><div class="control-group <?php if (form_error('delegacion_municipio')) echo 'error'; ?>">
        <label for="delegacion_municipio">Delegacion/Municipio</label>
        <div class="controls">
            <input type="text" name="delegacion_municipio" class="input-xxlarge" value="<?php echo isset($post) ? $post->delegacion_municipio : set_value('delegacion_municipio'); ?>" />
            <?php if (form_error('delegacion_municipio')) echo '<span class="help-inline">'. form_error('delegacion_municipio') .'</span>'; ?>
        </div>
    </div><div class="control-group <?php if (form_error('cp')) echo 'error'; ?>">
        <label for="cp">Codigo postal</label>
        <div class="controls">
            <input type="text" name="cp" class="input-xxlarge" value="<?php echo isset($post) ? $post->cp : set_value('cp'); ?>" />
            <?php if (form_error('cp')) echo '<span class="help-inline">'. form_error('cp') .'</span>'; ?>
        </div>
    </div><div class="control-group <?php if (form_error('edad')) echo 'error'; ?>">
        <label for="edad">Edad</label>
        <div class="controls">
            <input type="text" name="edad" class="input-xxlarge" value="<?php echo isset($post) ? $post->edad : set_value('edad'); ?>" />
            <?php if (form_error('edad')) echo '<span class="help-inline">'. form_error('edad') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('sexo')) echo 'error'; ?>">
        <label for="sexo">Sexo</label>
        <div class="controls">
            <input type="text" name="sexo" class="input-xxlarge" value="<?php echo isset($post) ? $post->sexo : set_value('sexo'); ?>" />
            <?php if (form_error('sexo')) echo '<span class="help-inline">'. form_error('sexo') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('email')) echo 'error'; ?>">
        <label for="email">Email</label>
        <div class="controls">
            <input type="text" name="email" class="input-xxlarge" value="<?php echo isset($post) ? $post->email : set_value('email'); ?>" />
            <?php if (form_error('email')) echo '<span class="help-inline">'. form_error('email') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('telefono_contacto')) echo 'error'; ?>">
        <label for="telefono_contacto">Telefono</label>
        <div class="controls">
            <input type="text" name="telefono_contacto" class="input-xxlarge" value="<?php echo isset($post) ? $post->telefono_contacto : set_value('telefono_contacto'); ?>" />
            <?php if (form_error('telefono_contacto')) echo '<span class="help-inline">'. form_error('telefono_contacto') .'</span>'; ?>
        </div>
    </div>
    <div class="control-group <?php if (form_error('pass')) echo 'error'; ?>">
        <label for="pass">Pass</label>
        <div class="controls">
            <input type="text" name="pass" class="input-xxlarge" value="<?php echo isset($post) ? $post->pass : set_value('pass'); ?>" />
            <?php if (form_error('pass')) echo '<span class="help-inline">'. form_error('pass') .'</span>'; ?>
        </div>
    </div>

    <div class="form-actions">
        <input type="submit" name="submit" class="btn btn-primary" value="Save Post" />
        or <a href="<?php echo site_url(SITE_AREA .'/content/usuario') ?>">Cancel</a>
    </div>

    <?php echo form_close(); ?>
</div>