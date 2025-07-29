const planetImages = {
  mercurio: [
    "assets/img/mercurio1.jpeg",
    "assets/img/mercurio2.jpeg"
  ],
  venus: [
    "assets/img/venus1.jpeg",
    "assets/img/venus2.jpeg",
    "assets/img/venus3.jpeg"
  ],
  tierra: [
    "assets/img/luna_tierra1.jpeg",
    "assets/img/luna_tierra2.jpeg"
  ],
  marte: [
    "assets/img/marte1.jpeg",
    "assets/img/marte2.jpeg"
  ],
  jupiter: [
    "assets/img/jupiter1.jpeg",
    "assets/img/jupiter2.jpeg"
  ],
  saturno: [
    "assets/img/saturno_helado.jpeg",
    "assets/img/saturno_titan.jpeg"
  ]
};

let images = [];
let currentIndex = 0;

function openModal(planetName) {
  const key = planetName.toLowerCase(); // aseguramos minúsculas
  images = planetImages[key] || [];
  currentIndex = 0;

  if (images.length > 0) {
    document.getElementById("sliderImage").src = images[currentIndex];
    document.getElementById("imageModal").style.display = "block";
    document.body.style.overflow = "hidden"; // desactiva scroll de fondo
  } else {
    alert("No hay imágenes disponibles para " + planetName);
  }
}

function closeModal() {
  document.getElementById("imageModal").style.display = "none";
  document.body.style.overflow = "auto"; // reactiva scroll
}

function changeSlide(direction) {
  if (images.length === 0) return;

  currentIndex = (currentIndex + direction + images.length) % images.length;
  document.getElementById("sliderImage").src = images[currentIndex];
}
