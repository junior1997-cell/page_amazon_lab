function active(name) {

  if (name == 'inicio') {
    $('.inicio').addClass("_active"); $('.nosotros').removeClass("_active"); $('.servicios').removeClass("_active"); $('.contactanos').removeClass("_active");
  } else if (name == 'nosotros') {
    $('.nosotros').addClass("_active"); $('.inicio').removeClass("_active"); $('.servicios').removeClass("_active"); $('.contactanos').removeClass("_active");
  } else if (name == 'servicios') {
    $('.servicios').addClass("_active"); $('.nosotros').removeClass("_active"); $('.inicio').removeClass("_active"); $('.contactanos').removeClass("_active");
  } else if (name == 'contactanos') {
    $('.contactanos').addClass("_active"); $('.nosotros').removeClass("_active"); $('.servicios').removeClass("_active"); $('.inicio').removeClass("_active");

  }
}

function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Leer más";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Leer menos";
    moreText.style.display = "inline";
  }
}



