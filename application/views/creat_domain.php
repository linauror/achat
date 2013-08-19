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
            <li class="here">
                <div class="sign1"></div>
                设定域名</li>
            <li class="seq"></li>
            <li>
                <div class="sign2"></div>
                设置样式</li>
            <li class="seq"></li>
            <li>
                <div class="sign3"></div>
                插入代码</li>
        </ol>
        <form method="post" class="setDomain">
            <p class="tip">请填写网站域名和邮箱</p>
            <p>
                <label>域名：</label>
                <input type="text" class="domain inputText" name="domain" placeholder="如：www.baidu.com，不带http://" />
            </p>
            <p>
                <label>邮箱：</label>
                <input type="text" class="email inputText" name="email" placeholder="可选填，以便跟踪网站数据"  />
            </p>
            <p>
                <input type="submit" class="submit" value="下一步" />
            </p>
            <div class="domainResults">
                <a href="#">www.linauror.com</a>
                <a href="#">www.baidu.com</a>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('footer.inc.php');?>
</body>
</html>