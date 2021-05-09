<?php

require_once('connection.php');

// Show all employees

$stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name FROM Employee ORDER BY First_Name, Last_Name");
$stmt->execute();

echo "<table style='border: solid 1px black;'>";
echo "<thead><tr><th>ID</th><th>First name</th><th>Last name</th></tr></thead>";
echo "<tbody>";

while ($row = $stmt->fetch()) {
    echo "<tr><td>$row[Employee_ID]</td><td>$row[First_Name]</td><td>$row[Last_Name]</td></tr>";
}

echo "</tbody>";
echo "</table>";

?>