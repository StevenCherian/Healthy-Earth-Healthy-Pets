<?php

require_once('connection.php');

setlocale(LC_MONETARY, 'en_US');

if (!isset($_GET['Employee_ID'])) {
    
    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name FROM Employee ORDER BY First_Name, Last_Name");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='Employee_ID' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[Employee_ID]'>$row[First_Name] $row[Last_Name]</option>";
    }
    
    echo "</select>";
    echo "</form>";
} else {
    
    $Employee_ID = $_GET["Employee_ID"]; // GET NOT SAFE FOR PRIVACY OF VARIABLES
    
    $stmt = $conn->prepare("SELECT Employee_ID, First_Name, Last_Name, Email_Address, Home_Address, Phone_Number, Salary FROM Employee WHERE Employee_ID=$Employee_ID"); // NOT SAFE FOR SQL INJECTION
    
    //$stmt = $conn->prepare("SELECT employee_id, first_name, last_name, salary FROM employees WHERE employee_id=:employee_id"); // PREPARED STATEMENT (BETTER USE)
    //$stmt->bindValue(':employee_id', $employee_id);
    
    $stmt->execute();
    
    echo "<table style='border: solid 1px black;'>";
    echo "<thead><tr><th>Employee ID</th><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Home Address</th><th>Phone Number</th><th>Salary</th></tr></thead>";
    echo "<tbody>";
    
    $fmt = new NumberFormatter( 'en_US', NumberFormatter::CURRENCY );
    
    while ($row = $stmt->fetch()) {
        echo "<tr><td>$row[Employee_ID]</td><td>$row[First_Name]</td><td>$row[Last_Name]</td><td>$row[Email_Address]</td><td>$row[Home_Address]</td><td>$row[Phone_Number]</td>
                <td>" . $fmt->formatCurrency($row["Salary"], "USD") . "</td></tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
}

?>