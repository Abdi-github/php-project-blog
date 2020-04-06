<?php

require 'partials/header.php';

?>
<a href="/php_project/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<div class="row">
    <div class="col-md-6">
        <h1>Post</h1>
    </div>
    <div class="col-md-6">
        <a href="/php_project/addPost" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Post
        </a>
    </div>
</div>



<?php
echo $post->asHTML_show_post();

?>

<?php
require 'partials/footer.php'

?>