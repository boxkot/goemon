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

if (!function_exists('toInsert'))
{
    function toInsert($table, $data)
    {
        $columns = array();
        $values  = array();
        foreach ($data as $key => $val) {
            if (strpos($key, 'NotEscape:') === false) {
                $key = '`' . $key . '`';
            } else {
                $key = strtr($key, array('NotEscape:' => ''));
            }

            if (strpos($val, 'NotEscape:') === false) {
                $val = '"' . mysql_real_escape_string($val) . '"';
            } else {
                $val = strtr($val, array('NotEscape:' => ''));
            }

            $values[]  = $val;
            $columns[] = $key;
        }

        return sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            $table,
            implode(',', $columns),
            implode(',', $values)
        );
    }
}