<?php

//session_start();
include_once './conexao.php';

// ...
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();


}else{
  $cad = $_SESSION['cad'];
$cad2 = $_SESSION['cad2'];
$name = $_SESSION['nome'];
$cod_func = $_SESSION['cargo'];
$cod_empresa = $_SESSION['empresa'];
$limite_resultado = $_SESSION['exibir'];
}




//<form action="" method="post" accept-charset="utf-8">        
//    <input class="form-control text-uppercase" type="date" id="cad" required name="cad">

//    <input type="submit" id="cad1" name="" value="Envia">
//</form>


//$cad = "<script>document.write(elton);</script>";

//echo "<script>document.write(elton); </script>";

//echo $teste;

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
    <link rel="stylesheet" href="print.css" media="print">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/5a155b8c61.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://kit.fontawesome.com/5a155b8c61.css" crossorigin="anonymous">
<script type="text/javascript">
    $("#telefone, #telefone2").mask("(00)00000-0000");
    </script>
<script> document.getElementById('cad').style.display = 'none';
         document.getElementById('cad1').style.display = 'none';

 </script>
 <script> 
  jQuery(window).load(function () {
      $(".loader").delay().fadeOut("slow"); //retire o delay quando for copiar!
    $("#tudo_page").toggle("fast");
});
</script>

 


  </head>

  <body>
<?php

//$cad = addslashes($_POST['cad']);
  //$cad2 = addslashes($_POST['cad2']);
 // $name = addslashes($_POST['nome']);
  //$cod_func = addslashes($_POST['cargo']);
  //$cod_empresa = addslashes($_POST['empresa']);

  if(addslashes($_POST['cad'])!= null and addslashes($_POST['cad'])!= '' and addslashes($_POST['cad2']) != null and addslashes($_POST['cad2']) != ''){
    $_SESSION['cad'] = addslashes($_POST['cad']);
    $_SESSION['cad2'] = addslashes($_POST['cad2']);
    $_SESSION['cargo'] = addslashes($_POST['cargo']);
    $_SESSION['nome'] = addslashes($_POST['nome']);
    $_SESSION['empresa'] = addslashes($_POST['empresa']);
    $_SESSION['exibir'] = addslashes($_POST['exibir']);

  };

  
 


$cad = $_SESSION['cad'];
$cad2 = $_SESSION['cad2'];
$name = $_SESSION['nome'];
$cod_func = $_SESSION['cargo'];
$cod_empresa = $_SESSION['empresa'];
$limite_resultado = $_SESSION['exibir'];
//echo  $cad;
//echo  $cad2;
//echo  $name;
//echo  $cod_func;


 if($cad != null and $cad != '' and $cad2 != null and $cad2 != '' or $name != null and $name != ''){
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        
        
        //Receber o número da página
        $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
        $pag_count = $pagina;
        //var_dump($pagina);

        //Setar a quantidade de registros por página
        

        // Calcular o inicio da visualização
        $inicio = ($limite_resultado * $pagina) - $limite_resultado;

        //Contar a quantidade de registros no BD
$query_qnt_registros = "SELECT COUNT(cad_id) AS num_result FROM cad_cv where cad_dt_cadastro >= '$cad 00:00:00' and  cad_dt_cadastro <= '$cad2 23:59:59' and cad_cargo like '$cod_func%' and cad_empresa = '$cod_empresa' and cad_nome like '%$name%'";
$result_qnt_registros = $conn->prepare($query_qnt_registros);
$result_qnt_registros->execute();
$row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);
$total_pag = $row_qnt_registros['num_result'] ;
//Quantidade de página
$qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

// Maximo de link
$maximo_link = 1;


        $query_usuarios = "SELECT cad_id,cad_nome,cad_email,cad_nascimento,cad_estado,cad_cidade,cad_bairro,cad_cep,cad_endereco,cad_telefone,cad_telefone2,cad_cargo,cad_cnh,cad_curso,cad_validade,cad_pcd,cad_ds_pcd,cad_indicacao,cad_ds_indicacao,cad_escolaridade,cad_ex_func,cad_dt_cadastro,cad_ds_historia,cad_empresa,cad_instituicao
        FROM vagas.cad_cv where cad_dt_cadastro >= '$cad 00:00:00' and  cad_dt_cadastro <= '$cad2 23:59:59' and cad_cargo like '$cod_func%' and cad_empresa = '$cod_empresa' and cad_nome like '%$name%'  ORDER BY cad_id DESC LIMIT $inicio, $limite_resultado";

       // echo $query_usuarios;
        try {

          $result_usuarios = $conn->prepare($query_usuarios);
          $result_usuarios->execute();
  
          } catch (PDOexception $error_sql){
  
                  echo 'Erro ao retornar os Dados.'.$error_sql->getMessage();
  
  }
        
        if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
          while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
              //var_dump($row_usuario);
              
              extract($row_usuario);
              $id = $row_usuario['cad_id'];
              $nome = $row_usuario['cad_nome'];
              $email = $row_usuario['cad_email'];
              $email = str_replace('<br />', "\n", $email);
              $nascimento = $row_usuario['cad_nascimento'];
              $estado = $row_usuario['cad_estado'];
              $cidade = $row_usuario['cad_cidade'];
              $bairro = $row_usuario['cad_bairro'];
              $cep = $row_usuario['cad_cep'];
              $endereco = $row_usuario['cad_endereco'];
              $telefone = $row_usuario['cad_telefone'];
              $telefone2 = $row_usuario['cad_telefone2'];
              $date = $row_usuario['atual'];
              $cargo = $row_usuario['cad_cargo'];
              $cnh = $row_usuario['cad_cnh'];
              $curso = $row_usuario['cad_curso'];
              $validade = $row_usuario['cad_validade'];
              if($row_usuario['cad_pcd'] = 'NAO' ){
                $pcd = 'NÃO';
              }else{
                $pcd = 'SIM';
              };
              $ds_pcd = $row_usuario['cad_ds_pcd'];
              if($row_usuario['cad_indicacao'] = 'NAO'){
                $indicacao = 'NÃO';
              }else{
                $indicacao = 'SIM';
              };
              $ds_indicacao = $row_usuario['cad_ds_indicacao'];
              $escolaridade = $row_usuario['cad_escolaridade'];
              $ex_func = $row_usuario['cad_ex_func'];
              $historia = $row_usuario['cad_ds_historia'];
              $empresa = $row_usuario['cad_empresa'];
              $instituicao = $row_usuario['cad_instituicao'];
              

              $nome_final = $id.'.pdf';
              $_UP['pasta'] = 'trabalhe-conosco/upload/';
              $caminho = $_UP['pasta'] . $nome_final;

              $estados = [           
                       "AC"=>"Acre",
                       "AL"=>"Alagoas",
                       "AP"=>"Amapá",
                       "AM"=>"Amazonas",
                       "BA"=>"Bahia",
                       "CE"=>"Ceará",
                       "DF"=>"Distrito Federal",
                       "ES"=>"Espírito Santo",
                       "GO"=>"Goiás",
                       "MA"=>"Maranhão",
                       "MT"=>"Mato Grosso",
                       "MS"=>"Mato Grosso do Sul",
                       "MG"=>"Minas Gerais",
                       "PA"=>"Pará",
                       "PB"=>"Paraíba",
                       "PR"=>"Paraná",
                       "PE"=>"Pernambuco",
                       "PI"=>"Piauí",
                       "RJ"=>"Rio de Janeiro",
                       "RN"=>"Rio Grande do Norte",
                       "RS"=>"Rio Grande do Sul",
                       "RO"=>"Rondônia",
                       "RR"=>"Roraima",
                       "SC"=>"Santa Catarina",
                       "SP"=>"São Paulo",
                       "SE"=>"Sergipe",
                       "TO"=>"Tocantins"];


                  $estado = $estados[$estado];








?>

<header class="cabecalho "> <h5 class="text-center"> <img src="img/logo.png"> 
</h5> 
</header>

<div class="container-fluid">
<div class="row">
              <div class="text-center">
     <h3><?php
echo"<p class='contador'>Pag: $pag_count/$total_pag
     </p>"
     ;
    $pag_count ++;
     $date = date('Y-m-d');
      $diff = $nascimento - $date;
      echo strtoupper($nome .'  '.$diff.' Anos' ); ?></label>
       <div class="justify-content-md-end">
      <a  class='button' href='<?php echo 'http://10.6.10.36/'.$caminho;?>' target='_blank'>CNIS</a>

    </div></h3>
</div>
<table class="table">
<thead>
  <tr>
    <th  class="titulo" id="titulo" scope="col">Dados Pessoais</th>

  </tr>
</thead>
</table>
<div class="row">
  <label class="col-sm-2 fs-6   pb-2 col-form-label col-form-label-lg">Email</label>
    <div class="col-sm ">
    <textarea id="endereco" class="endereco text-uppercase" disabled name=""
        rows="1" cols="81"> <?php echo $email?>
  </textarea>
    </div>

  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Estado</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="estado" value="<?php echo $estado?>" type="text" pattern="([aA-zZ ]+)" >
    </div>
</div>
<div class="row ">
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Cidade</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="cidade" value="<?php echo $cidade?>" type="text" pattern="([aA-zZ ]+)" > 
    </div>
  <label class="col-sm-2  fs-6  pb-2 col-form-label col-form-label-lg">Bairro</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="bairro" value="<?php echo $bairro?>" type="text" pattern="([aA-zZ ]+)" > 
    </div>
</div>
<div class="row">
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">CEP</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="cep" value="<?php echo $cep?>" type="text"  >
    </div>
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Endereço</label>
    <div class="col-sm">
    <textarea id="endereco" class="endereco text-uppercase" disabled name=""
        rows="1" cols="56"> <?php echo $endereco?>
  </textarea>
    </div>
</div>
<div class="row">
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Celular</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone" value="<?php echo $telefone?>" type="text"   >
    </div>
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Celular 2</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $telefone2?>" type="text"  >
    </div>
</div>
<div class="row">
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Escolaridade</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase " id="telefone" name="telefone2" value="<?php echo $escolaridade?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Instituição</label> 
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  id="telefone2" name="telefone2" value="<?php echo $instituicao?>" type="text"  >
    </div>
</div>
  <table class="table">
<tbody>
<tr>
    <th scope="col"></th>
  </tr>
  <tr>
    <th class="titulo" id="titulo" scope="col">Dados para o Cargo </th>

  </tr>
</tbody>
</table>
<div class="row">
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Empresa</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $empresa?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Cargo</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="bairro" value="<?php echo $cargo?>" type="text" pattern="([aA-zZ ]+)" > 
    </div>
</div>
<div class="row">

  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">CNH</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="cep" value="<?php echo $cnh?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">NU. CONTRAN</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="endereco" value="<?php echo $curso?>" type="text"   >
    </div>
</div>
<div class="row">
  
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Validade CNH</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone" value="<?php echo (new \DateTimeImmutable($validade))->format('d/m/Y');?>"   >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">PCD</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $pcd?>" type="text"  >
    </div>
</div>
<div class="row">
  
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Descrição PCD</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $ds_pcd?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Indicação</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $indicacao?>" type="text"  >
    </div>

</div>
<div class="row">
 
  <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Quem Indicou</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $ds_indicacao?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Matricula Ant.</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $ex_func?>" type="text"  >
    </div>
</div>
<div class="row col ">

    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg"></label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase " hidden  name="telefone2" value="" type="text"  >
    </div>
    </div>
    <br>

    <?php  

$id_cad = $id;
$contador = 1;
$query_usuarios2 = "SELECT cad_cv_id,cad_cd_nome_empresa,cad_dt_admissao,cad_dt_demissao,cad_cargo_ant,cad_motivo_demissao  from cad_emp ce  where cad_cv_id  = $id_cad  ORDER BY cad_cv_id DESC LIMIT 5";
$result_usuarios2 = $conn->prepare($query_usuarios2);
$result_usuarios2->execute();
if (($result_usuarios2) AND ($result_usuarios2->rowCount() != 0)) {
  ?>   <table class="table">
  <thead>
  <tr>
      <th scope="col"></th>
    </tr>
    <tr>
      <th class="titulo" id="titulo" scope="col">Experiência na Carteira</th>

    </tr>
  </thead>
</table> <?php
  while ($row_usuario2 = $result_usuarios2->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuario2);
    $emp = $row_usuario2['cad_cd_nome_empresa'];
    $dt_admissao = $row_usuario2['cad_dt_admissao'];
    $dt_demissao = $row_usuario2['cad_dt_demissao'];
    $cad_cargo = $row_usuario2['cad_cargo_ant'];
    $motivo = $row_usuario2['cad_motivo_demissao'];
    $nome_emp = '* Empresa '.$contador;
    //$diff_emp = $dt_demissao - $dt_admissao;
    $tempo = abs(strtotime($dt_demissao) - strtotime($dt_admissao));
    $years = floor($tempo / (365*60*60*24));
    $months = floor(($tempo - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($tempo - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24)); 
    if($years > 0){
      $diff_emp = $years.' Anos';
    }elseif($months >0){
      $diff_emp = $months .' Meses';
    }else{
      $diff_emp = $days. ' Dias';
    };

    ?>

   <div class="row">
   <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg"><?php echo $nome_emp?></label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $emp .'  -  '.$diff_emp;?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Função</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo $cad_cargo?>" type="text"  >
    </div>
    </div>
    <div class="row">
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Admissão</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo (new \DateTimeImmutable($dt_admissao))->format('d/m/Y');?>" type="text"  >
    </div>
    <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Demissão</label>
    <div class="col-sm">
    <input disabled class="form-control form-control-sm text-uppercase "  name="telefone2" value="<?php echo (new \DateTimeImmutable($dt_demissao))->format('d/m/Y');?>" type="text"  >
    </div>


   </div>

    <?php
    $contador ++;
  }
  
}else{

}
?>

    <div class="row"> 
      <label class="col-sm-2 fs-6  pb-2 col-form-label col-form-label-lg">Objetivo</label>
    <div class="col-sm">
    <textarea id="objetivo" class="objetivo" disabled name=""
        rows="5" cols="auto"> <?php echo $historia ?>
  </textarea> </div>
</div>


</div>
</div>
<footer> 
</footer>
</body>



</html>
<?php



}


echo"
<link rel='1stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
<a href='index.php' class='controle' style='position:absolute;width:40px;height:40px;bottom:60px;top:10px;color:#FFF;border-radius:50px;text-align:center;font-size:30px;
  z-index:1000;'>
  <i'>🏠</i>
</a>";


//echo "<a href='lista.php?page=1'>Primeira</a> ";

for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
    if ($pagina_anterior >= 1) {
        //echo "<a href='lista.php?page=$pagina_anterior'>$pagina_anterior</a> ";
        echo"
        <link rel='1stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
        <a href='lista.php?page=$pagina_anterior' class='controle' style='position:fixed;width:60px;height:38px;bottom:60px;top:100px;left:40px;color:#000000;border-radius:20%;text-align:center;font-size:30px;
          z-index:1000;' >
          <i class='fa-solid fa-left'>←</i>
        </a>";
    }
}

//echo "$pagina ";

for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
    if ($proxima_pagina <= $qnt_pagina) {
       // echo "<a href='lista.php?page=$proxima_pagina'>$proxima_pagina</a> ";
        echo"<link rel='stylesheet' href='https://kit.fontawesome.com/5a155b8c61.css' crossorigin='anonymous'>
<a href='lista.php?page=$proxima_pagina' class='controle' style='position:fixed;width:60px;height:38px;bottom:60px;top:100px;right:40px;color:#000000;border-radius:20%;text-align:center;font-size:30px;
  z-index:1000;'>
  <i class='fa-solid fa-right'>→</i>
</a>";
    }
}

//echo "<a href='lista.php?page=$qnt_pagina'>Última</a> ";
} else {
  echo"
  <link rel='1stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
  <a href='index.php' class='controle' style='position:absolute;width:40px;height:40px;bottom:60px;top:10px;color:#FFF;border-radius:50px;text-align:center;font-size:30px;
    z-index:1000;'>
    <i'>🏠</i>
  </a>";
  



setcookie('msg', "Erro: Nenhum usuário encontrado! Verifique os dados que foram inseridos", time() + (1), "/"); // 86400 = 1 day
header("Location:index.php");

}

 }else {setcookie('msg', "Erro: Sessão Expirada ", time() + (1), "/"); // 86400 = 1 day
 header("Location:index.php");}

?>

