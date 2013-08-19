<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class chat extends CI_Controller
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
        $get = $this->input->get();
        $check = $this->db->get_where('site', array('sid' => $get['sid']))->row_array();
        if(!$check)
        {
            exit('无效的sid！');
        }
        
        $this->db->select('*')->limit('10')->where('sid', $get['sid'])->order_by('id', 'desc');
        $chatBox = $this->db->get('chat')->result_array();
        krsort($chatBox);
        $timelimit = (mktime() - 5 * 60) * 10000;
        $this->db->select('username')->limit('10')->group_by('username')->where('time > '.$timelimit)->where('sid', $get['sid']);
        $online = $this->db->get('chat')->result_array();
        
        //样式设置
        $username = $this->input->get('username') ? $this->input->get('username') : '游客';
        $width = '300px';
        $height = '300';
        $diy = 'text';
        //宽度
        if(isset($get['width']))
        {
            if(strstr($get['width'], '%'))
            {
                $width = '100%';
            }else
            {
                $get['width'] = floor($get['width']);
                $width = $get['width'] < $width ? $width.'px' : $get['width'].'px';
            }
            
        }
        //高度
        if(isset($get['height']))
        {
            $get['height'] = floor($get['height']);
            $height = $get['height'] < $height ? $height : $get['height'];
        }
        //昵称框显示
        if(isset($get['diy']))
        {
            if($get['diy'] == 0)
            {
                $diy = 'hidden';
            }
        }
        
        
        $html['sid'] = $get['sid'];
        $html['chatBox'] = $chatBox;
        $html['online'] = $online;
        $html['time'] = microtime(true) * 10000;
        $html['username'] = $username;
        $html['width'] = $width;
        $html['height'] = $height;
        $html['diy'] = $diy;
        
        $this->load->view('chat', $html);
    }
    
    /**
     * 发送
     */
    public function submit()
    {
        if($this->input->post('username') && $this->input->post('words')){
            $now = microtime(true) * 10000;
            if($this->db->insert('chat', array('sid' => $this->input->post('sid'),'username' => $this->input->post('username', TRUE), 'words' => $this->input->post('words' ,TRUE), 'time' => $now))){
                $return['time'] = $now;
                $return['formattime'] = date('H:i:s', $now/10000);
                exit(json_encode($return));
            }
        }
    }
    
    /**
     * 新聊天信息
     */
    public function newchat()
    {
        $time = $this->input->post('time');
        $this->db->select('*')->where('time > '.$time)->where('sid',$this->input->post('sid'));
        $newchat = $this->db->get('chat')->result_array();
        krsort($newchat);
        $return['count'] = count($newchat);
        $return['time'] = microtime(true) * 10000;
        $return['data'] = $newchat;
        exit(json_encode($return));
    }
    
    /**
     * 在线成员
     */
    public function online()
    {
        $timelimit = (mktime() - 5 * 60) * 10000;
        $this->db->select('username')->limit('10')->group_by('username')->where('time > '.$timelimit)->where('sid',$this->input->post('sid'));
        $online = $this->db->get('chat')->result_array();
        exit(json_encode($online));
    }
    
}

/* End of file chat.php */
/* Location: ./application/controllers/chat.php */