<?php require_once("Components/Header.php"); ?>

<body>
    <header class="container d-flex justify-content-sm-between">
        <h1>Edit Appointment</h1>
        <a href="index.php" class="link-primary" aria="go back to Homepage">
            Back
        </a>
    </header>
    <main class="container" id="main">
        <form action='?action=update&id=<?php echo $data["appointment"]->id ?>' method="post">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input required value='<?php echo $data["appointment"]->student ?>' name="student" type="text" class="form-control" aria-label="Student" aria-describedby="basic-addon1">
            </div>
            <div class="form-group">
                <label name="tema">Subject</label>
                <input required value='<?php echo $data["appointment"]->subject ?>' type="text" name="subject" class="form-control" aria-label="Appointment subject" aria-describedby="basic-addon1">

            </div>
            <?php
            echo "<p id=date> Date of schedule: " . date("Y/m/d") . "  " . date("h:i") . "</p>";

            ?>
            <div class="d-flex justify-content-sm-around">
                <button type="reset" value="reset" class="btn btn-warning">Reset</button>
                <button type="submit" value="savebd" class="btn btn-primary">Send</button>
            </div>
        </form>
    </main>
</body>

</html>