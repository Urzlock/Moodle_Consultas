<?php
$q = isset($_GET['q']) ? $_GET['q'] : '';

$con = mysqli_connect('localhost', 'root', '', 'moodle');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_connect_error());
}

if(is_numeric($q)){
    $query = "SELECT mdl_course.fullname, mdl_quiz.name,mdl_quiz_grades.grade,mdl_user.firstname,mdl_user.lastname from mdl_quiz_grades INNER JOIN mdl_quiz INNER JOIN mdl_course INNER JOIN mdl_user ON mdl_quiz_grades.quiz=mdl_quiz.id AND mdl_quiz.course=mdl_course.id AND mdl_quiz_grades.userid = mdl_user.id WHERE mdl_course.id=".$q.";";
}
else if(is_string($q) && $q !== ''){
    $query = "SELECT mdl_course.fullname, mdl_quiz.name,mdl_quiz_grades.grade,mdl_user.firstname,mdl_user.lastname from mdl_quiz_grades INNER JOIN mdl_quiz INNER JOIN mdl_course INNER JOIN mdl_user ON mdl_quiz_grades.quiz=mdl_quiz.id AND mdl_quiz.course=mdl_course.id AND mdl_quiz_grades.userid = mdl_user.id WHERE mdl_course.fullname='".$q."';";
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
    <th>Examen</th>
    <th>Nombre Alumno</th>
    <th>Apellidos Alumno</th>
    <th>Calificacion</th>
    </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['fullname'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($con);
?>
