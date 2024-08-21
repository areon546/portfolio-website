<?php
require_once ('functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitPreview']) && $_POST['submitPreview'] == "Save") {
  addPostToSessionStorage($_POST);


  if (!isset($_SESSION['UserID'])) {
    header('Location: /moduleProject/index.php');
    echo $_SESSION['UserID'];
  }

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Blog</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/forms.css">
  <link rel="stylesheet" href="css/mobile.css">

  <script src="js/addPost.js" defer></script>

</head>

<body>
  <?php include ("templates/header.php"); ?>
  <!-- <\?= $_SERVER['PHP_SELF'] ?> -->
  <form action="preview.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend class="align-left">Add Blog:</legend>
      <!-- Blog Title -->
      <?php

      $newTitle = "";
      $newContent = "";
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitPreview'])) {
        if ($_POST['submitPreview'] == "Edit") {
          $newTitle = $_POST['title'];
          $newContent = $_POST['content'];
        }
      }


      print ('<label for="blogTitle" id="titleLabel">Title:</label>
      <input type="text" name="title" id="blogTitle" placeholder="New title" value=' . "$newTitle" . '>
      <br>

      <input type="radio" name="postType" id="blogBlog" value="blog" required checked>
      <label for="blogBlog">Blog</label>
      <br>
      <input type="radio" name="postType" id="portfolioBlog" value="portfolio" required>
      <label for="portfolioBlog">Portfolio</label>
      <br>

      <!-- Blog Text -->
      <label for="blogContent" id="textLabel">Blog Text:</label>
      <br>
      <textarea name="content" id="blogContent" placeholder="This is the start of my blog" rows="10"
        cols="50">' . "$newContent" . '</textarea>
      <br>

      <label for="myFile">Upload Images: (max 16MiB)</label>
      <br>
      <input type="file" id="myFile" name="filename" value="missing">
      <br>
      <br>');

      ?>

      <input type="submit" value="Post" class="button" id="submit" name="submit">
      <button type="submit" value="Preview" class="button" id="previewButton" name="preview">Preview</button>
      <input type="reset" value="Clear" class="button" id="clear">
    </fieldset>
  </form>


</body>

</html>