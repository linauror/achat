<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AChat  基于PHP的在线聊天程序</title>
<link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.js"></script>
</head>

<body id="creatBody">
<?php $this->load->view('header.inc.php');?>
<div id="content">
    <div class="CreatCon">
        <ol class="signs">
            <li>
                <div class="sign1"></div>
                设定域名</li>
            <li class="seq"></li>
            <li>
                <div class="sign2"></div>
                设置样式</li>
            <li class="seq"></li>
            <li class="here">
                <div class="sign3"></div>
                插入代码</li>
        </ol>
        <form action="" method="post" class="insertCode">
            <textarea><iframe src="<?php echo $url;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" frameborder="0"></iframe></textarea>
            <p>复制以上代码插入网页中即可！</p>
            <p>注：如选择程序控制请把代码中{$username}替换为程序输出用户名部分</p>
        </form>
    </div>
</div>
<?php $this->load->view('footer.inc.php');?>
</body>
</html>