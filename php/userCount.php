<?php
$q = intval($_GET['q']);
$con = mysqli_connect('localhost', 'root', '');
if (!$con) {
    die("No se pudo establecer una conexión: " . mysqli_error($con));
}
mysqli_select_db($con, 'moodle');
$query = "SELECT COUNT(*) as users FROM mdl_user;";
$result = mysqli_query($con, $query); // Aquí se cambió $sql por $query
echo "<table>
<tr>
<th>Usuarios</th>
</tr>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['users'] . "</td>"; // Este echo estaba fuera del bucle antes de $row se asignara
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
