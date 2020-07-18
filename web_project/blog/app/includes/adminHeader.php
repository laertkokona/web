<header>
    <a class="logo" href="<?php echo BASE_URL . '/index.php' ?>">
        <h1 class="logo-text"><span>Laert</span>Blog</h1>
    </a>
    <i class="fas fa-bars menu-toggle"></i>
    <ul class="nav">
    <li><a href=<?php echo BASE_URL . "/index.php"?>>Home</a></li>
    <li><a href=<?php echo BASE_URL . "/admin/admin.php"?>>Admin Page</a></li>
    <?php if($_SESSION['admin']): ?>
        
        <li>
            <a href="<?php echo BASE_URL . '/admin/admin.php' ?>"><i class="fas fa-cog"></i>  Settings</a>
        </li>
    <?php endif; ?>

        <?php if (isset($_SESSION['username'])): ?>
            <li>
                <a href="#">
                    <i class="fas fa-user"></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fas fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Log Out</a></li>
                </ul>
            </li>
        <?php endif; ?> 
    </ul>
</header>