<?php
$q = isset($_GET['q']) ? $_GET['q'] : '';

$con = mysqli_connect('localhost', 'root', '', 'moodle');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_connect_error());
}

if(is_numeric($q)){
    $query = "SELECT mdl_assign.name,mdl_assign.duedate,mdl_assign.grade,mdl_course.fullname FROM mdl_assign INNER join mdl_course WHERE  mdl_assign.course=mdl_course.id AND mdl_course.id=".$q.";";
}
else if(is_string($q) && $q !== ''){
    $query = "SELECT mdl_assign.name,mdl_assign.duedate,mdl_assign.grade,mdl_course.fullname FROM mdl_assign INNER join mdl_course WHERE  mdl_assign.course=mdl_course.id AND mdl_course.fullname='".$q."';";
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
    <th>Fecha de Entrega</th>
    <th>Calificacion</th>
    <th>Curso</th>
    </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['duedate'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($con);
?>
