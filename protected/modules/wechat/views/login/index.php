<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="<?php echo Yii::app()->params['host']; ?>/ace/static/js/jquery-2.0.3.min.js"></script>
    </head>
    <body>

        <input type="number" name="tel" placeholder="请输入手机号码">
        <input type="button" value="绑定手机" class="bangding">
    </body>

</html>
<script>
    $(function () {
        $('.bangding').bind('click', function () {
            var tel = $('input[name="tel"]').val();
            $.post("<?php $this->createUrl('index') ?>", {tel: tel}, function (data) {
                alert(data.msg);
                if (data.sta == 1) {
                    window.location=data.url;
                }
            }, 'json');
        });
    });
</script>