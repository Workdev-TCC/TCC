$(document).ready(function () {
  $('#calcular').click(function () {
    const area = parseFloat($('#area').val());
    const demao = parseInt($('#demao').val());
    const rendimento = parseFloat($('#rendimento').val());
    const precoTinta = parseFloat($('#precoTinta').val());
    const maoObra = parseFloat($('#maoObra').val());
    const extras = parseFloat($('#extras').val()) || 0;

    if (
      isNaN(area) || isNaN(demao) || isNaN(rendimento) ||
      isNaN(precoTinta) || isNaN(maoObra)
    ) {
      alert("Por favor, preencha todos os campos corretamente.");
      return;
    }

    const litrosNecessarios = (area * demao) / rendimento;

    // Latas disponíveis no mercado
    const latasDisponiveis = [18, 3.6, 2.5, 0.9];

    // Cálculo ideal de latas
    function calcularLatas(litros) {
      const resultado = {};
      let restante = litros;

      for (let i = 0; i < latasDisponiveis.length; i++) {
        const tamanho = latasDisponiveis[i];
        const qtd = Math.floor(restante / tamanho);
        if (qtd > 0) {
          resultado[tamanho] = qtd;
          restante -= qtd * tamanho;
        }
      }

      // Se ainda sobrou tinta, pega a menor lata possível
      if (restante > 0) {
        const menor = latasDisponiveis[latasDisponiveis.length - 1];
        resultado[menor] = (resultado[menor] || 0) + 1;
      }

      return resultado;
    }

    const latas = calcularLatas(litrosNecessarios);

    // Custo total do material (considera preço por litro)
    const custoMaterial = litrosNecessarios * precoTinta;
    const custoMaoObra = area * maoObra;
    const custoTotal = custoMaterial + custoMaoObra + extras;

    const lucro = custoTotal * 0.30; // 30% fixo
    const valorFinal = custoTotal + lucro;

    // Montar string das latas
    let textoLatas = '';
    for (const [tamanho, qtd] of Object.entries(latas)) {
      textoLatas += `${qtd} lata(s) de ${tamanho}L<br>`;
    }

        $('#resultado').html(`
            <h3>Resumo do Orçamento</h3>
            <p><strong>Quantidade de tinta necessária:</strong> ${litrosNecessarios.toFixed(2)} litros</p>
            <p><strong>Distribuição ideal de latas:</strong><br>${textoLatas}</p>
            <p><strong>Gasto com material:</strong> R$ ${custoMaterial.toFixed(2)}</p>
            <p><strong>Gasto com mão de obra:</strong> R$ ${custoMaoObra.toFixed(2)}</p>
            <p><strong>Total de extras:</strong> R$ ${extras.toFixed(2)}</p>
            <hr>
            <p><strong>Valor do serviço (sem lucro):</strong> R$ ${custoTotal.toFixed(2)}</p>
            <p><strong>Lucro aplicado (30%):</strong> R$ ${lucro.toFixed(2)}</p>
            <p><strong>Valor final do serviço (com lucro):</strong> <span style="font-size: 18px; font-weight: bold;">R$ ${valorFinal.toFixed(2)}</span></p>
    `);

  });
});
