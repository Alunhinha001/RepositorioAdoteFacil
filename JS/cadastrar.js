function carregarCidades() {
  const estado = document.getElementById('estado').value;
  const selectCidade = document.getElementById('cidade');
  selectCidade.innerHTML = '<option value="">Carregando...</option>';
  selectCidade.disabled = true;

  if (!estado) {
    selectCidade.innerHTML = '<option value="">Selecione uma Cidade</option>';
    return;
  }

  fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estado}/municipios?orderBy=nome`)
    .then(res => {
      if (!res.ok) throw new Error('Erro ao consultar a API do IBGE');
      return res.json();
    })
    .then(cidades => {
      selectCidade.innerHTML = '<option value="">Selecione uma Cidade</option>';
      cidades.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c.nome;
        opt.textContent = c.nome;
        selectCidade.appendChild(opt);
      });
      selectCidade.disabled = false;
    })
    .catch(err => {
      console.error(err);
      selectCidade.innerHTML = '<option value="">Erro ao carregar</option>';
    });
}

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  form.addEventListener("submit", function handler(e) {
    e.preventDefault(); // impede envio automático para validar

    const email = document.getElementById("email").value.trim();
    const Cemail = document.getElementById("Cemail").value.trim();
    const senha = document.getElementById("senha").value;
    const Csenha = document.getElementById("Csenha").value;
    const estado = document.getElementById("estado").value;
    const cidade = document.getElementById("cidade").value;

    // Validações
    if (!estado) {
      alert("Por favor, selecione um Estado.");
      return;
    }

    if (!cidade) {
      alert("Por favor, selecione uma Cidade.");
      return;
    }

    if (email !== Cemail) {
      alert("Os e-mails não coincidem.");
      return;
    }

    if (senha !== Csenha) {
      alert("As senhas não coincidem.");
      return;
    }

    const senhaForte = /^(?=.*[a-zA-Z])(?=.*\d).{8,}$/;
    if (!senhaForte.test(senha)) {
      alert("A senha deve conter no mínimo 8 caracteres, incluindo letras e números.");
      return;
    }

    // Tudo certo, remove listener e envia form de verdade
    form.removeEventListener("submit", handler);
    form.submit();
  });
});
