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

