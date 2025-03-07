<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $ticket_status = 0; 

    $xmlFile = "../data/participants.xml";

    if (file_exists($xmlFile)) {
        $xml = simplexml_load_file($xmlFile);
    } else {
        $xml = new SimpleXMLElement("<reservations></reservations>");
    }

    $reservation = $xml->addChild("reservation");
    $reservation->addChild("event_id", $event_id);
    $reservation->addChild("name", htmlspecialchars($name));
    $reservation->addChild("email", htmlspecialchars($email));
    $reservation->addChild("ticket_status", $ticket_status);

    // Format the XML
    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $xmlFormatted = $dom->saveXML();

    file_put_contents($xmlFile, $xmlFormatted);

    header("Location: ../pages/events.php");
    exit();
} else {
    echo "<p>Invalid request.</p>";
}
?>
