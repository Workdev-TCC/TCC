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
    $projetoEdit = null;
    $projeto = null;

    if (!empty($_GET['edit'])) {
        $id = (int) $_GET['edit'];
        $projetoEdit = $bd->select("projetos", "*", ["id" => $id], false, 1);
        if ($projetoEdit) {
            $editMode = true;
            $projeto = $projetoEdit;
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
                if (!$img) throw new Exception("Erro ao enviar imagem.");

                $bd->save("projetos", [
                    "titulo" => $titulo,
                    "descricao" => $descricao,
                    "imagem" => $img
                ]);

                $_SESSION['message'] = "Projeto cadastrado!";
                $_SESSION['type'] = "success";
            } else {
                $id = $_POST['id'];
                $projetoAtual = $bd->select("projetos", "*", ["id" => $id], false, 1);

                if (!$projetoAtual) throw new Exception("Projeto não encontrado.");

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
    $lista = $bd->select("projetos", "*", null, true);
    include HEADER_TEMPLATE;
?>

    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="message-<?php echo htmlspecialchars($_SESSION['type']); ?>">
            <span><?php echo htmlspecialchars($_SESSION['message']); ?></span>
            <i class="fas fa-times btn-close" onclick="this.parentElement.remove()"></i>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['type']); ?>
    <?php endif; ?>

    <div class="container mt-4">
        <h2>
            <?php
                if ($editMode) {
                    echo "Editar o projeto " . (!empty($p['titulo']) ? htmlspecialchars($p['titulo']) . "." : ".");
                } else {
                    echo "Cadastrar novo projeto";
                }
            ?>
        </h2>

        <form method="POST" enctype="multipart/form-data" class="mt-4">
            <?php if (!empty($projeto['id'])): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars((string)$projeto['id']) ?>">
            <?php endif; ?>


            <label>Título</label>
            <input type="text" name="titulo" value="<?php echo isset($projeto['titulo']) ? htmlspecialchars($projeto['titulo']) : '' ?>" required>

            <label class="mt-3">Descrição</label>
            <textarea name="descricao" required><?php echo isset($projeto['descricao']) ? htmlspecialchars($projeto['descricao']) : '' ?></textarea>

            <label class="mt-3">Imagem <?php echo $editMode ? "(enviar nova = opcional)" : ""; ?></label>
            <input type="file" name="imagem" class="form-control" accept="image/*" <?php echo $editMode ? "" : "required"; ?>>

            <?php if ($editMode): ?>
                <p class="mt-2">Imagem atual:</p>
                <?php if (!empty($projeto['imagem'])): ?>
                    <img src="<?php echo htmlspecialchars(RAIZ_PROJETO . 'assets/admin/img/' . $projeto['imagem']); ?>" width="120" alt="Imagem do projeto">
                <?php else: ?>
                    <p>Nenhuma imagem cadastrada.</p>
                <?php endif; ?>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary mt-4">
                <?php echo $editMode ? "Salvar alterações" : "Cadastrar"; ?>
            </button>

            <?php if ($editMode): ?>
                <a href="projetos_add.php" class="btn btn-secondary mt-4">Cancelar edição</a>
            <?php endif; ?>
        </form>

        <h2 class="mt-5">Projetos cadastrados</h2>
        <div class="row mt-4">
            <?php if (!empty($lista)): ?>
                <?php foreach ($lista as $p): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <img src="<?php echo htmlspecialchars(RAIZ_PROJETO . 'assets/admin/img/' . $p['imagem']);  ?>" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: cover;"
                                alt="<?php echo htmlspecialchars($p['titulo']); ?>">

                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($p['titulo']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($p['descricao'], 0, 120)) . "..."; ?></p>

                                <div class="d-flex justify-content-between">
                                    <a href="?edit=<?php echo htmlspecialchars($p['id']); ?>" class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <a href="?delete=<?php echo htmlspecialchars($p['id']); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Excluir este projeto?')">
                                        Excluir
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="mt-3">Nenhum projeto encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
<?php include FOOTER_TEMPLATE; ?>
