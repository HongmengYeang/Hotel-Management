const side_bar = document.getElementById("side-bar");

function updateClock() {
  const now = new Date();
  const hours = String(now.getHours()).padStart(2, "0");
  const minutes = String(now.getMinutes()).padStart(2, "0");
  const seconds = String(now.getSeconds()).padStart(2, "0");
  document.getElementById(
    "clock"
  ).textContent = `${hours}:${minutes}:${seconds}`;
}

// Initial call
updateClock();
// Update every second
setInterval(updateClock, 1000);

document.getElementById("menu").addEventListener("click", function () {
  side_bar.classList.toggle("show");
});
document.getElementById("close-menu").addEventListener("click", () => {
  side_bar.classList.toggle("show");
});

// Function to show the alert box
function showAlert(message) {
  const alertBox = document.getElementById("alert-box");
  const alertMessage = document.querySelector(".alert-message");

  alertMessage.textContent = message;
  alertBox.classList.add("show");

  setTimeout(() => {
    closeAlert();
  }, 5000); // Automatically close after 5 seconds
}

// Function to close the alert box
function closeAlert() {
  const alertBox = document.getElementById("alert-box");
  alertBox.classList.remove("show");
}
