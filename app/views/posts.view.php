<?php

require 'partials/header.php';

?>

<div class="row">
    <div class="col-md-6">
    <?php flash('add_message');?>
    <?php flash('update_message');?>
    <?php flash('delete_message');?>

        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="/php_project/addPost" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Post
        </a>
    </div>
</div>
<?php foreach ($posts as $p) {

    echo $p->asHTML();
}?>




<?php
require 'partials/footer.php'

?>




