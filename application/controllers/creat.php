<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Creat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 首页
     */
    public function index()
    {
        redirect('creat/domain');
    }
    
    
    /**
     * 输入域名 
     */
    public function domain(){
        if($this->input->post('domain'))
        {
            $check = $this->db->get_where('site', array('domain' => $this->input->post('domain')))->row_array();
            if($check)
            {
                redirect('creat/style/'.$check['sid']);
            }else
            {
                $this->db->insert('site', array('domain' => $this->input->post('domain'), 'email' => $this->input->post('email')));
                $sid = $this->db->insert_id();
                redirect('creat/style/'.$sid);
            }
        }
        $this->load->view('creat_domain');
    }
    
    
    /**
     * 样式设置
     * @param $sid float 
     */
    public function style($sid){
        $check = $this->db->get_where('site', array('sid' => $sid))->row_array();
        if(!$check){
            show_message('无效的sid！');
        }
        
        $html = array();
        $html['sid'] = $sid;
        $this->load->view('creat_style', $html);
    }
    
    
    /**
     * 插入代码 
     */
    public function code(){
        $html = $this->input->post();
        $this->load->view('creat_code', $html);
    }
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */
