<?php
$q = isset($_GET['q']) ? $_GET['q'] : '';

$con = mysqli_connect('localhost', 'root', '', 'moodle');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_connect_error());
}

if(is_numeric($q)){
    $query = "SELECT mdl_course.fullname AS course_name, mdl_quiz.name AS quiz_name, AVG(mdl_quiz_grades.grade) AS average_grade 
          FROM mdl_quiz_grades 
          INNER JOIN mdl_quiz ON mdl_quiz_grades.quiz = mdl_quiz.id 
          INNER JOIN mdl_course ON mdl_quiz.course = mdl_course.id 
          WHERE mdl_course.id = ".$q." 
          GROUP BY mdl_course.fullname, mdl_quiz.name;";
}
else if(is_string($q) && $q !== ''){
    $query = "SELECT mdl_course.fullname AS course_name, mdl_quiz.name AS quiz_name, AVG(mdl_quiz_grades.grade) AS average_grade 
    FROM mdl_quiz_grades 
    INNER JOIN mdl_quiz ON mdl_quiz_grades.quiz = mdl_quiz.id 
    INNER JOIN mdl_course ON mdl_quiz.course = mdl_course.id 
    WHERE mdl_course.fullname = '".$q."' 
    GROUP BY mdl_course.fullname, mdl_quiz.name;";
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
    <th>Calificacion Promedio</th>
    </tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['course_name'] . "</td>";
        echo "<td>" . $row['quiz_name'] . "</td>";
        echo "<td>" . $row['average_grade'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

mysqli_close($con);
?>
