let myIndex = 0;

function carousel() {
  let slides = document.getElementsByClassName("imageSlides");

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  myIndex = myIndex + 1 > slides.length ? 1 : myIndex + 1;
  slides[myIndex - 1].style.display = "block";

  setTimeout(carousel, 60000);
}

carousel();



var date = document.getElementById("date");

setInterval(function () {
  var today = new Date();
  var currentDate = today.toLocaleDateString();
  var currentTime = today.toLocaleTimeString();
  date.innerHTML = currentDate + " " + currentTime;
}, 1000);






function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-blue", "");
  }
}



function assignment() {
  var x = document.getElementById("assignment");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

