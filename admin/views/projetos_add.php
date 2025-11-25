<?php
    include "../../config.php";
    include "../../inc/Banco.php";
    include_once UTEIS;
    session_start();

    if (empty($_SESSION['tipo'])) {
        header("Location:" . RAIZ_PROJETO);
        exit;
    }

    $bd = new Banco();
    $editMode = false;
    $projeto = null;

    if (!empty($_GET['edit'])) {
        $id = (int) $_GET['edit'];
        $result = $bd->select("projetos", "*", ["id" => $id], true, 1);

        if (!empty($result)) {
            $projeto = $result[0];
            $editMode = true;
        } else {
            $_SESSION['message'] = "Projeto não encontrado.";
            $_SESSION['type'] = "danger";
        }
    }

    if (!empty($_GET['delete'])) {
        try {
            $id = (int) $_GET['delete'];
            $bd->delete("projetos", ["id" => $id]);
            $_SESSION['message'] = "Projeto excluído!";
            $_SESSION['type'] = "success";
        } catch (Exception $e) {
            $_SESSION['message'] = "Erro ao excluir: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
        header("Location: projetos_add.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $pasta = "assets/admin/img/";

            if (empty($_POST['id'])) {
                $img = uploadImg($_FILES['imagem'], $pasta);
                if (!$img) throw new Exception("Erro: Envie apenas imagens nos formatos PNG, JPG ou JPEG.");

                $bd->save("projetos", [
                    "titulo" => $titulo,
                    "descricao" => $descricao,
                    "imagem" => $img
                ]);

                $_SESSION['message'] = "Projeto cadastrado!";
                $_SESSION['type'] = "success";
            } else {

                $id = (int) $_POST['id'];
                $result = $bd->select("projetos", "*", ["id" => $id], true, 1);
                if (!$result) throw new Exception("Projeto não encontrado.");

                $projetoAtual = $result[0];

                if (!empty($_FILES['imagem']['name'])) {
                    $img = uploadImg($_FILES['imagem'], $pasta);
                    if (!$img) throw new Exception("Erro ao enviar nova imagem.");
                } else {
                    $img = $projetoAtual['imagem'];
                }

                $bd->update("projetos", [
                    "titulo" => $titulo,
                    "descricao" => $descricao,
                    "imagem" => $img
                ], ["id" => $id]);

                $_SESSION['message'] = "Projeto atualizado!";
                $_SESSION['type'] = "success";
            }

            header("Location: projetos_add.php");
            exit;

        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }

    $lista = $bd->select("projetos", "*", [], true);
    include HEADER_TEMPLATE;
?>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert-message message-<?php echo $_SESSION['type']; ?>">
        <span><?php echo $_SESSION['message']; ?></span>
        <i class="fas fa-times close-btn" onclick="this.parentElement.remove()"></i>
    </div>
    <?php unset($_SESSION['message'], $_SESSION['type']); ?>
<?php endif; ?>

<section class="container-projetos">
    <div class="card-projetos">
        <div class="cabecalho">
            <h2><?php echo $editMode ? "Editar Projeto" : "Cadastrar Projeto"; ?></h2>
            <div class="linha"></div>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <?php if ($editMode): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($projeto['id']); ?>">
            <?php endif; ?>

            <div class="input-grupo">
                <label>Título</label>
                <input type="text" name="titulo" required
                value="<?php echo $editMode ? htmlspecialchars($projeto['titulo']) : ""; ?>">
            </div>

            <div class="input-grupo">
                <label>Descrição</label>
                <textarea name="descricao" required><?php echo $editMode ? htmlspecialchars($projeto['descricao']) : ""; ?></textarea>
            </div>

            <div class="input-grupo">
                <label>Imagem <?php echo $editMode ? "(opcional)" : ""; ?></label>
                <div class="custom-file-upload">
                    <label class="btn-file" for="foto">Escolher imagem</label>
                    <span id="fileName">Nenhum arquivo selecionado</span>
                    <input type="file" name="imagem" id="foto" <?php echo $editMode ? "" : "required"; ?>>
                </div>
            </div>

            <?php if ($editMode): ?>
                <div class="preview-img">
                    <p>Imagem atual:</p>
                    <img id="imgPreview" 
                        src="<?php echo $editMode ? RAIZ_PROJETO . 'assets/admin/img/' . $projeto['imagem'] : ''; ?>" 
                        alt="">
                </div>
            <?php endif; ?>

            <div class="botoes">
                <button type="submit">
                    <?php echo $editMode ? "Salvar" : "Cadastrar"; ?>
                </button>

                <?php if ($editMode): ?>
                    <a href="projetos_add.php">Cancelar</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <div class="titulo-lista">
        <h2>Projetos cadastrados</h2>
        <div class="linha"></div>
    </div>
    <div class="lista-projetos">
        <?php if (!empty($lista)): ?>
            <?php foreach ($lista as $p): ?>
            <div class="item-projeto">
                <img src="<?php echo RAIZ_PROJETO . 'assets/admin/img/' . $p['imagem']; ?>" alt="">
                <h3><?php echo htmlspecialchars($p['titulo']); ?></h3>
                <p><?php echo htmlspecialchars(substr($p['descricao'], 0, 120)); ?>...</p>

                <div class="acoes">
                    <a href="?edit=<?php echo $p['id']; ?>" class="edit">Editar</a>
                    <a href="?delete=<?php echo $p['id']; ?>" onclick="return confirm('Deseja exluir?')" class="delete">Excluir</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum projeto encontrado.</p>
        <?php endif; ?>
    </div>
</section>

<script>
  const fotoInput = document.getElementById("foto");
    const fileName = document.getElementById("fileName");
    const preview = document.getElementById("imgPreview");

    fotoInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            fileName.textContent = file.name;

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            fileName.textContent = "Nenhum arquivo selecionado";
            preview.src = "";
        }
    });

</script>
<?php include FOOTER_TEMPLATE; ?>
