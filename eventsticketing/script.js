// Auto-fill venue based on selected event
function setVenue() {
  const eventSelect = document.getElementById("event_name");
  const venueInput = document.getElementById("venue");

  switch (eventSelect.value) {
    case "Summer Jam":
      venueInput.value = "Nyayo Stadium";
      break;
    case "Rock Fiesta":
      venueInput.value = "Kasarani Arena";
      break;
    case "Jazz Night":
      venueInput.value = "Westlands Jazz Club";
      break;
    case "HipHop Live":
      venueInput.value = "Carnivore Grounds";
      break;
    default:
      venueInput.value = "";
  }
}

// Auto-fill price based on selected ticket type
function setPrice() {
  const ticketSelect = document.getElementById("ticket_type");
  const priceInput = document.getElementById("price");

  switch (ticketSelect.value) {
    case "Regular":
      priceInput.value = "2500";
      break;
    case "VIP":
      priceInput.value = "5000";
      break;
    case "VVIP":
      priceInput.value = "10000";
      break;
    default:
      priceInput.value = "";
  }
}
