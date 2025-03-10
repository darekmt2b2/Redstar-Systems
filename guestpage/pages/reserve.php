<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $ticket_status = 0; 

    $xmlFile = "../data/participants.xml";

    if (file_exists($xmlFile) && filesize($xmlFile) > 0) {
        $xml = simplexml_load_file($xmlFile);
    } else {
        $xml = new SimpleXMLElement("<reservations></reservations>");
    }

    $reservation = $xml->addChild("reservation");
    $reservation->addChild("event_id", $event_id);
    $reservation->addChild("name", htmlspecialchars($name));
    $reservation->addChild("email", htmlspecialchars($email));
    $reservation->addChild("ticket_status", $ticket_status);

    //formatting
    $dom = new DOMDocument("1.0", "UTF-8");
    $dom->preserveWhiteSpace = false; 
    $dom->formatOutput = true; 
    $dom->loadXML($xml->asXML());

    $dom->save($xmlFile);

    //DB ops
    include '../controller/bdconfig.php';

    $sql = "SELECT ID FROM eventparticipants WHERE email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $sql_insert = "INSERT INTO eventparticipants (name, email) VALUES (?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("ss", $name, $email);
        $stmt_insert->execute();

        
        
        $participant_id = $conexion->insert_id; // Get last inserted ID

        $sql_assistance = "INSERT INTO event_assistance (participant_id, event_id) VALUES (?, ?)";
        $stmt2 = $conexion->prepare($sql_assistance);
        $stmt2->bind_param("ii", $participant_id, $event_id);
        $stmt2->execute();
    } else {
        // Fetch the existing user's ID
        $row = $result->fetch_assoc();
        $participant_id = $row['ID'];
        
        $sql_alreadyRegistered = "SELECT * FROM event_assistance WHERE participant_id = ? AND event_id = ?";
        $stmt2 = $conexion->prepare($sql_alreadyRegistered);
        $stmt2->bind_param("ii", $participant_id, $event_id);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            header("Location: ../pages/events.php?already_registered=true");
            exit();
            
        } else {

            $sql_assistance = "INSERT INTO event_assistance (participant_id, event_id) VALUES (?, ?)";
            $stmt3 = $conexion->prepare($sql_assistance);
            $stmt3->bind_param("ii", $participant_id, $event_id);
            $stmt3->execute();

            header("Location: ../pages/events.php");
            exit();
        }

        
    }

    header("Location: ../pages/events.php");
    exit();
} else {
    echo "<p>Invalid request.</p>";
}
?>
