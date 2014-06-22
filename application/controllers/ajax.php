<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends CI_Controller
{
    public function favorite_add()
    {
        $this->view->setRenderLayout(false);
        $this->view->setRenderView(false);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        $status = array(
            'id'     => 0,
            'status' => 'error'
        );

        if (isPost()) {
            $this->load->library('validate');
            $data = array(
                'user_id'           => $this->input->post('user_id'),
                'favorite_group_id' => $this->input->post('favorite_group_id'),
            );

            if ($this->validate->isValid($data)) {
                $this->load->model('Model_favorite_user', 'favorite_user', true);
                $id = $this->favorite_user->add($data);
                $status['id']     = $id;
                $status['status'] = 'success';
            }
        }

        echo json_encode($status);
    }

    public function favorite_delete()
    {
        $this->view->setRenderLayout(false);
        $this->view->setRenderView(false);

        //ヘルパー読み込み
        $this->load->helper('form_operate');

        $status = array('status' => 'error');

        if (isPost()) {
            $this->load->model('Model_favorite_user', 'favorite_user', true);
            $this->favorite_user->delete($this->input->post('favorite_id'));
            $status['status'] = 'success';
        }

        echo json_encode($status);
    }

}