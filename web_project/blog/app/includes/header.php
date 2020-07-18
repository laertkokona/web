<header>
        <a href=<?php echo BASE_URL . "/index.php"?> class="logo">
            <h1 class="logo-text"><span>Laert</span>Blog</h1>
        </a>
        <i class="fas fa-bars menu-toggle"></i>
        <ul class="nav">
            <li><a href=<?php echo BASE_URL . "/index.php"?>>Home</a></li>
            <li><a href=<?php echo BASE_URL . "/aboutme.php"?>>About Me</a></li>
            <li><a href="#">Services</a></li>

            <?php if(isset($_SESSION['id'])): ?>

                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>    
                        <?php echo $_SESSION['username']; ?>
                        <i class="fas fa-chevron-down" style="font-size: .8em;"></i>
                    </a>
                    <ul>
                        <?php if($_SESSION['admin']): ?>
                            <li><a href="<?php echo BASE_URL . '/admin/admin.php' ?>">Admin Page</a></li>
                        <?php endif; ?>
                        

                        <li><a href="<?php echo BASE_URL . '/logout.php' ?>" class="logout">Log Out</a></li>
                    </ul>
                </li>

            <?php else: ?>

                <li><a href="<?php echo BASE_URL . '/signup.php' ?>">Sign Up</a></li>
                <li><a href="<?php echo BASE_URL . '/login.php' ?>">Log In</a></li>

            <?php endif; ?>

            
            
        </ul>
    </header>