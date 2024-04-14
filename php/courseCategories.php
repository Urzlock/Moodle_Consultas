
<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_error($con));
}
mysqli_select_db($con, 'moodle');
$query = "SELECT name  FROM mdl_course_categories;";
$queryCantidad = "SELECT COUNT(*) as cantidad FROM mdl_course_categories;";
$resultCantidad = mysqli_query($con,$queryCantidad);
$result = mysqli_query($con, $query); 
echo "<table>
    <tr>
        <th>Cantidad De Cursos</th>
    </tr>
    <tr>
";
while ($rowCant = mysqli_fetch_array($resultCantidad)) {
    echo "<td>".$rowCant['cantidad']."</td>";
}
echo "</tr>
</table>";
echo "<table>
<tr>
<th>Nombres</th>
</tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>"; // Este echo estaba fuera del bucle antes de $row se asignara
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
