<?php
$q = isset($_GET['q']) ? $_GET['q'] : '';

$con = mysqli_connect('localhost', 'root', '', 'moodle');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_connect_error());
}

if(is_numeric($q)){
    $query = "SELECT fullname as Curso,count(*) as Cantidad FROM mdl_enrol INNER JOIN mdl_user_enrolments ON mdl_enrol.id = mdl_user_enrolments.enrolid INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id WHERE mdl_course.id =".$q." GROUP BY mdl_course.id;";
}
else if(is_string($q) && $q !== ''){
    $query = "SELECT fullname as Curso,count(*) as Cantidad FROM mdl_enrol INNER JOIN mdl_user_enrolments ON mdl_enrol.id = mdl_user_enrolments.enrolid INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id WHERE mdl_course.shortname ='".$q."' GROUP BY mdl_course.id;";
}
else{
    $query = "SELECT fullname as Curso,count(*) as Cantidad FROM mdl_enrol INNER JOIN mdl_user_enrolments ON mdl_enrol.id = mdl_user_enrolments.enrolid INNER JOIN mdl_course ON mdl_enrol.courseid = mdl_course.id GROUP BY mdl_course.id;";
}

$result = mysqli_query($con, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

if (mysqli_num_rows($result) > 0) {
    echo "<table>
    <tr>
    <th>Cursos</th>
    <th>Cantidad</th>
    </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['Curso'] . "</td>";
        echo "<td>" . $row['Cantidad'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($con);
?>
