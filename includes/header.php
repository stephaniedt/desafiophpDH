<nav class="navbar navbar-expand-lg text-white bg-dark container-flex">
  <a class="navbar-brand text-white" href="#"> < Desafio PHP /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <?php 
       if(isset($_POST['btn-login'])) :?>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="./indexprodutos.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="./createproduto.php">Adicionar produto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="./createusuario.php">Usuários</a>
      </li>
    </ul>
  </div>
     <div class="navbar">
         <ul class="nav-bar nav">
             <li class="nav-item col align-self-end">
                 <a class="nav-link text-white col align-self-end" href="#">Logout</a>
             </li>
         </ul>
     </div>
     <?php endif; ?>
    </ul>
</nav>