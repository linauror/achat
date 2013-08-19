<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AChat</title>
<link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.js"></script>
<script type="text/javascript">
function submit(){
    var username = $('.username').val();
    var words = $('.words').val();
    if(username.length < 1){
        alert('请给个昵称吧!');
        $('.username').focus();
        return false;
    }else if(words.length < 1){
        alert('不能发送空字符！');
        $('.words').focus();
        return false;
    }
    $.ajax({
        type : "POST",
        url : "<?php echo site_url('chat/submit');?>",
        data : "username=" + username + "&words=" + words + "&sid=<?php echo $sid;?>",
        success : function(data){
            data = eval('('+data+')');
            var addchat = '<strong>'+ username + ' ' +data.formattime +'</strong><p>' + words + '</p>';
            $('.words').val('');
            $('.chatBox').append(addchat);
            $('.username').attr('time', data.time);
            theScrollTop = document.getElementById('chatBox').scrollTop;
            $('.chatBox').animate({scrollTop: parseInt(theScrollTop) + 50 + 'px'});
        }
    })
}
function newchat(){
    var time = $('.username').attr('time');
    $.ajax({
        type : "POST",
        url : "<?php echo site_url('chat/newchat');?>",
        data : "time=" + time + "&sid=<?php echo $sid;?>",
        success : function(data){
            data = eval('('+data+')');
            addchat = '';
            if(data.count){
                $(data.data).each(function(x,y){
                    var d = new Date(y.time/10);
                    addchat += '<strong>' + y.username + ' ' + ('0' + d.getHours()).slice(-2) + ":" +('0' + d.getMinutes()).slice(-2) + ":" + ('0' + d.getSeconds()).slice(-2) + '</strong><p>' + y.words + '</p>';
                });
                $('.chatBox').append(addchat);
                $('.username').attr('time', data.time); 
                theScrollTop = document.getElementById('chatBox').scrollTop;
                $('.chatBox').animate({scrollTop: parseInt(theScrollTop) + 25 * (parseInt(data.count) + 1) + 'px'});
                
            }
        }
    })    
}
function userOnline(){
    $.ajax({
        type : "POST",
        url : "<?php echo site_url('chat/online');?>",
        data : "sid=<?php echo $sid;?>",
        success : function(data){
            data = eval('('+data+')');
            online = '';
            $(data).each(function(x,y){
                online += '<dd><span></span>' + y.username + '</dd>';
            })
            $('.online dd').remove();
            $('.online dt').after(online);
        }
    })
}

function EnterPress(e){ //传入 event 
    var e = e || window.event; 
    if(e.keyCode == 13&&e.ctrlKey){ 
        submit();
    } 
} 

setInterval("newchat()", 3000);
setInterval("userOnline()", 5000);
window.onload = function(){
    $('.chatBox').animate({scrollTop: '1000px'});
}


</script>
<style type="text/css">
.chat{ width: <?php echo $width;?>;}
.chat .chatBox, .chat .online{ height: <?php echo ($height - 107).'px';?>; }
</style>

</head>
<body>
<div class="chat">
    <div class="chatInner shadow">
        <dl class="online shadow">
            <input type="hidden" name="sid" class="sid" value="" />
            <input type="<?php echo $diy;?>" class="username" placeholder="输入昵称" value="<?php echo $username;?>" time="<?php echo $time;?>" >
            <dt>在线列表</dt>
            <?php
            if(count($online))
            {
                foreach($online as $line)
                {
            ?>
            <dd><span></span><?php echo $line['username'];?></dd>
            <?php                
                }
            }
            ?>
        </dl>
        <div class="chatBox shadow" id="chatBox"> 
            <?php
            if(count($chatBox))
            {
                foreach($chatBox as $line)
                {
            ?>
            <strong><?php echo $line['username'].' '.date('H:i:s', substr($line['time'],0,-4));?></strong>
            <p><?php echo $line['words'];?></p>
            <?php                    
                }
            }
            ?>
        </div>
        <div class="sayBox">
            <input type="button" class="submit shadow" value="发送" title="Ctrl+Enter 发送" onclick="submit();" />
            <div class="wordsBox">
                <textarea class="words shadow" onkeypress="EnterPress()" onkeydown="EnterPress()"></textarea>
            </div>
        </div>
        <p class="power"><a href="http://achat.linauror.com/" target="_blank" title="基于PHP的在线聊天程序" >Power By AChat</a></p>
    </div>
</div>
</body>
</html>