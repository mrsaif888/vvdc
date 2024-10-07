<?php
$conn = new mysqli('localhost', 'root', '', 'daycare');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parent_name = $_POST['parentName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $child_name = $_POST['childName'];
    $child_age = $_POST['childAge'];
    $event = $_POST['event'];

    // Check current registrations and max limit
    $event_check = $conn->prepare("SELECT current_registrations, max_limit FROM limits_event WHERE event_name = ?");
    $event_check->bind_param('s', $event);
    $event_check->execute();
    $event_check->store_result();
    $event_check->bind_result($current_registrations, $max_limit);
    $event_check->fetch();

    // Check if registration is possible
    if ($current_registrations < $max_limit) {
        // Insert new registration
        $stmt = $conn->prepare("INSERT INTO registrationsform (parent_name, email, phone, child_name, child_age, event) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssis", $parent_name, $email, $phone, $child_name, $child_age, $event);

        if ($stmt->execute()) {
            // Update current registration count
            $update_count = $conn->prepare("UPDATE limits_event SET current_registrations = current_registrations + 1 WHERE event_name = ?");
            $update_count->bind_param('s', $event);
            $update_count->execute();

            // JavaScript alert for success and redirect to programs page
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = './program.html'; 
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the insert statement
        $stmt->close();
    } else {
        // JavaScript alert for full event and redirect to programs page
        echo "<script>
                alert('Event is full!');
                window.location.href = './program.html'; 
              </script>";
    }

    // Close event check statement
    $event_check->close();
}

// Close the connection
$conn->close();
?>
