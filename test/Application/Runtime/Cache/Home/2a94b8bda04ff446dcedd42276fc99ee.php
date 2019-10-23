<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<link rel="stylesheet" href="/Mythinkphp/test4/Public/css/index.css">
</head>

<body>
  <div class="header">
    <h1>在线考试系统</h1>
   
  </div>  
  <div class="content">
    <div class="con-left">
      <p>考试的总题数<?php echo ($total); ?></p>
      <?php $__FOR_START_7323__=0;$__FOR_END_7323__=$total;for($i=$__FOR_START_7323__;$i < $__FOR_END_7323__;$i+=1){ ?><a href="<?php echo U('Home/Index/index/no/'.$i);?>"><?php echo ($i+1); ?></a><?php } ?>
    </div>
    <div class="con-cen">
      <form action="" method="POST" onsubmit="zzk()" id="form">
        <p> 当前第<?php echo ($no+1); ?>题 </p>
        <input type="hidden" value="<?php echo ($no); ?>" name="num">
        <p><span><?php echo ($current['id']); ?>.</span> <?php echo ($current['timu']); ?></p>
        <?php if($tixing > 1 ): ?><div class="cen-box">
                <ul>
                  <li><input type='checkbox' name=zzk[]  value="A"><?php echo ($current['a']); ?>  </li>
                  <li><input type='checkbox' name=zzk[]  value="B"><?php echo ($current['b']); ?>  </li>
                  <li><input type='checkbox' name=zzk[]  value="C"><?php echo ($current['c']); ?>  </li>
                  <li><input type='checkbox' name=zzk[]  value="D"><?php echo ($current['d']); ?>  </li>
                  <li><input type='checkbox' name=zzk[]  value="E"><?php echo ($current['e']); ?>  </li>
                </ul>
            </div>
        <?php else: ?>
          <div class="cen-box">
            <ul>
                <li><input type='radio' name=zzk[]  value="A"><?php echo ($current['a']); ?>  </li>
                <li><input type='radio' name=zzk[]  value="B"><?php echo ($current['b']); ?>  </li>
                <li><input type='radio' name=zzk[]  value="C"><?php echo ($current['c']); ?>  </li>
                <li><input type='radio' name=zzk[]  value="D"><?php echo ($current['d']); ?>  </li>
              </ul>
          </div><?php endif; ?>
      <div class="cen-footer">
        <input type="submit" name="Last" value='上一题' onclick="t=1">
        <input type="submit" name='Next' value="下一题" onclick="t=2">
        <input type="submit" name='give' value="交卷"  onclick="return confirm('是否确认完毕，确认完毕请交卷')">
      </div>
    </div>
    <div class="con-right">
      <img src="/Mythinkphp/test4/Public/userimg/<?php echo ($stu_info['zhaopian']); ?>"alt="">
      <p>考生号：<?php echo ($stu_info['kaohao']); ?> <input type="hidden" value="<?php echo ($stu_info['kaohao']); ?>" name="kaohao"></p>
      <p>考生姓名：<?php echo ($stu_info['xingming']); ?></p>
      <p>您的考试成绩：<?php echo ($fenshu); ?></p>
    </div>
    </form>
  </div> 
  <?php if($on == 1 ): ?><div class="chengji">
          <p>考试的成绩</p>
          <span class='tuchu'><a href="<?php echo U('Home/Index/tuichu/');?>">退出</a></span>
          <ul class="ul">
              <?php $__FOR_START_6200__=0;$__FOR_END_6200__=$len;for($i=$__FOR_START_6200__;$i < $__FOR_END_6200__;$i+=1){ ?><li>
                  <p><?php echo ($i+1); ?>：</p>
                  <p>标准答案：<?php echo ($biaoda[$i]); ?></p>
                  <p>您的答案： <?php echo ($zida[$i]); ?></p>
                </li><?php } ?>
          </ul>
          
      </div>
      <?php else: endif; ?>
 
<br/>

</body>
<script type="text/javascript">
  var url=parseInt("<?php echo ($no); ?>");
  var strD="<?php echo ($dan_cu); ?>";
  var strArr=strD.split('');
  var Btn=document.getElementsByClassName('cen-box')[0].getElementsByTagName('input');
  var arrBtn=[];
  for(var i=0;i<Btn.length;i++){
    arrBtn.push(Btn[i].value);
  }
  for(var i=0;i<strArr.length;i++){
    for(var j=0;j<arrBtn.length;j++){
      if(strArr[i]==arrBtn[j]){
        Btn[j].checked=1;
      }
    }
  }
var sub=document.getElementsByClassName('cen-footer')[0].getElementsByTagName('input');
if(url==0){
  sub[0].style.display="none";
}else{
  sub[0].style.display="block";
}
if(url==parseInt(<?php echo ($total); ?>)-1){
  sub[1].value="保存";
}else{
  sub[1].style.display="block";
}
function zzk(){
 
  if(t==1){
     document.getElementById('form').action="<?php echo U('Home/Index/index/no/"+(url-1)+"');?>";
  }
  if(t==2){
    document.getElementById('form').action="<?php echo U('Home/Index/index/no/"+(url+1)+"');?>";
  }
 

}
</script>
</html>