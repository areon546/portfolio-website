<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Projects</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobile.css">
</head>

<body>


    <?php include ('templates/header.php'); ?>

    <main>

        <?php

        $adminPostsArray = $_SESSION['adminMadePosts']['1'];
        foreach ($adminPostsArray as $year => $monthsInYear) {

            foreach ($monthsInYear as $month => $daysInMonth) {

                foreach ($daysInMonth as $day => $timeArray) {

                    foreach ($timeArray as $column => $post) {
                        // echo $column . "=>" . $post . "<br>";
                        // echo $column."<br>";
        
                        $id = $post['ID'];
                        $filename = $post['filename'];
                        $title = $post['title'];
                        $content = $post['content'];
                        $time = date("Y/m/d", strtotime($post['timeOfSubmission']));

                        print ("<article id=$id>");
                        print ("<strong>DATE: $time</strong>"); // print time
        
                        // show image (if there)
                        if ($filename !== "missing") {
                            print ("
                <figure>
                    <img src=\"images/$filename\" alt=\"$filename\">
                </figure>");
                        }

                        // print 
                        print ("<p class=\"title\">$title</p>");
                        print ("<p class=\"description\">$content</p>");
                        print ("</article>");
                    }
                }
            }

        }

        ?>

        <!-- <article id="DVD">
            <figure>
                <img src="images/" alt="Bouncing DVD Logo">
                <figcaption>Bouncing DVD Logo</figcaption>
            </figure>

            <p class="title">Bouncing DVD Logo</p>
            <p class="description">
                A simple pygame project where there is a red box that moves around a screen and bounces. You can see
                where it's moved based on the trail it leaves behind. Eventually you get geometric patterns.

                It's based off of the DVD logo that bounces, but the DVD logo wasn't implemented when written.

                It will run until the window is closed, and it will keep track of how many times it touches a corner.
            </p>

            <p>Link: <a href="https://github.com/areon546/dvdMovement">Here</a></p>
        </article> -->

        <!-- <article>
            <figure>
                <img src="images/" alt="First project">
                <figcaption>First project</figcaption>
            </figure>

            <p class="title">Title</p>
            <p class="description">Description of Project</p>
            <p>Link: <a href=""></a></p>
        </article> -->

    </main>

    <?php include ("templates/footer.html"); ?>
</body>

</html>