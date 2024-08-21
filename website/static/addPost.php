<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $blogContent = $_POST['blogContent'];

    // DEALING WITH UPLOADING FILES
    uploadImage();
    if (isset($_POST['filename'])) {
        $filename = $_POST['filename'];
    } else {
        $filename = "";
    }
    // echo $filename."b";

    // sets the time
    // set default timezone
    date_default_timezone_set('Europe/London'); // https://www.php.net/manual/en/timezones.php
    $current_date = date('d-m-Y H:i:s');
    // echo $current_date;

    $time = $current_date;

    // check if $blogType === blog or portfolio
    if ($_POST['blogType'] === 'blog') {
        $sql = "INSERT INTO blogposts (title, content, file, timeOfSubmission)
VALUES ('$title', '$blogContent', '$filename', '$time')";
    } else {
        $sql = "INSERT INTO portfolioContent (title, content, file)
VALUES ('$title', '$blogContent', '$filename')";
    }

    if ($conn->query($sql) === TRUE) { // if the SQL query works
        //YOUR CODE GOES HERE
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function uploadImage()
{
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES['filename']["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES['filename']["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    // Check Errors
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES['filename']["size"] > 16_777_215) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES['filename']["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES['filename']["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/forms.css">

    <script src="js/addPost.js" defer></script>

</head>

<body>
    <?php
    include ("templates/header.php")

        ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend class="align-left">Add Blog:</legend>

            <!-- Blog Title -->
            <label for="blogTitle" id="titleLabel">Title:</label>
            <input type="text" name="title" id="blogTitle" placeholder="New title">
            <br>

            <input type="radio" name="blogType" id="blogBlog" value="blog" required checked>
            <label for="blogBlog">Blog</label>
            <br>
            <input type="radio" name="blogType" id="portfolioBlog" value="portflio" required>
            <label for="portfolioBlog">Portfolio</label>
            <br>

            <!-- Blog Text -->
            <label for="content" id="textLabel">Blog Text:</label>
            <br>
            <textarea name="blogContent" id="content" placeholder="This is the start of my blog" rows="10"
                cols="50"></textarea>
            <br>

            <label for="myFile">Upload Images: (max 16MiB)</label>
            <br>
            <input type="file" id="myFile" name='filename' required>
            <br>
            <br>

            <input type="submit" value="Post" class="button" id="submit" name="submit">
            <input type="reset" value="Clear" class="button" id="clear">
        </fieldset>
    </form>

</body>

</html>