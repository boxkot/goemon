<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('toColumn'))
{
    function toColumn($data, $name = '')
    {
        $query = '';
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $query .= $val . ' as ' . $key . ',';
            }

            return substr($query, 0, -1);
        }

        return $name . ' as ' . $data;
    }
}
