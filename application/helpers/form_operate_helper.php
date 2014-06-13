<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('isPost'))
{
    function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}

if (!function_exists('isGet'))
{
    function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}

if (!function_exists('getForm'))
{
    function getForm($formElements)
    {
        $data = array();

        foreach ($formElements as $name) {
            if (!empty($_POST) && !empty($_POST[$name])) {
                $data[$name] = $_POST[$name];
            } else {
                $data[$name] = NULL;
            }
        }

        return $data;
    }
}