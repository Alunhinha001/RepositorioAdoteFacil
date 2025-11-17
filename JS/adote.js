document.querySelectorAll('.saiba').forEach(botao => {
  botao.addEventListener('click', () => {
    const card = botao.closest('.pet-card');
    card.classList.toggle('expandido');
  });
});

