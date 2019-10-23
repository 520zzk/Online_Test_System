<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul><?php echo ($fenshu); ?>
     <?php $__FOR_START_22483__=0;$__FOR_END_22483__=$len;for($i=$__FOR_START_22483__;$i < $__FOR_END_22483__;$i+=1){ ?><li>
            <p><?php echo ($i); ?></p>
            <p>正确答案：<?php echo ($biaoda[$i]); ?></p>
            <p>您的答案：<?php echo ($zida[$i]); ?></p>
        </li><?php } ?>
    </ul>
   
</body>
<script type="text/javascript">
    var biaoda="<?php echo ($biaoda); ?>";
    var zida="<?php echo ($zida); ?>";
    console.log(biaoda.length,zida.length);
</script>
</html>