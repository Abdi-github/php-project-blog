<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <a class="navbar-brand" href="<?php echo 'http://localhost/php_project' ?>">Social Post Share</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/php_project">Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/php_project/about">about</a>
            </li>
        </ul>
        <!-- The register and login pages is not to be done at this stage
     The code below will is only for layout purpose
-->
        <ul class="navbar-nav mr-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/php_project/logout">Logout </a>
                </li>

            <?php else: ?>

                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/php_project/register">Register </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/php_project/login">Login</a>
                </li>
            <?php endif;?>
        </ul>
    </div>
</nav>