<?= Template::message(); ?>
<div class="admin-box">
    <h3>New Usuario</h3>
    <?= form_open(current_url(), 'class="form-horizontal"'); ?>
    <?= form_open(REGISTER_URL); ?>


            <input type="text" name="email" class="input-xxlarge" value="<?php echo isset($post) ? $post->email : set_value('email'); ?>" placeholder="Correo"/>

            <input type="text" name="username" class="input-xxlarge" value="<?php echo isset($post) ? $post->email : set_value('username'); ?>" placeholder="Nombre de usuario"/>

            <input type="password" name="password" class="input-xxlarge" value="<?php echo isset($post) ? $post->pass : set_value('pass'); ?>" placeholder="Contraseña"/>

            <input type="password" name="pass_confirm" class="input-xxlarge" value="<?php echo isset($post) ? $post->pass : set_value('pass'); ?>" placeholder="Confirmar contraseña"/>

            <input type="text" name="nombre" class="input-xxlarge" value="<?php echo isset($post) ? $post->nombre : set_value('nombre'); ?>" placeholder="Nombre"/>

            <input type="text" name="apellido_paterno" class="input-xxlarge" value="<?php echo isset($post) ? $post->apellido_paterno : set_value('apellido_paterno'); ?>" placeholder="Apellido Paterno"/>

            <input type="text" name="apellido_materno" class="input-xxlarge" value="<?php echo isset($post) ? $post->apellido_materno : set_value('apellido_materno'); ?>" placeholder="Apellido Materno"/>

            <input type="text" name="fecha_nacimiento" class="input-xxlarge" value="<?php echo isset($post) ? $post->fecha_nacimiento : set_value('fecha_nacimiento'); ?>" placeholder="fecha de nacimiento"/>

            <input type="text" name="pais_nacimiento" class="input-xxlarge" value="<?php echo isset($post) ? $post->pais_nacimiento : set_value('pais_nacimiento'); ?>" placeholder="pais de nacimiento"/>

            <input type="text" name="residencia" class="input-xxlarge" value="<?php echo isset($post) ? $post->residencia : set_value('residencia'); ?>" placeholder="residencia"/>

            <input type="text" name="direccion" class="input-xxlarge" value="<?php echo isset($post) ? $post->direccion : set_value('direccion'); ?>" placeholder="direccion"/>

            <input type="text" name="colonia" class="input-xxlarge" value="<?php echo isset($post) ? $post->colonia : set_value('colonia'); ?>" placeholder="colonia"/>

            <input type="text" name="delegacion_municipio" class="input-xxlarge" value="<?php echo isset($post) ? $post->delegacion_municipio : set_value('delegacion_municipio'); ?>" placeholder="delegacion/municipio"/>

            <input type="text" name="cp" class="input-xxlarge" value="<?php echo isset($post) ? $post->cp : set_value('cp'); ?>" placeholder="Codigo Postal"/>

            <input type="text" name="edad" class="input-xxlarge" value="<?php echo isset($post) ? $post->edad : set_value('edad'); ?>" placeholder="Edad"/>

            <input type="text" name="sexo" class="input-xxlarge" value="<?php echo isset($post) ? $post->sexo : set_value('sexo'); ?>" placeholder="Sexo"/>

            <input type="text" name="telefono_contacto" class="input-xxlarge" value="<?php echo isset($post) ? $post->telefono_contacto : set_value('telefono_contacto'); ?>" placeholder="Telefono"/>

            <input type="hidden" name="language" value="english" />
            <input type="hidden" name="timezones" value="UM6" />
            <input type="hidden" name="country" value="MX" />
             <input type="submit" name="register" value="Create Account">

    <?php echo form_close(); ?>
    <?php echo form_close(); ?>
</div>