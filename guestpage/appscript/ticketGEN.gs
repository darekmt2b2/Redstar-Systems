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
      <body style="font-family: Arial, sans-serif; background-color: #f5f7fa; padding: 40px;">
        <div style="max-width: 600px; margin: auto; background-color: #fff; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
          <h2 style="color: #333; text-align: center; border-bottom: 1px solid #e0e0e0; padding-bottom: 10px;">🎟️ Event Ticket</h2>
          <p style="font-size: 16px; color: #555;"><strong>Event ID:</strong> ${eventId}</p>
          <p style="font-size: 16px; color: #555;"><strong>Name:</strong> ${name}</p>
          <p style="font-size: 16px; color: #2e7d32; margin-top: 20px;">✅ Your ticket is confirmed!</p>
          <p style="font-size: 14px; color: #888; margin-top: 30px; text-align: center;">Please bring this ticket with you to the event.</p>
        </div>
      </body>
    </html>
  `;
  const blob = HtmlService.createHtmlOutput(ticketHtml).getAs('application/pdf');
  blob.setName(`Ticket_${name}.pdf`);
  return blob;
}

function sendEmail(email, pdf) {
  const subject = "Your Event Ticket";
  const body = "We're waiting for you. Enjoy!";
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

