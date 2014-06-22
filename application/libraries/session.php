<?php
require_once APPPATH . 'libraries/Zend/Session/Namespace.php';

class session extends Zend_Session_Namespace
{
    public function destroy()
    {
        Zend_Session::destroy();
    }

}
