<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class favorite extends CI_Controller
{
    public function add()
    {
        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        $data = array(
            'name'    => $this->input->post('name'),
            'user_id' => $this->auth->getId(),
        );

        if (isPost() && !empty($data['name'])) {
            $this->load->model('Model_favorite_group', 'favorite_group', true);
            $id = $this->favorite_group->add($data);

            redirect("/favorite/edit/?id={$id}");
        }

        redirect('/user/index/');
    }

    public function edit()
    {
        //ヘルパー読み込み
        $this->load->helper('url');

        $favoriteGroupId = $this->input->get('id', false);
        if ($favoriteGroupId === false) {
            redirect('/user/index/');
        }

        //ライブラリ読み込み
        $this->load->library('auth', array('namespace' => 'User'));

        //モデル読み込み
        $this->load->model('Model_user', 'user', true);
        $this->load->model('Model_unit', 'unit', true);
        $this->load->model('Model_favorite_user', 'favorite_user', true);

        $this->view->id       = $favoriteGroupId;
        $this->view->data     = $this->user->getList($this->auth->getId());
        $this->view->unit     = $this->unit->getAll();
        $this->view->favorite = $this->favorite_user->getList($favoriteGroupId);
    }

}
