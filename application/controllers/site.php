<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller
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
        $this->load->view('site_index');
    }

    /**
     * 注册
     */
    public function reg()
    {
        $domain = $this->input->post('domain');
        $pass= $this->input->post('pass');
        if($domain && $pass)
        {
            $check = $this->db->get_where('site',array('domain' => $domain))->row_array();
            if($check)
            {
                show_message('此网站域名已经注册，请重试！');
            }
            $this->db->insert('site', array('domain' => $domain, 'pass' => md5($pass)));
            show_message('恭喜你，注册成功，请登录！', 'site');
            
        }
        $this->load->view('site_reg');
    }

    /**
     * 管理
     */
    public function manage()
    {
        $sid = $this->input->post('sid');
        $domain = $this->input->post('domain');
        $pass= $this->input->post('pass');
        if($domain && $pass)
        {
            $check = $this->db->get_where('site',array('domain' => $domain, 'pass' => md5($pass)))->row_array();
            if(!$check)
            {
                show_message('登录失败，请重试！', 'site');
            }
            if($sid){
                unset($_POST['sid'], $_POST['domain'], $_POST['pass']);
                $this->db->update('site', $_POST, array('sid' => $sid));
                $check = $this->db->get_where('site',array('sid' => $sid))->row_array();                 
            }
            $html = array();
            $check['pass'] = $pass;
            $html = $check;
            $this->load->view('site_manage', $html);
            
            
        } 
    }
    
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */
