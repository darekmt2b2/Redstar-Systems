
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin console</title>
    <link rel="stylesheet" href="..\..\adminPage\resources\admin.css">
</head>
<body>
  <?php include '../pages/adminTopnav.php'; ?>
  <div class="container-grid">
    <div class="card">
      <h1>Aircraft</h1>
      <button id="openModalBtn">Add Aircraft</button>

      <?php include '../pages/adminAircraftDATA.php'; ?>

      <div id="aircraftModal" class="modal">
        <div class="modal-content">
          <span class="close" id="closeModalBtn">&times;</span>
          <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem;">Add New Aircraft</h3>
          <form method="POST" action="../pages/adminAircraftDATA.php">
            <input type="hidden" name="add_aircraft" value="1">
            
            <label>Registration:
              <input type="text" name="registration" required>
            </label>
            
            <label>Type:
              <input type="text" name="type" required>
            </label>
            
            <label>Owner:
              <select name="owner_id" required>
                <option value="">Select user</option>
                <?php
                  include '../../guestpage/controller/bdconfig.php';
                  $userQuery = $conexion->query("SELECT id, name FROM user");
                  while ($user = $userQuery->fetch_assoc()) {
                      echo "<option value='{$user['id']}'>" . htmlspecialchars($user['name']) . "</option>";
                  }
                ?>
              </select>
            </label>

            <button type="submit">Add Aircraft</button>
          </form>
        </div>
      </div>
    </div>

    
    <div class="card">
      <?php include '../pages/adminEventsDATA.php'; ?>

      <div id="addEventModal" class="modal">
        <div class="modal-content">
          <span class="close" id="closeAddEventModal">&times;</span>
          <h3>Add New Event</h3>
          <form method="POST" action="../pages/adminEventsDATA.php">
            <input type="hidden" name="add_event" value="1">
            <label>Event Name:
              <input type="text" name="event_name" required>
            </label>
            <label>Date:
              <input type="date" name="event_date" required>
            </label>
            <label>Description:
              <textarea name="event_desc" required></textarea>
            </label>
            <button type="submit">Add Event</button>
          </form>
        </div>
      </div>

      <div id="editEventModal" class="modal">
        <div class="modal-content">
          <span class="close" id="closeEditEventModal">&times;</span>
          <h3>Edit Event</h3>
          <form method="POST" action="../pages/adminEventsDATA.php">
            <input type="hidden" name="edit_event" value="1">
            <input type="hidden" name="event_id" id="editEventId">
            <label>Event Name:
              <input type="text" name="event_name" id="editEventName" required>
            </label>
            <label>Date:
              <input type="date" name="event_date" id="editEventDate" required>
            </label>
            <label>Description:
              <textarea name="event_desc" id="editEventDesc" required></textarea>
            </label>
            <button type="submit">Save Changes</button>
          </form>
        </div>
      </div>
    </div>

    
    <div class="card">
      <h2 class="card-title">METAR</h2>
      <?php include '../pages/adminMetarDATA.PHP';?>
    </div>

    <div class="card">
      <?php include '../pages/adminMaintenanceDATA.php';?>
    </div>
  </div> 
  <script src="../JS/addplane.js"></script>

</body>
</html>