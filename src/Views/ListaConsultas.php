<?php require_once("Components/Header.php");?>

<body>
<main class="container">
  <a href="?action=create">
  <button type="button" id="btn-add-cita" class="btn btn-light">Crear Consulta</button> 
  </a>

    <table class="table table-hover table-dark">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nombre</th>
          <th scope="col">Tema</th>
          <th scope="col">Hora</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
<?php
    foreach ($data["consultas"] as $consulta) 
    { 
      echo "
        <tr>
          <th scope='row'>{$consulta->id}</th> 
          <td>{$consulta->name}</td>
          <td>{$consulta->tema}</td>
          <td>{$consulta->fecha}</td>
          <td>
          <a href='?action=delete&id={$consulta->id}'>
          <button class= 'btn btn-danger'>Delete</button></a>
          <a href='?action=edit&id={$consulta->id}'>
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