<?php
$q = isset($_GET['q']) ? $_GET['q'] : '';

$con = mysqli_connect('localhost', 'root', '', 'moodle');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_connect_error());
}

if(is_numeric($q)){
    $query = "SELECT fullname as Curso,firstname, lastname FROM `mdl_enrol` INNER JOIN mdl_user_enrolments ON mdl_enrol.id = mdl_user_enrolments.enrolid INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id INNER JOIN mdl_user ON mdl_user_enrolments.userid = mdl_course.id WHERE mdl_course.id =".$q."; ";
}
else if(is_string($q) && $q !== ''){
    $query = "SELECT fullname as Curso,firstname, lastname FROM `mdl_enrol` INNER JOIN mdl_user_enrolments ON mdl_enrol.id = mdl_user_enrolments.enrolid INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id INNER JOIN mdl_user ON mdl_user_enrolments.userid = mdl_course.id WHERE mdl_course.fullname ='".$q."'; ";
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
    <th>Curso</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['Curso'] . "</td>";
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
