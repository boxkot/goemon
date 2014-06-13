<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_system'] = array(
    'class'    => 'Loader',
    'function' => 'init',
    'filepath' => 'hooks/service',
    'filename' => 'loader.php',
    'params'   => array(),
);

$hook['post_controller_constructor'][] = array(
    'class'    => 'Init',
    'function' => 'setting',
    'filepath' => 'hooks/service',
    'filename' => 'init.php',
    'params'   => array(),
);

$hook['post_controller_constructor'][] = array(
    'class'    => 'Login',
    'function' => 'confirm',
    'filepath' => 'hooks/auth',
    'filename' => 'login.php',
    'params'   => array(),
);

$hook['post_controller'] = array(
    'class'    => 'Render',
    'function' => 'render',
    'filepath' => 'hooks/service/view',
    'filename' => 'render.php',
    'params'   => array(),
);

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */