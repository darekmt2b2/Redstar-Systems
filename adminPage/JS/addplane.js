document.addEventListener("DOMContentLoaded", () => {
  // aircraft section table 2E
  const aircraftModal = document.getElementById("aircraftModal");
  const openAircraftBtn = document.getElementById("openModalBtn");
  const closeAircraftBtn = document.getElementById("closeModalBtn");

  if (openAircraftBtn && closeAircraftBtn && aircraftModal) {
    openAircraftBtn.onclick = () => aircraftModal.style.display = "block";
    closeAircraftBtn.onclick = () => aircraftModal.style.display = "none";

    window.onclick = (e) => {
      if (e.target === aircraftModal) aircraftModal.style.display = "none";
    };
  }

  // add event section
  const addEventModal = document.getElementById("addEventModal");
  const openAddEventBtn = document.getElementById("openAddEventBtn");
  const closeAddEventBtn = document.getElementById("closeAddEventModal");

  if (openAddEventBtn && addEventModal && closeAddEventBtn) {
    openAddEventBtn.onclick = () => addEventModal.style.display = "block";
    closeAddEventBtn.onclick = () => addEventModal.style.display = "none";

    window.onclick = (e) => {
      if (e.target === addEventModal) addEventModal.style.display = "none";
    };
  }

  // event edition section
  const editEventModal = document.getElementById("editEventModal");
  const closeEditEventBtn = document.getElementById("closeEditEventModal");
  const editEventButtons = document.querySelectorAll(".openEditBtn");

  if (editEventModal && closeEditEventBtn && editEventButtons.length > 0) {
    editEventButtons.forEach(btn => {
      btn.onclick = () => {
        document.getElementById("editEventId").value = btn.dataset.id;
        document.getElementById("editEventName").value = btn.dataset.name;
        document.getElementById("editEventDate").value = btn.dataset.date;
        document.getElementById("editEventDesc").value = btn.dataset.desc;
        editEventModal.style.display = "block";
      };
    });

    closeEditEventBtn.onclick = () => editEventModal.style.display = "none";

    window.onclick = (e) => {
      if (e.target === editEventModal) editEventModal.style.display = "none";
    };
  }
});
