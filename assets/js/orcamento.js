// Função auxiliar para calcular latas necessárias
function calcularLatas(litros) {
  const tamanhos = [18, 5, 3.6, 2.5, 0.9];
  const latas = [];

  for (let i = 0; i < tamanhos.length; i++) {
    const qtd = Math.floor(litros / tamanhos[i]);
    if (qtd > 0) {
      latas.push(`${qtd} lata(s) de ${tamanhos[i]}L`);
      litros -= qtd * tamanhos[i];
    }
  }

  // Se ainda restar tinta necessária, usa a menor lata
  if (litros > 0) {
    latas.push(`1 lata de 0.9L`);
  }

  return latas.join(", ");
}

$(document).ready(function () {
  $("#calcular").click(function () {
    const area = parseFloat($("#area").val());
    const demao = parseInt($("#demao").val());
    const rendimento = parseFloat($("#rendimento").val());
    const precoTinta = parseFloat($("#precoTinta").val());
    const maoObra = parseFloat($("#maoObra").val());
    const extras = parseFloat($("#extras").val() || 0);

    const litrosNecessarios = (area * demao) / rendimento;
    const custoMaterial = litrosNecessarios * precoTinta;
    const custoMaoObra = area * maoObra;
    const custoTotal = custoMaterial + custoMaoObra + extras;
    const lucro = custoTotal * 0.3;
    const valorFinal = custoTotal + lucro;

    const latasTexto = calcularLatas(litrosNecessarios);

    $("#salvar").show();

    $("#resultado").html(`
      <h3>Resumo do Orçamento</h3>
      <p><strong>Quantidade de material:</strong> ${latasTexto}</p>
      <p><strong>Litros necessários:</strong> ${litrosNecessarios.toFixed(
        2
      )} L</p>
      <p><strong>Gasto com material:</strong> R$ ${custoMaterial.toFixed(2)}</p>
      <p><strong>Gasto com mão de obra:</strong> R$ ${custoMaoObra.toFixed(
        2
      )}</p>
      <p><strong>Total de extras:</strong> R$ ${extras.toFixed(2)}</p>
      <p><strong>Valor sem lucro:</strong> R$ ${custoTotal.toFixed(2)}</p>
      <p><strong>Lucro (30%):</strong> R$ ${lucro.toFixed(2)}</p>
      <p><strong>Valor final:</strong> R$ ${valorFinal.toFixed(2)}</p>
    `);

    dadosOrcamento = {
      area,
      demao,
      rendimento,
      preco_tinta: precoTinta,
      mao_obra: maoObra,
      extras,
      litros_necessarios: litrosNecessarios.toFixed(2),
      gasto_material: custoMaterial.toFixed(2),
      gasto_mao_obra: custoMaoObra.toFixed(2),
      total_extras: extras.toFixed(2),
      lucro_aplicado: lucro.toFixed(2),
      valor_sem_lucro: custoTotal.toFixed(2),
      valor_final: valorFinal.toFixed(2),
    };
  });

  $("#salvar").click(function () {
    $.post(
      "../orcamento/orçamento_salvar.php",
      dadosOrcamento,
      function (resposta) {
        // Redireciona para a página após salvar
        window.location.href =
          "listar.php?msg=" +
          encodeURIComponent("salvo com sucesso") +
          "&type=success";
      }
    ).fail(function () {
      window.location.href =
        "orçamento.php?msg=" +
        encodeURIComponent("não foi possivel salvar. Verifique seu PHP") +
        "&type=danger";
    });
  });
});
