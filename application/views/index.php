<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AChat  基于PHP的在线聊天程序</title>
<link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.js"></script>
</head>

<body id="indexBody">
<?php $this->load->view('header.inc.php');?>
<div id="content">
    <div class="index">
        <a href="<?php echo site_url('creat');?>"><img src="<?php echo base_url();?>static/images/index.jpg" title="立即体验" /></a>
        <iframe src="<?php echo site_url('chat');?>?sid=1&width=100%&height=300&diy=1&username=游客" width="100%" height="300" frameborder="0"></iframe>
    </div>
</div>
<?php $this->load->view('footer.inc.php');?>
</body>
</html>