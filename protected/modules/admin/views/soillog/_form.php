<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'id-form',
    'action' => $this->createUrl('save'),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    ),
        ));
?>
<?php if ($model->id): ?>
    <input type="hidden" name="id" value="<?php echo $model->id ?>" />
<?php endif; ?>
<div class="form-group">
    <?php echo $form->labelEx($model, 'soil_id', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->dropDownList($model, 'soil_id', $soil, array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'content', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'content', array('class' => 'col-xs-10 col-sm-5', 'placeholder' => '')) ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'pic_list', array('class' => 'col-sm-3 control-label no-padding-right')) ?>
    <div class="col-sm-9">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker" data-name="pic_list" data-file-num="0">选择图片</div>
        </div>
        <div class="upload-wrap">
            <?php if ($model->pic_list): ?>
                <?php foreach (explode(",", $model->pic_list) as $k => $v): ?>
                    <div id="WU_FILE2_<?php echo $k ?>" class="file-item thumbnail upload-state-done"><div class="upload-img-wrap">
                            <input type="hidden" name="pic_list[]" class="input-image" value="<?php echo $v; ?>">
                            <img src="<?php echo Utils::getImageUrl($v, true); ?>">
                            <span class="upload-delete">×</span></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'shot_time', array('class' => 'col-sm-3 control-label no-padding-right')) ?>

    <div class="col-sm-9">
        <?php echo $form->textField($model, 'shot_time', array('class' => 'col-xs-10 col-sm-5 date-picker', 'id' => 'shot_time')) ?>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="button" id="submit">
            <i class="icon-ok bigger-110"></i>
            提交
        </button>

        &nbsp; &nbsp; &nbsp;
        <button class="btn" type="reset">
            <i class="icon-undo bigger-110"></i>
            重置
        </button>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(function(){
        var shot_time = {
            elem: '#shot_time',
            format: 'YYYY-MM-DD hh:mm:ss',
            min: '1970-01-01', //
            max: '2099-06-16', //
            istime: true,
            istoday: false,
            choose: function (datas) {
            }
        };
        laydate(shot_time);
        laydate.skin('huanglv');
    });
</script>
