<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['module_config'] = array(
    'name'          => 'webservice',
    'description'   => 'Webservice para usuarios',
    'author'        => 'Vendetta',
    'homepage'      => 'http://localhost/bonfire/public/index.php',
    'version'       => '1.0.1',
    'menu'          => array(
        'context'   => 'path/to/view'
    ),
    'weights'       => array(
        'context'   => 0
    )
);
?>