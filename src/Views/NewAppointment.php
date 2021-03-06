<?php require_once("Components/Header.php"); ?>

<body>
    <header class="container d-flex justify-content-sm-between">
        <h1>New Appointment</h1>
        <a href="index.php" class="link-primary" aria="go back to Homepage">
            Back
        </a>
    </header>
    <main class="container-sm" id="main">
        <form action='?action=save' method="post">
            <div class="form-group">
                <label for="name">Student</label>
                <input name="student" type="text" class="form-control" placeholder="Insert Student Name" aria-label="Student" aria-describedby="basic-addon1">
            </div>
            <div class="form-group">
                <label name="tema">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="Appointment subject" aria-label="Appointment Subject" aria-describedby="basic-addon1">

            </div>
            <?php
            echo "<p id=date> Date of Schedule: " . date("Y/m/d") . "  " . date("h:i") . "</p>";

            ?>
            <div class="d-flex justify-content-sm-around">
                <button type="reset" value="reset" class="btn btn-warning">Reset</button>
                <button type="submit" value="savebd" class="btn btn-primary">Send</button>
            </div>
        </form>
    </main>
</body>

</html>