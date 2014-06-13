<?php
class Render
{
    private $_CI   = null;
    private $_twig = null;

    public function __construct()
    {
    }

    public function render()
    {
        $this->_CI = &get_instance();
        if (!$this->_CI->view->isFileNotFound()
            && $this->_CI->view->isRenderView()
        ) {
            $this->twigInit();

            if ($this->_CI->view->isRenderLayout()) {
                $toViewData = $this->_CI->view->getData();
                $child      = $this->_twig->render($this->_CI->view->getPath(), $toViewData);

                $toViewData['content'] = $child;
                $renderData = $this->_twig->render($this->_CI->view->getLayoutPath(), $toViewData);
            } else {
                $renderData = $this->_twig->render($this->_CI->view->getPath(), $toViewData);
            }

            echo $renderData;
        } else if ($this->_CI->view->isFileNotFound()) {
            echo $this->_twig->render($this->_CI->view->getErrorPath(), array());
        }
    }

    public function twigInit()
    {
        $loader      = new Twig_Loader_Filesystem($this->_CI->view->getBasePath());
        $this->_twig = new Twig_Environment($loader, array());
    }

}