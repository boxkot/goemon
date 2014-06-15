<?php
class Init
{
    private $_CI = null;

    public function setting()
    {
        $this->_CI = &get_instance();

        //コントローラー名とかセット
        $this->_CI->controllerName = $this->_CI->uri->segment(1, 'index');
        $this->_CI->actionName     = $this->_CI->uri->segment(2, 'index');

        //viewの設定うんたらくんたら
        $this->_CI->view = new view($this->_CI);

        //必要なヘルパー読んでおく
        $this->_CI->load->helper('model_operate');
    }
}

class view
{
    private $_CI             = null;
    private $_data           = array();
    private $_path           = '';
    private $_layoutPath     = '';
    private $_errorPath      = '';
    private $_viewPath       = 'views/';
    private $_ext            = '.tpl';
    private $_isRenderLayout = false;
    private $_isRenderView   = true;
    private $_isErrorView    = false;
    private $_isFileNotFound = false;
    private $_isRenderError  = false;


    public function __construct($_CI)
    {
        $this->_CI = $_CI;

        $_CI->load->config('view');
        $this->_viewPath = APPPATH . $this->_viewPath;

        if (!empty($_CI->config->config['error'])) {
            $this->_errorPath     = $this->_getCorrectPath($_CI->config->config['error']);
            $this->_isErrorRender = true;
        }
        if (!empty($_CI->config->config['layout'])) {
            $this->_layoutPath     = $this->_getCorrectPath($_CI->config->config['layout']);
            $this->_isRenderLayout = true;
            if ($this->_isFileNotFound) {
                throw new Exception("layout file {$this->_layoutPath} is not found");
            }
        }
    }

    public function getBasePath()
    {
        return $this->_viewPath;
    }

    public function getPath()
    {
        $path = trim(
            $this->_CI->controllerName . '/' . $this->_CI->actionName,
            '/'
        );
        $path = $this->_getCorrectPath($path);

        return $path;
    }

    public function getLayoutPath()
    {
        return $this->_layoutPath;
    }

    public function getErrorPath()
    {
        return $this->_errorPath;
    }

    public function setRenderLayout($isRender = true)
    {
        $this->_isRenderLayout = $isRender;
    }

    public function setRenderView($isRender = true)
    {
        $this->_isRenderView = $isRender;
    }

    public function isFileNotFound()
    {
        return $this->_isFileNotFound;
    }

    public function isRenderView()
    {
        return $this->_isRenderView;
    }

    public function isRenderError()
    {
        return $this->_isRenderError;
    }

    public function isRenderLayout()
    {
        return $this->_isRenderLayout;
    }

    public function assign($key, $value = null)
    {
        if (empty($key)) {
            throw new Exception('assign must set key');
        }

        if (!empty($key) && !empty($value)) {
            $this->_data[$key] = $value;
        } else if (is_array($key) && is_null($value)) {
            foreach ($key as $name => $val) {
                $this->_data[$key] = $value;
            }
        }

        return $this;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function setTemplatePath($path)
    {
        $this->_path = $this->_getCorrectPath($path);
        return $this;
    }

    private function _getCorrectPath($path)
    {
        $views = array(
            trim($this->_viewPath, '/'),
            trim($path, '/'),
        );

        if (!file_exists(implode('/', $views) . $this->_ext)) {

            if (!$this->isRenderError()) {
                throw new Exception("view file {$path} is not found");
            }
            $this->_isFileNotFound = true;
        }

        return trim($path, '/') . $this->_ext;
    }

    public function __get($key)
    {
        return $this->_data[$key];
    }

    public function __set($key, $val)
    {
        $this->_data[$key] = $val;
    }

}