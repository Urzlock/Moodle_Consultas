<?php
$q = isset($_GET['q']) ? $_GET['q'] : '';

$con = mysqli_connect('localhost', 'root', '', 'moodle');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_connect_error());
}

if(is_numeric($q)){
    $query = "SELECT mdl_assign_grades.grade, name, mdl_user.firstname,mdl_user.lastname FROM mdl_assign_grades INNER JOIN mdl_assign INNER JOIN mdl_user ON mdl_assign_grades.assignment=mdl_assign.id AND mdl_assign_grades.userid = mdl_user.id WHERE mdl_assign.id=".$q.";";
}
else if(is_string($q) && $q !== ''){
    $query = "SELECT mdl_assign_grades.grade, name, mdl_user.firstname,mdl_user.lastname FROM mdl_assign_grades INNER JOIN mdl_assign INNER JOIN mdl_user ON mdl_assign_grades.assignment=mdl_assign.id AND mdl_assign_grades.userid = mdl_user.id WHERE mdl_assign.name='".$q."';";
}
else{
    printf("Ingrese un nombre o ID");
    exit();
}

$result = mysqli_query($con, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

if (mysqli_num_rows($result) > 0) {
    echo "<table>
    <tr>
    <th>Actividad</th>
    <th>Calificacion</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($con);
?>
