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

    header("Location: ../pages/events.php");
    exit();
} else {
    echo "<p>Invalid request.</p>";
}
?>
