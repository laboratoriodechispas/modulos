<div class="admin-box">
    <h3>Blog Posts</h3>

    <?php echo form_open(); ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th class="column-check"><input class="check-all" type="checkbox" /></th>
            <th>Title</th>
            <th style="width: 10em">Date</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3">
                Seleccionados:
                <input type="submit" name="submit" class="btn" value="Eliminar">
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php if (isset($eventos) && is_array($eventos)) :?>
            <?php foreach ($eventos as $evento) : ?>
                <tr>
                    <td><input type="checkbox" name="checked[ ]" value="<?php echo $evento->id ?>" /></td>
                    <td>
                        <a href="<?php echo site_url('eventos/editar_evento/'. $evento->id) ?>">
                            <?php e($evento->nombre_evento); ?>
                        </a>
                    </td>
                    <td>
                        <?php  $time = strtotime($evento->fecha);
                                echo date('Y-m-d',$time); ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else : ?>
            <div class="alert alert-info">
                No Posts were found.
            </div>
        <?php endif; ?>

        </tbody>
    </table>

    <?php echo form_close(); ?>
</div>

