<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AChat  基于PHP的在线聊天程序</title>
<link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.js"></script>
<script type="text/javascript">
function ireload(){
    var baseurl = '<?php echo site_url('chat').'?sid='.$sid;?>';
    var width = $('#width').val();
    var iwidth = $('#width').val();
    var height = $('#height').val();
    var username = $('#username').val();
    var diy = 1;
    if($('#autowidth').attr('checked') == true){
        width = '100%';
        iwidth = '800'
    }
    if($('#diy_username_program').attr('checked') == true){
        username = '{$username}';
        diy = 0;
    }
    url = baseurl + '&width=' + width + '&height=' + height + '&username=' + username + '&diy=' + diy;  
    $('.url').val(url);
    $('.width').val(width);
    $('.height').val(height);
    $('iframe').width(iwidth);
    $('iframe').height(height);
    $('iframe').attr('src', url);
}

$(function(){
    $('#autowidth').click(function(){
        if($(this).attr('checked') == true){
            $('#width').attr('disabled', 'true');
        }else{
            $('#width').removeAttr('disabled');
        }
    ireload()
    })
    
    $('#width').blur(function(){
        ireload();
    })
    $('#height').blur(function(){
        ireload();
    })
    $('.diy_username').click(function(){
        ireload();
    })
    $('#username').blur(function(){
        ireload();
    })

    
})

</script>
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
            <li class="here">
                <div class="sign2"></div>
                设置样式</li>
            <li class="seq"></li>
            <li>
                <div class="sign3"></div>
                插入代码</li>
        </ol>
        <form action="<?php echo site_url('creat/code');?>" method="post" class="setStyle">
        <input type="hidden" name="url" class="url" value="<?php echo site_url('chat').'?sid='.$sid;?>&width=800&height=460&username=游客&diy=1" />
        <input type="hidden" name="width" class="width" value="800" />
        <input type="hidden" name="height" class="height" value="460" />
            <dl>
                <dt>设置尺寸：</dt>
                <dd class="set_size"> 
                    <p>
                        宽 <input id="width" type="text" class="txt" value="800" /> px 高 <input id="height" type="text" class="txt" value="460" /> px
                    </p> 
                    <p class="normal" id="widget_wh_error">宽度、高度至少300px</p>
                    <p>
                        <input type="checkbox" class="chk" id="autowidth" />
                        <label for="autowidth">宽度自动适应</label>
                    </p>
                </dd>
                <dt>昵称设置：</dt>
                <dd>
                    <p>
                        <input type="radio" class="rd diy_username" name="diy_username" id="diy_username_diy" checked="true" value="diy" /> <label for="diy_username_diy">自定义昵称</label> <input type="text" class="txt" id="username" value="游客" />
                    </p>
                    <p>
                        <input type="radio" class="rd diy_username" name="diy_username" id="diy_username_program" value="program" /> <label for="diy_username_program">程序设置</label> <a href="#program_dec">详细说明</a>
                    </p>
                </dd>
                <p>
                    <input type="submit" class="submit" value="下一步">
                </p>
                <dt id="program_dec">程序设置昵称：</dt>
                <dd>
                    <p>把代码中<span>{$username}</span>部分替换为程序中输出username的语句，如PHP：</p>
                    <p>...&amp;username=&lt;?php echo $username;?&amp;...</p>
                </dd>
            </dl>
        </form>
        <div class="preview">
        <h2>效果预览</h2>
        <iframe src="<?php echo site_url('chat').'?sid='.$sid.'&width=800&height=460';?>" width="800" height="460" frameborder="0" id="iframe"></iframe>
        </div>
    </div>
</div>
<?php $this->load->view('footer.inc.php');?>
</body>
</html>