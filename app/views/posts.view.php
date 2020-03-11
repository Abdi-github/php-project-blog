<?php

require('partials/header.php');

?>

<div class="row">
    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="/php_project/addPost" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i> Add Post
        </a>
    </div>
</div>

<?php foreach($posts as $p) : ?>
    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $p->title; ?></h4>
        <div class="bg-light p-2 mb-3">
            Written by <?php echo $p->user_id; ?> on <?php echo $p->created_at; ?>
        </div>
        <p class="card-text"><?php echo $p->content; ?></p>
        <a href="/php_project/showPost/<?php echo $p->id; ?>" class="btn btn-dark">More</a>

    </div>
<?php endforeach; ?>



<?php
require('partials/footer.php')

?>




