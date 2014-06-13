<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loader
{
    public function init()
    {
        set_include_path(APPPATH . 'libraries/');
        //TwigのAutoLoader起動
        require 'Twig/Autoloader.php';
        Twig_Autoloader::register();

        //ZendのAutoLoader起動
        require 'Zend/Loader/Autoloader.php';
        Zend_Loader_Autoloader::getInstance();
    }

}