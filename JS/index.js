// SAIBA MAIS CARDS
document.addEventListener("DOMContentLoaded", function () {
  const botoesSaibaMais = document.querySelectorAll(".saiba");

  botoesSaibaMais.forEach((botao) => {
    botao.addEventListener("click", function () {
      const card = this.closest(".pet-card");
      const imagem = card.querySelector(".pet-imagem");
      const sobre = card.querySelector(".sobre");

      card.classList.toggle("expandido");

      if (card.classList.contains("expandido")) {
        imagem.style.opacity = "0";
        botao.textContent = "Ocultar";
      } else {
        imagem.style.opacity = "1";
        botao.textContent = "Saber mais";
      }
    });
  });


  // DROPDOWN MENU
  document.querySelectorAll('.dropdown-content a').forEach(link => {
    link.addEventListener('click', () => {
      document.getElementById('burger-menu').checked = false;
    });
  });
});


// SLIDES
let slideAtual = 0;
const slides = document.querySelectorAll('.slide');
const container = document.querySelector('.slides-container');

function mostrarSlide(index) {
  if (index >= slides.length) slideAtual = 0;
  if (index < 0) slideAtual = slides.length - 1;
  container.style.transform = `translateX(-${slideAtual * 100}%)`;
}

document.querySelector('.seta.direita').addEventListener('click', () => {
  slideAtual++;
  mostrarSlide(slideAtual);
});

document.querySelector('.seta.esquerda').addEventListener('click', () => {
  slideAtual--;
  mostrarSlide(slideAtual);
});

// Auto-play a cada 6 segundos
setInterval(() => {
  slideAtual++;
  mostrarSlide(slideAtual);
}, 6000);

