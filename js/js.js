document.addEventListener("DOMContentLoaded", function() {
  let myIndex = 0;
  
  function carousel() {
    let slides = document.getElementsByClassName("imageSlides");
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    myIndex = myIndex + 1 > slides.length ? 1 : myIndex + 1;
    if (slides.length > 0) {
      slides[myIndex - 1].style.display = "block";
    }
    setTimeout(carousel, 60000);
  }
  carousel();
  
  // Live date and time
  var date = document.getElementById("date");
  
  function updateDateTime() {
    var today = new Date();
    var currentDate = today.toLocaleDateString();
    var currentTime = today.toLocaleTimeString();
    if (date) {
      date.innerHTML = currentDate + " " + currentTime;
    }
  }
  
  updateDateTime(); // Initial run
  setInterval(updateDateTime, 1000); // Update every second
  
  // W3 toggle functions
  window.labs = function() {
    var x = document.getElementById("labs");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
      x.previousElementSibling.className += " w3-green";
    } else {
      x.className = x.className.replace(" w3-show", "");
      x.previousElementSibling.className = x.previousElementSibling.className.replace(" w3-green", "");
    }
  };
  
  window.assignment = function() {
    var x = document.getElementById("assignment");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
      x.previousElementSibling.className += " w3-green";
    } else {
      x.className = x.className.replace(" w3-show", "");
      x.previousElementSibling.className = x.previousElementSibling.className.replace(" w3-green", "");
    }
  };
});
