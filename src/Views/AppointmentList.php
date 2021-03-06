<?php require_once("Components/Header.php");?>

<body>
<main class="container">
  <a href="?action=create">
  <button type="button" id="btn-add-cita" class="btn btn-light">New Appointment</button> 
  </a>

    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Student</th>
          <th scope="col">Subject</th>
          <th scope="col">Date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
<?php
    foreach ($data["appointmentList"] as $appointment) 
    { 
      echo "
        <tr>
          <th scope='row'>{$appointment->id}</th> 
          <td>{$appointment->student}</td>
          <td>{$appointment->subject}</td>
          <td>{$appointment->date}</td>
          <td>
          <a href='?action=delete&id={$appointment->id}'>
          <button class= 'btn btn-danger'>Delete</button></a>
          <a href='?action=edit&id={$appointment->id}'>
          <button class= 'btn btn-secondary'>Edit</button></a>
          </td>
        </tr>
        ";
    } 
?>
      </tbody>
    </table>
  </main>
</body>


</html>