<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "task_management_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create `works_on` table
$sql1 = "CREATE TABLE IF NOT EXISTS works_on (
    user_id INT NOT NULL,
    task_id INT NOT NULL,
    assigned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, task_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
)";

if ($conn->query($sql1) === TRUE) {
    echo "Table 'works_on' created successfully.<br>";
} else {
    echo "Error creating 'works_on': " . $conn->error . "<br>";
}

// 2. Create `dependent` table
$sql2 = "CREATE TABLE IF NOT EXISTS dependent (
    dependent_user_id INT NOT NULL,
    depends_on_user_id INT NOT NULL,
    PRIMARY KEY (dependent_user_id, depends_on_user_id),
    FOREIGN KEY (dependent_user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (depends_on_user_id) REFERENCES users(id) ON DELETE CASCADE
)";


if ($conn->query($sql2) === TRUE) {
    echo "Table 'dependent' created successfully.<br>";
} else {
    echo "Error creating 'dependent': " . $conn->error . "<br>";
}

// 3. Create `location` table
$sql3 = "CREATE TABLE IF NOT EXISTS location (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    address TEXT
)";

if ($conn->query($sql3) === TRUE) {
    echo "Table 'location' created successfully.<br>";
} else {
    echo "Error creating 'location': " . $conn->error . "<br>";
}

// Optionally link tasks to locations (if needed)

//if ($conn->query($sql4) === TRUE) {
  //  echo "Tasks table updated with location_id.<br>";
//} else {
  //  echo "Error updating tasks table: " . $conn->error . "<br>";
//}

$conn->close();
?>
