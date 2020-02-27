<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">
      < Desafio PHP /></a>
    <?php if (isset($_SESSION['email'])) : ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div>
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="./indexprodutos.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="./createproduto.php">Adicionar produto</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link text-white" href="./createusuario.php">Usuários</a>
            </li>
          </ul>
        </div>

        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <form action="" method="POST">
                <button type="submit" class=" text-white col btn align-self-end" name="btn-logout">Logout</a>
              </form>
            </li>
          </ul>
        </div>
      </div>
    <?php endif; ?>
  </div>
</nav>

<?php
if (isset($_POST['btn-logout'])) {
  session_destroy();
  header('location: index.php');
}
?>