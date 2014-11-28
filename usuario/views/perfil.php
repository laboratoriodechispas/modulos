<?php if (!($this->auth->is_logged_in())) : ?>
    <?php  redirect('usuario/entrar'); ?>
<?php else: ?>

    <div class="admin-box">
        <h3>Perfil</h3>
        <?= form_open(current_url(), 'class="form-horizontal"'); ?>

        <input type="text" name="email" class="input-xxlarge" value="<?php echo isset($tablaUser) ? $tablaUser->email : set_value('email'); ?>" readonly/>
        <?php if (form_error('email')) echo '<span class="help-inline">'. form_error('email') .'</span>'; ?>

        <input type="text" name="username" class="input-xxlarge" value="<?php echo isset($tablaUser) ? $tablaUser->username : set_value('username'); ?>" placeholder="Nombre de usuario" readonly/>
        <?php if (form_error('username')) echo '<span class="help-inline">'. form_error('username') .'</span>'; ?>

        <input type="password" name="password" class="input-xxlarge"  placeholder="Contraseña"/>
        <?php if (form_error('password')) echo '<span class="help-inline">'. form_error('password') .'</span>'; ?>

        <input type="password" name="pass_confirm" class="input-xxlarge"  placeholder="Confirmar contraseña"/>
        <?php if (form_error('pass_confirm')) echo '<span class="help-inline">'. form_error('pass_confirm') .'</span>'; ?>

        <input type="text" name="nombre" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->nombre : set_value('nombre'); ?>" placeholder="Nombre"/>
        <?php if (form_error('nombre')) echo '<span class="help-inline">'. form_error('nombre') .'</span>'; ?>

        <input type="text" name="apellido_paterno" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->apellido_paterno : set_value('apellido_paterno'); ?>" placeholder="Apellido Paterno"/>
        <?php if (form_error('apellido_paterno')) echo '<span class="help-inline">'. form_error('apellido_paterno') .'</span>'; ?>

        <input type="text" name="apellido_materno" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->apellido_materno : set_value('apellido_materno'); ?>" placeholder="Apellido Materno"/>
        <?php if (form_error('apellido_materno')) echo '<span class="help-inline">'. form_error('apellido_materno') .'</span>'; ?>

        <input type="text" name="fecha_nacimiento" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->fecha_nacimiento : set_value('fecha_nacimiento'); ?>" placeholder="fecha de nacimiento"/>
        <?php if (form_error('fecha_nacimiento')) echo '<span class="help-inline">'. form_error('fecha_nacimiento') .'</span>'; ?>

        <input type="text" name="pais_nacimiento" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->pais_nacimiento : set_value('pais_nacimiento'); ?>" placeholder="pais de nacimiento"/>
        <?php if (form_error('pais_nacimiento')) echo '<span class="help-inline">'. form_error('pais_nacimiento') .'</span>'; ?>

        <input type="text" name="residencia" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->residencia : set_value('residencia'); ?>" placeholder="residencia"/>
        <?php if (form_error('residencia')) echo '<span class="help-inline">'. form_error('residencia') .'</span>'; ?>

        <input type="text" name="direccion" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->direccion : set_value('direccion'); ?>" placeholder="direccion"/>
        <?php if (form_error('direccion')) echo '<span class="help-inline">'. form_error('direccion') .'</span>'; ?>

        <input type="text" name="colonia" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->colonia : set_value('colonia'); ?>" placeholder="colonia"/>
        <?php if (form_error('colonia')) echo '<span class="help-inline">'. form_error('colonia') .'</span>'; ?>

        <input type="text" name="delegacion_municipio" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->delegacion_municipio : set_value('delegacion_municipio'); ?>" placeholder="delegacion/municipio"/>
        <?php if (form_error('delegacion_municipio')) echo '<span class="help-inline">'. form_error('delegacion_municipio') .'</span>'; ?>

        <input type="text" name="cp" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->cp : set_value('cp'); ?>" placeholder="Codigo Postal"/>
        <?php if (form_error('cp')) echo '<span class="help-inline">'. form_error('cp') .'</span>'; ?>

        <input type="text" name="edad" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->edad : set_value('edad'); ?>" placeholder="Edad"/>
        <?php if (form_error('edad')) echo '<span class="help-inline">'. form_error('edad') .'</span>'; ?>

        <input type="text" name="sexo" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->sexo : set_value('sexo'); ?>" placeholder="Sexo"/>
        <?php if (form_error('sexo')) echo '<span class="help-inline">'. form_error('sexo') .'</span>'; ?>

        <input type="text" name="telefono_contacto" class="input-xxlarge" value="<?php echo isset($tablaUsuario) ? $tablaUsuario->telefono_contacto : set_value('telefono_contacto'); ?>" placeholder="Telefono"/>
        <?php if (form_error('telefono_contacto')) echo '<span class="help-inline">'. form_error('telefono_contacto') .'</span>'; ?>

        <input type="hidden" name="language" value="english" />
        <input type="hidden" name="timezones" value="UM6" />
        <input type="hidden" name="country" value="MX" />

        <input type="submit" name="update" value="Actualizar">


        <?php echo form_close(); ?>
    </div>
<?php endif; ?>