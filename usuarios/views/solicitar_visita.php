<?php
    include("../../config.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<?php if (!empty($_SESSION['message'])) : ?>
	<div class="message-<?php echo $_SESSION['type']; ?>">
		<?php if ($_SESSION['type'] === "success") : ?>
			<i class="fas fa-check-circle icon-message"></i>
		<?php else : ?>
			<i class="fas fa-times-circle icon-message"></i>
		<?php endif; ?>
		<span><?php echo $_SESSION['message']; ?></span>
		<i class="fas fa-times btn-close" onclick="this.parentElement.remove()"></i>
	</div>
	<?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
	<?php clear_messages(); ?>
<?php endif; ?>

<div class="solicitar-visita-page">
  <h1>Solicitar Visita</h1>
  <div class="linha"></div>
  <form action="<?php echo RAIZ_PROJETO;?>usuarios/solicitar_visita.php" method="post" class="container mt-4">
    <div class="row g-3">

      <!-- CEP -->
      <div class="col-md-4">
        <label for="cep" class="form-label">CEP </label>
        <input type="text" class="form-control" id="cep" name="cep" maxlength="9" placeholder="Digite o seu CEP..." required>
      </div>

      <!-- TOOLTIP (só aparece quando CEP estiver vazio) -->
      <div class="col-md-4 input-hover-area">
        <label for="cidade" class="form-label">Cidade </label>
        <input type="text" class="form-control" id="cidade" name="cidade" readonly required>
        <div class="tooltip-auto">Esse campo será preenchido automaticamente após inserir o CEP.</div>
      </div>

      <div class="col-md-4 input-hover-area">
        <label for="bairro" class="form-label">Bairro </label>
        <input type="text" class="form-control" id="bairro" name="bairro" readonly required>
        <div class="tooltip-auto">Esse campo será preenchido automaticamente após inserir o CEP.</div>
      </div>

      <div class="col-md-8 input-hover-area">
        <label for="rua" class="form-label">Rua </label>
        <input type="text" class="form-control" id="rua" name="rua" readonly required>
        <div class="tooltip-auto">Esse campo será preenchido automaticamente após inserir o CEP.</div>
      </div>

      <div class="col-md-4">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento">
      </div>

      <div class="col-md-3">
        <label for="numero" class="form-label">Número do Imóvel</label>
        <input type="text" class="form-control" placeholder="Número" id="numero" name="numero" maxlength="5" required>
      </div>

      <div class="col-md-9">
        <label for="descricao" class="form-label">Descrição do Serviço Desejado</label>
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Ex: Pintura detalhada, retoque, etc.">
      </div>

      <!-- SERVIÇOS -->
      <div class="col-md-12">
        <label for="tipo_servico" class="form-label">Tipos de Serviço</label>

        <div id="servicos-container">
          <div class="input-group mb-2 servico-item">
            <select name="tipo_servico[]" class="form-control" required>
              <option value="">Selecione um tipo de serviço...</option>
              <option value="pintura interna">Pintura Interna</option>
              <option value="pintura de fachada">Pintura de Fachada</option>
              <option value="pintura de portoes">Pintura de Portões</option>
              <option value="pintura decorativa">Pintura Decorativa</option>
              <option value="aplicação de texturas">Aplicação de Texturas</option>
              <option value="pintura predial">Pintura Predial</option>
            </select>
            <button type="button" class="btn btn-danger btn-remover-servico">Remover</button>
          </div>
        </div>

        <button type="button" class="btn btn-outline-primary mt-2" id="btn-add-servico">
          + Adicionar outro serviço
        </button>
      </div>

      <div class="col-12 text-end mt-3 mb-2">
        <button type="submit" class="btn btn-info px-4">Enviar <i class="fa-regular fa-floppy-disk"></i></button>
        <a href="<?php echo RAIZ_PROJETO;?>usuarios/views/gerenciar_solicitacoes.php" class="btn btn-info px-4">Voltar <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </form>
</div>
       <div id="alertBonito" class="alert-bonito">
    <div class="alert-content">
        <span id="alertMensagem"></span>
    </div>
</div>
<script>
// VIA CEP
document.getElementById("cep").addEventListener("blur", function () {
    const cep = this.value.replace(/\D/g, "");
    if (cep.length === 8) {
        fetch("https://viacep.com.br/ws/" + cep + "/json/")
            .then(res => res.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById("cidade").value = data.localidade;
                    document.getElementById("bairro").value = data.bairro;
                    document.getElementById("rua").value = data.logradouro;
                } else {
                    alert("CEP não encontrado!");
                }
            })
            .catch(() => alert("Erro ao consultar o CEP."));
    }
});

// Tooltip inteligente
function atualizarTooltips() {
    const cep = document.getElementById("cep").value.trim();
    const tooltips = document.querySelectorAll(".tooltip-auto");

    tooltips.forEach(t => {
        t.style.display = cep === "" ? "block" : "none";
    });
}

document.getElementById("cep").addEventListener("input", atualizarTooltips);
atualizarTooltips();

function showToast(msg) {
    const alertBox = document.getElementById("alertBonito");
    const alertMsg = document.getElementById("alertMensagem");

    alertMsg.textContent = msg;

    alertBox.classList.add("show");

    setTimeout(() => {
        alertBox.classList.remove("show");
    }, 3000);
}
// ---------- ADICIONAR / REMOVER SERVIÇOS + IMPEDIR DUPLICAÇÃO ----------
document.addEventListener("DOMContentLoaded", function () {

    const container = document.getElementById("servicos-container");
    const btnAdd = document.getElementById("btn-add-servico");

    // Atualiza selects para impedir repetição
    function atualizarServicos() {
        const selects = document.querySelectorAll('select[name="tipo_servico[]"]');
        let usados = [];

        selects.forEach(s => {
            if (s.value !== "") usados.push(s.value);
        });

        selects.forEach(select => {
            const selecionadoAgora = select.value;

            [...select.options].forEach(opt => {
                if (opt.value === "") return;

                if (usados.includes(opt.value) && opt.value !== selecionadoAgora) {
                    opt.disabled = true;
                } else {
                    opt.disabled = false;
                }
            });
        });
    }

    // Impede duplicados
    function evitarDuplicados() {
        const selects = document.querySelectorAll('select[name="tipo_servico[]"]');
        let valores = [];

        selects.forEach(select => {
            let v = select.value;

            if (v !== "" && valores.includes(v)) {
                select.value = "";
               showToast("Você já selecionou esse serviço.");
            } else {
                valores.push(v);
            }
        });

        atualizarServicos();
    }

    container.addEventListener("change", evitarDuplicados);


    // ADICIONAR SERVIÇO COM LIMITE CORRETO
    btnAdd.addEventListener("click", function () {

        const totalServicos = container.querySelectorAll(".servico-item").length;

        if (totalServicos >= 6) {
          showToast("Limite máximo de serviços atingido!");
            return;
        }

        const newItem = document.createElement("div");
        newItem.classList.add("input-group", "mb-2", "servico-item");
        newItem.innerHTML = `
            <select name="tipo_servico[]" class="form-control" required>
                <option value="">Selecione um tipo de serviço...</option>
                <option value="pintura interna">Pintura Interna</option>
                <option value="pintura de fachada">Pintura de Fachada</option>
                <option value="pintura de portoes">Pintura de Portões</option>
                <option value="pintura decorativa">Pintura Decorativa</option>
                <option value="aplicação de texturas">Aplicação de Texturas</option>
                <option value="pintura predial">Pintura Predial</option>
            </select>
            <button type="button" class="btn btn-danger btn-remover-servico">Remover</button>
        `;
        container.appendChild(newItem);
    });


    // REMOVER SERVIÇO — FALTAVA ISSO!
    container.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-remover-servico")) {
            e.target.closest(".servico-item").remove();
        }
    });

    atualizarServicos();

});


</script>

<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>
