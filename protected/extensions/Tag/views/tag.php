<div class='tags-container'>
<?php if(!empty($tags)):?>
    <?php foreach($tags as $tag):?>
        <span class='badge'>
            <?php echo $tag->word;?>
        </span>&nbsp;
    <?php endforeach;?>
<?php endif;?>
</div>