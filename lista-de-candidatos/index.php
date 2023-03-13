<?php 

$erro = $_COOKIE['msg'];



session_destroy();

?>


<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link REL="SHORTCUT ICON" HREF="img/logo-titulo.png">
    <title>Grupo Gevan - Candidatos</title>
    <meta charset="UTF-8"> <link href="estilo.css" rel="stylesheet" type="text/css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script> document.getElementById('cad').style.display = 'none';
         document.getElementById('cad1').style.display = 'none';
 </script>


  </head>
  <header class="cabecalho"> <h1 class="text-center"> <img  src="img/logo.png"> </h1> 
</header>
  <body>
  
<div class="container-fluid text-center">
    <h2>Lista de Candidatos</h2>
    <br>
    <h4>Seleciona um Período</h4>
    <?php if($erro != null and $erro != ''){
      echo "<h3 style='color: #f00;'>$erro</h3>";
    } ?>
    

<div class="text-left form-group row">
<br>
<div class="row"></div>
<form action="lista.php" method="post" accept-charset="utf-8"> 
  <div class="row"></div>

  <div class="row  ">
    <label class="col-sm-1 pb-2 col-form-label col-form-label-lg">Inicio</label>
      <div class="col-sm-2">
      <input class="form-control text-uppercase"  required type="date" id="cad" name="cad">
      </div>
    <label class="col-sm-1 pb-2 col-form-label col-form-label-lg">Fim</label>
      <div class="col-sm-2">
      <input class="form-control text-uppercase"  required type="date" id="cad2" name="cad2">
      </div>
      <label class="col-sm-1 pb-2 col-form-label col-form-label-lg">Cargo </label>
      <div class="col-sm-2"><select class="form-select"  id="validationServer01"  name="cargo" aria-label="Default select example"  required>
      
   <!---- <option selected>Selecione uma opção</option> -->
        <option value="Motorista">Motorista</option>
        <option value="Cobrador">Cobrador</option>
        <option value="Manutenção de ônibus">Manutenção de ônibus</option>
        <option selected value="Administrativo">Administrativo</option>
        </select></div>

    <label class="col-sm-1 col-form-label col-form-label-lg">Empresa  </label>
          <div class="col-sm">
        <select class="form-select" id="validationServer01"  name="empresa" aria-label="Default select example"  required>
       <!---- <option selected>Selecione uma opção</option> -->
            <option selected  value="Integra Plataforma">Integra Plataforma </option>
            <option value="Expresso Metropolitano">Expresso Metropolitano</option>
            <option value="Litoral Norte">Litoral Norte </option>
            </select>
      </div>
  </div>
  <div class="row">
  <label class="col-sm-1 pb-2 col-form-label col-form-label-lg">Nome </label>
      <div class="col-sm-5">
      <input class="form-control text-uppercase" type="text" id="nome" placeholder="Digite o nome do candidato" name="nome">
      </div>
      <label class="col-sm-2 pb-2 col-form-label col-form-label-lg">Qtd de exibição por Pagina</label>
      <div class="col-sm-1">
      <input class="form-control text-uppercase" type="number" id="exibir" value="1" min="1" max="5000" placeholder="Digite o nome do candidato" name="exibir">
      </div>
  </div>
</div>
<input type="submit" id="" name="" value="Buscar">
</form>
</div>
  </body>
</html>
