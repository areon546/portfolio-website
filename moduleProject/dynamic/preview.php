<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/mobile.css">
</head>


<body>

    <?php include ('templates/header.php');

if (!isset($_SESSION['UserID']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /moduleProject/index.php');
        echo $_SESSION['UserID'];
    } ?>

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
        $prev = "addPost.php";
        $months = ["Jan", "Feb", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        require_once ('functions.php');


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['preview'])) {

            // preview post
            foreach ($_POST as $key => $value) {
                echo $key . "=>" . $value . "<br>";
            }

            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            } else {
                $id = "missing";
            }

            if (isset($_POST['filename'])) {
                $filename = $_POST['filename'];
            } else {
                $filename = "missing";
            }

            $title = $_POST['title'];
            $content = $_POST['content'];
            $postType = $_POST['postType'];

            if (isset($_POST['timeOfSubmission'])) {
                $time = date("Y/m/d", strtotime($_POST['timeOfSubmission']));
            } else {
                $time = getCurrentTime();
            }

            $monthP = $months[date('m') - 1];

            print ("<p>$monthP:</p>");
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


            $content = $_POST['content'];
            // buttons to save and go back
            print ("<form action=\"$prev\" method=\"post\">
            <input type=\"hidden\" name=\"title\" value=\"$title\">
            <input type=\"hidden\" name=\"content\" value=\"$content\">
            <input type=\"hidden\" name=\"filename\" value=\"missing\">
            <input type=\"hidden\" name=\"postType\" value=\"$postType\">
            <input type=\"submit\" value=\"Edit\" class=\"button\" id=\"submit\" name=\"submitPreview\">
            <input type=\"submit\" value=\"Save\" class=\"button\" id=\"submit\" name=\"submitPreview\">
            </form>");

            print ("</article>");

            // other posts
        
            $adminPostsArray = $_SESSION['adminMadePosts']['0'];
            foreach ($adminPostsArray as $year => $monthsInYear) { // for each year
                foreach ($monthsInYear as $month => $daysInMonth) { // for each month
                    $daysInMonth = $_SESSION['adminMadePosts']['0'][$year][$month];
                    $monthAsWord = $months[$month - 1];

                    if ($month !== $monthP) {
                        print ("<p>$monthAsWord:</p>");
                    }

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
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            // add post to sql database
        

            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "blogpostdatabase";
            // Creates connection
            $conn = new mysqli($servername, $username, $password, $dbname);


            // Checks connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $title = $_POST['title'];
                $postType = $_POST['postType'];
                $blogContent = $_POST['content'];

                // DEALING WITH UPLOADING FILES
                $filename = getUploadedFileName('filename');

                // check if $blogType === blog or portfolio
                $sql = "INSERT INTO adminmadeposts (title, postType, content, filename, timeOfSubmission)
            VALUES (\"$title\", '$postType', \"$blogContent\", \"$filename\", NOW() )";

                if ($conn->query($sql) === TRUE) { // if the SQL query works
                    // add to session based storage
                    addPostToSessionStorage($_POST);

                    foreach ($_POST as $key => $value) {
                        echo $key . $value . "<br>";
                    }

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();

                header('Location: /moduleProject/blog.php');
                die();
            }


            session_commit();

        }
        ?>

    </main>

    <footer>
        <p>&copy; 2024 Artur Baran</p>
    </footer>

</body>

</html>