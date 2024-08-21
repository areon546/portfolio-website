
<header class="header"> 
    <nav>
        <a href="index.php" id="indexLink" class="form">Artur Baran</a>

        <ul>

            <?php 
            session_start();
            
            if (isset($_SESSION['UserID'])) {
                // if the user is logged in
                // echo $_SESSION['UserID'];

                print("<li><a href=\"logout.php\">Logout</a></li>");
            } else {
                // if the user isnt logged in
                print("<li><a href=\"login.php\">Login</a></li>");
            }
            
            ?>

            <li><a href="projects.php">Projects</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="experiences.php">Experiences</a></li>
        </ul>
    </nav>
</header>
