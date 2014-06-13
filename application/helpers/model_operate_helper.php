<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('toColumn'))
{
    function toColumn($data)
    {
        $query = '';
        foreach ($data as $key => $val) {
            $query .= $val . ' as ' . $key . ',';
        }

        return substr($query, -1);
    }
}
