<div id="user-block">
    <?php echo CHtml::image($user['profile_image_url']);?>
    <p>
    Имя :<?php echo $user['name'];?>
    </p>
    <p>
    Ник:<?php echo $user['screen_name'];?>
    </p>
    <p>
    ID:<?php echo $user['id'];?>
    </p>
    <p>
    Описание:<?php echo $user['description'];?>
    </p>
</div>