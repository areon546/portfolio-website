<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/homepageMobile.css">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>

<body>

    <?php include ('templates/header.php'); ?>


    <nav class="links">
        <ul>
            <li><a href="#aboutMe">About Me</a></li>
            <li><a href="#education">Education</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Project List</a></li>
        </ul>
    </nav>


    <article id="aboutMe">
        <p>
            I am a Computer Science student studying in Queen Mary Univeristy of London, learning about computers and
            doing archery.
            It's been exciting so far, learning about Automata, HTML and CSS, Object Oriented
            Programming, as well as other stuff.
            <br>I enjoy Archery, Reading, and Creative Writing.
        </p>

        <figure>
            <img src="images/picture.jpg" alt="image of me" title="An image of me">
        </figure>
    </article>

    <section id="capabilities">

        <section id="education" class="item">
            <h1>Education and Qualifications:</h1>

            <ul class="eduList">
                <li><strong><a href="experiences.html#education">Education</a></strong></li>
                <li>2023-Present: MSci Computer Science Queen Mary University of London</li>
                <li><strong><a href="experiences.html#qualifications">Qualifications</a></strong></li>
                <li><strong><a href="experiences.html#experiences">Experiences</a></strong></li>
                <li>Oct 2022-Present: ITBuddy </li>
            </ul>
        </section>

        <section id="projects" class="item">
            <h1>Project List:</h1>

            <ul class="projectGrid">
                <!-- <li><a href="projects.html">Project Template</a></li> -->
                <li><a href="projects.html#forestGame">Forest Game</a></li>
                <li><a href="projects.html#DVD">Bouncing DVD</a></li>
            </ul>
        </section>

        <section id="skills" class="item">
            <h1>Skills</h1>

            <ul>
                <li>
                    <aside>Java</aside>
                </li>
                <li>
                    <aside>HTML</aside>
                </li>
                <li>
                    <aside>CSS</aside>
                </li>
                <li>
                    <aside>Python</aside>
                </li>
                <li>
                    <aside>SASS</aside>
                </li>
            </ul>
        </section>



    </section>

    <section id="contactMe">
        <h2>Contact Me:</h2>
        <ul>
            <li><strong>Name:</strong> Artur Baran</li>
            <li><strong>Email:</strong> artur.baran.2038@gmail.com
            </li>
        </ul>
    </section>

    <?php include ("templates/footer.html"); ?>
</body>

</html>