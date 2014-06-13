<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class validate
{
    private $_CI       = null;
    private $_config   = array();
    private $_filter   = array();
    private $_validate = array();
    private $_option   = array();
    private $_error    = array();

    public function __construct()
    {
        $this->_CI = &get_instance();

        //ConfigのPATH指定
        $path = APPPATH . 'config/validate/' . $this->_CI->controllerName . '.ini';

        //Configをインスタンス化
        $this->_config = new Zend_Config_Ini($path, 'validate');

        if (!empty($this->_config->filters) === false) {
            $this->_filter = $this->_config->filters->toArray();
        }

        if (empty($this->_config->validators) === false) {
            $this->_validate = $this->_config->validators->toArray();
        }
    }

    public function isValid($data)
    {
        if (empty($this->_validate)) {
            return true;
        }

        $valid = new Zend_Filter_Input($this->_filter, $this->_validate, $data);

        $result = $valid->isValid();

        if ($result === false) {
            foreach ($valid->getInvalid() as $key => $val) {
                $this->setError($key, $val);
            }
        }

        return $result;
    }

    public function setError($key, $val)
    {
        $this->_error[$key] = $val;
        return $this;
    }

    public function getError()
    {
        return $this->_error;
    }

    public function existError()
    {
        return empty($this->_error) === false;
    }

}