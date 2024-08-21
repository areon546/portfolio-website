<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/mobile.css">


    <script src="js/onHover.js" defer></script>
</head>


<body>

    <?php include ('templates/header.php');
    require_once ('functions.php');


    if (isset($_SESSION['UserID'])) {
        // if the user is logged in
        // echo $_SESSION['UserID'];
        print ('<nav class="links"><ul><li><a href="addPost.php">Add Post</a></li></ul></nav>');

    }

    ?>

    <main>


        <!-- 
            All the stuff I've done, CS wise
            - CS club at post 16
            - (yet to be) Machine Learning Hackathon at school
            - electronics club thing at secondary (lasted for 2 weeks)
            - DVD movement thing, pretty barebones tbh
            - Univeristy projects
                - forest game
                - oop coursework (not started)
                - portfolio website & blog (in progress)
            - IT buddy
         -->


        <?php
        $prev = $_SERVER['PHP_SELF'];
        $months = ["Jan", "Feb", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];



        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || (isset($_POST['back']) && $_POST['back'] == "back")) {

            // IF NOT POST: ASK FOR MONTH
            $adminPostsArray = $_SESSION['adminMadePosts']['0'];
            foreach ($adminPostsArray as $year => $monthsInYear) {

                print ("<p>Select a month:</p>");
                print ("<div class=\"dropdown\">
                <button class=\"dropbtn\">" . $year . "</button><div class=\"dropdown-content\">");

                foreach ($monthsInYear as $month => $daysInMonth) {
                    $monthAsWord = $months[$month - 1];


                    // add to a drop down menu, then save this as a value and use 
                    // echo $month;
        
                    // create a drop down menu
        
                    print ('<form action='.$prev.' method=\"POST\"><button type=\"submit\" name=$year value="$month">'.$monthAsWord.'</button></form>');
                }

                print ("</div>
                </div> ");
            }

        } else {


            print ("<form action=$prev method=\"POST\"><button type=\"submit\" name=\"back\" value=\"back\">Back</button></form>");

            foreach ($_POST as $year => $month) {
                $daysInMonth = $_SESSION['adminMadePosts']['0'][$year][$month];
                $monthAsWord = $months[$month - 1];

                print ("<p>$monthAsWord:</p>");

                foreach ($daysInMonth as $day => $timeArray) {

                    foreach ($timeArray as $column => $post) {
                        // echo $column . "=>" . $post . "<br>";
                        // echo $column."<br>";
        
                        // debugArray($post);
        

                        if (isset($post['id'])) {
                            $id = $post['id'];
                        } else {
                            $id = "missing";
                        }

                        if (isset($post['filename'])) {
                            $filename = $post['filename'];
                        } else {
                            $filename = "missing";
                        }

                        $title = $post['title'];
                        $content = $post['content'];

                        if (isset($post['timeOfSubmission'])) {
                            $time = date("Y/m/d", strtotime($post['timeOfSubmission']));
                        } else {
                            $time = getCurrentTime();
                        }

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

    </main>

    <?php include ("templates/footer.html"); ?>

</body>

</html>