<?php if ($this->auth->is_logged_in()) : ?>
    <a href="<?= site_url('logout') ?>">Logout</a>
<?php else: ?>
<div class="admin-box">
    <h3>Nuevo Usuario</h3>
    <?= form_open(current_url(), 'class="form-horizontal"'); ?>

            <input type="text" name="email" class="input-xxlarge" value="<?php echo isset($post) ? $post->email : set_value('email'); ?>" placeholder="Correo"/>
            <?php if (form_error('email')) echo '<span class="help-inline">'. form_error('email') .'</span>'; ?>

            <input type="text" name="username" class="input-xxlarge" value="<?php echo isset($post) ? $post->username : set_value('username'); ?>" placeholder="Nombre de usuario"/>
            <?php if (form_error('username')) echo '<span class="help-inline">'. form_error('username') .'</span>'; ?>

            <input type="password" name="password" class="input-xxlarge" value="<?php echo isset($post) ? $post->pass : set_value('pass'); ?>" placeholder="Contraseña"/>
            <?php if (form_error('password')) echo '<span class="help-inline">'. form_error('password') .'</span>'; ?>

            <input type="password" name="pass_confirm" class="input-xxlarge" value="<?php echo isset($post) ? $post->pass : set_value('pass'); ?>" placeholder="Confirmar contraseña"/>
            <?php if (form_error('pass_confirm')) echo '<span class="help-inline">'. form_error('pass_confirm') .'</span>'; ?>

            <input type="text" name="nombre" class="input-xxlarge" value="<?php echo isset($post) ? $post->nombre : set_value('nombre'); ?>" placeholder="Nombre"/>
            <?php if (form_error('nombre')) echo '<span class="help-inline">'. form_error('nombre') .'</span>'; ?>

            <input type="text" name="apellido_paterno" class="input-xxlarge" value="<?php echo isset($post) ? $post->apellido_paterno : set_value('apellido_paterno'); ?>" placeholder="Apellido Paterno"/>
            <?php if (form_error('apellido_paterno')) echo '<span class="help-inline">'. form_error('apellido_paterno') .'</span>'; ?>

            <input type="text" name="apellido_materno" class="input-xxlarge" value="<?php echo isset($post) ? $post->apellido_materno : set_value('apellido_materno'); ?>" placeholder="Apellido Materno"/>
            <?php if (form_error('apellido_materno')) echo '<span class="help-inline">'. form_error('apellido_materno') .'</span>'; ?>

            <input type="text" name="fecha_nacimiento" class="input-xxlarge" value="<?php echo isset($post) ? $post->fecha_nacimiento : set_value('fecha_nacimiento'); ?>" placeholder="fecha de nacimiento"/>
            <?php if (form_error('fecha_nacimiento')) echo '<span class="help-inline">'. form_error('fecha_nacimiento') .'</span>'; ?>

            <input type="text" name="pais_nacimiento" class="input-xxlarge" value="<?php echo isset($post) ? $post->pais_nacimiento : set_value('pais_nacimiento'); ?>" placeholder="pais de nacimiento"/>
            <?php if (form_error('pais_nacimiento')) echo '<span class="help-inline">'. form_error('pais_nacimiento') .'</span>'; ?>

            <input type="text" name="residencia" class="input-xxlarge" value="<?php echo isset($post) ? $post->residencia : set_value('residencia'); ?>" placeholder="residencia"/>
            <?php if (form_error('residencia')) echo '<span class="help-inline">'. form_error('residencia') .'</span>'; ?>

            <input type="text" name="direccion" class="input-xxlarge" value="<?php echo isset($post) ? $post->direccion : set_value('direccion'); ?>" placeholder="direccion"/>
            <?php if (form_error('direccion')) echo '<span class="help-inline">'. form_error('direccion') .'</span>'; ?>

            <input type="text" name="colonia" class="input-xxlarge" value="<?php echo isset($post) ? $post->colonia : set_value('colonia'); ?>" placeholder="colonia"/>
            <?php if (form_error('colonia')) echo '<span class="help-inline">'. form_error('colonia') .'</span>'; ?>

            <input type="text" name="delegacion_municipio" class="input-xxlarge" value="<?php echo isset($post) ? $post->delegacion_municipio : set_value('delegacion_municipio'); ?>" placeholder="delegacion/municipio"/>
            <?php if (form_error('delegacion_municipio')) echo '<span class="help-inline">'. form_error('delegacion_municipio') .'</span>'; ?>

            <input type="text" name="cp" class="input-xxlarge" value="<?php echo isset($post) ? $post->cp : set_value('cp'); ?>" placeholder="Codigo Postal"/>
            <?php if (form_error('cp')) echo '<span class="help-inline">'. form_error('cp') .'</span>'; ?>

            <input type="text" name="edad" class="input-xxlarge" value="<?php echo isset($post) ? $post->edad : set_value('edad'); ?>" placeholder="Edad"/>
            <?php if (form_error('edad')) echo '<span class="help-inline">'. form_error('edad') .'</span>'; ?>

            <input type="text" name="sexo" class="input-xxlarge" value="<?php echo isset($post) ? $post->sexo : set_value('sexo'); ?>" placeholder="Sexo"/>
            <?php if (form_error('sexo')) echo '<span class="help-inline">'. form_error('sexo') .'</span>'; ?>

            <input type="text" name="telefono_contacto" class="input-xxlarge" value="<?php echo isset($post) ? $post->telefono_contacto : set_value('telefono_contacto'); ?>" placeholder="Telefono"/>
            <?php if (form_error('telefono_contacto')) echo '<span class="help-inline">'. form_error('telefono_contacto') .'</span>'; ?>

            <input type="hidden" name="language" value="english" />
            <input type="hidden" name="timezones" value="UM6" />
            <input type="hidden" name="country" value="MX" />

             <input type="submit" name="register" value="Create Account">


    <?php echo form_close(); ?>
</div>
<?php endif; ?>