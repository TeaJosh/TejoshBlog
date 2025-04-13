<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link 
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" 
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
  crossorigin="anonymous">

<div id="header">
  <div class="image-carousel">
    <div class="w3-content w3-section" style="max-width:500px">
      <img class="imageSlides" src="../images/bio.jpg" alt="Tejosh Rana">
      <img class="imageSlides" src="../images/quote.jpg" alt="Quote">
      <img class="imageSlides" src="../images/coding.jpg" alt="Coding">
    </div>
  </div>

  <div class="title">
    <h2><span id="written"></span></h2>
  </div>

  <div class="logopicture">
    <img src="../images/metrologo.jpg" alt="Metropolitan State University logo">
  </div>

  <div class="pfp">
    <img src="../images/TJ.jpg" alt="Tejosh Rana">
  </div>

  <div class="blank-space">
    <ul>
      <li><a target="_blank" href="mailto:tejoshrana@gmail.com">tejoshrana@gmail.com</a></li>
      <li><a target="_blank" href="https://www.linkedin.com/in/tejosh-rana-83b3121a4">LinkedIn</a></li>
      <li><a target="_blank" href="https://github.com/TeaJosh">GitHub</a></li>
    </ul>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="/js/js.js"></script>

<script>
  const typewritter = new Typed('#written', {
    strings: ["Aspiring UX Engineer.", "Webnaut exploring the webverse.", "Your average audiophile enjoyer."],
    typeSpeed: 25,
    backSpeed: 25,
    backDelay: 1000,
    cursorChar: '_',
    loop: true
  });
</script>
