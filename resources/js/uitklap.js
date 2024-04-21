// Wacht tot de DOM volledig is geladen
document.addEventListener("DOMContentLoaded", function() {
  // Zoek de knop
  var knop = document.querySelector('.vakje-knop');

  // Voeg een event listener toe aan de knop
  knop.addEventListener('click', toggleVakje);
});
function toggleVakje() {
  var vakjeInhoud = document.getElementById("vakje-inhoud");
  if (vakjeInhoud.style.display === "none") {
    vakjeInhoud.style.display = "block";
  } else {
    vakjeInhoud.style.display = "none";
  }
}