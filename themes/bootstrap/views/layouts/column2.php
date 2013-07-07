<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span8">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
            <?php $this->widget('ext.Tag.TagWidget',array('limit'=>25));?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>