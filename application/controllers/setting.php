<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class setting extends CI_Controller
{
    private $_formElementsProfile = array(
        'name',
        'mail',
    );

    public function index()
    {
    }

    public function profile()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));
        $this->load->library('validate');

        //モデル読み込み
        $this->load->model('Model_user', 'user', true);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        if (isPost()) {
            $data = getForm($this->_formElementsProfile);
            $this->user->edit($data, $this->auth->getId());
        }

        $this->view->data = $this->user->get($this->auth->getId());
    }

    public function password()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));
        $this->load->library('validate');

        //モデル読み込み
        $this->load->model('Model_user', 'user', true);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        if (isPost()) {
        }
    }

    public function favorite()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));

        //モデル読み込み
        $this->load->model('Model_favorite_group', 'favorite_group', true);

        $this->view->data = $this->favorite_group->getList($this->auth->getId());
     }

}