<?php

$title = "About " . $appName;


    require('partials/header.php')
?>


<div class="jubmotron jombotron-flud">
<div class="container">
    <h1 class="display-3"><?php echo ($title); ?></h1>
    <p class="lead"><?php echo $description; ?></p>
</div>
</div>

<?php require('partials/footer.php') ?>
