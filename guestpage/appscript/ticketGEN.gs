function sendEventTickets() {
  const XML_FILE_ID = "1ANPNwrQC_av30CJbo6VH9fh5HAxHJBT4";
  const xmlContent = getXmlFromDrive(XML_FILE_ID);
  const xmlDoc = XmlService.parse(xmlContent);
  const root = xmlDoc.getRootElement();
  const reservations = root.getChildren("reservation");

  reservations.forEach(reservation => {
    const eventId = reservation.getChildText("event_id");
    const name = reservation.getChildText("name");
    const email = reservation.getChildText("email");
    const ticketStatus = reservation.getChildText("ticket_status");

    if (ticketStatus === "0") {
      const pdf = generateTicketPdf(eventId, name);
      sendEmail(email, pdf);
      reservation.getChild("ticket_status").setText("1");
    }
  });

  saveUpdatedXml(XML_FILE_ID, xmlDoc);
}

function getXmlFromDrive(fileId) {
  const file = DriveApp.getFileById(fileId);
  return file.getBlob().getDataAsString();
}

function generateTicketPdf(eventId, name) {
  const ticketHtml = `
    <html>
      <body>
        <h2>Event Ticket</h2>
        <p><strong>Event ID:</strong> ${eventId}</p>
        <p><strong>Name:</strong> ${name}</p>
        <p>Your ticket is confirmed!</p>
      </body>
    </html>
  `;
  const blob = HtmlService.createHtmlOutput(ticketHtml).getAs('application/pdf');
  blob.setName(`Ticket_${name}.pdf`);
  return blob;
}

function sendEmail(email, pdf) {
  const subject = "Your Event Ticket";
  const body = "Attached is your ticket for the event. Enjoy!";
  MailApp.sendEmail({
    to: email,
    subject: subject,
    body: body,
    attachments: [pdf]
  });
}

function saveUpdatedXml(fileId, xmlDoc) {
  const updatedXml = XmlService.getPrettyFormat().format(xmlDoc);
  const file = DriveApp.getFileById(fileId);
  file.setContent(updatedXml);
}
