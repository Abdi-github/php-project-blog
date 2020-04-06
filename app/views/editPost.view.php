<?php

require 'partials/header.php'
?>

<a href="/php_project/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>

<div class="card card-body bg-light mt-5">

    <h2>Edit Post</h2>
    <p>Please edit & update your post with this form.</p>

    <form action="updatePost" method="post">
    <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                </div>
                <div class="form-group">
                    <label for="content">Content: <sup>*</sup></label>
                    <textarea name="content" class="form-control form-control-lg <?php echo (!empty($data['content_err'])) ? 'is-invalid' : ''; ?>" ><?php echo $data['content']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['content_err']; ?></span>
                </div>

        <input type="hidden" id="postId" name="postId" value='<?=htmlentities($data['id'])?>'>
        <input type="submit" class="btn btn-success" value="Submit" name="Submit">
    </form>
</div>




<?php
require 'partials/footer.php'

?>


