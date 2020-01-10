<?php
$path = "xml/ENTRADAS";
$diretorio = dir($path);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <style>
        body{
            background-color:#e4e4e4!important;
        }
    #infoxml{
        font-size:12px;

    }
    
    #ulxml{
    list-style: none;
    }
    </style>
</head>
<body>
<div class="row d-flex flex-column-reverse ">
    <div class="container col-12 ">
    <a href="entrada.php"><button type="button" class="btn btn-outline-primary">Entrada</button></a>
    <a href="conhecimento.php"><button type="button" class="btn btn-outline-secondary">CTE Transportes</button></a>
    <a href="saida.php"><button type="button" class="btn btn-outline-success">Saida</button></a>
        <div class="container mt-4" id="listagem"></div>
    </div>
    <div class="col-12 d-flex justify-content-start m-3 ">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Selecione o xml que deseja exibir informações</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <?php while($arquivo = $diretorio -> read()){  
            echo "<option id='namexml'>". $arquivo  ."</option>";
            }
            $diretorio -> close();
            ?>
        </div>
        </div>
       
</div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
    <script>
       var peganomexml = document.querySelector("#exampleFormControlSelect1");
        peganomexml.addEventListener("change", function(){
           
            var xmldir = "xml/ENTRADAS/";
        var namexml = (peganomexml.value) ;   
        var arquivoxml  = xmldir+namexml;
        console.log(arquivoxml);

         $.ajax({
            url: arquivoxml
            //url: 'Gamma237664.xml'
            //url: '13191007293118000102550030001133741002335590.xml'
        }).then(sucesso, falha);

        function sucesso(arquivo) {
           // console.log($(arquivo).find('prod').find('cEAN').text());

            var elemento;
            elemento = "<ul id='ulxml'>";
            $(arquivo).find('prod').each(function() {
                var produto = $(this).find('xProd').text();
                var cfop = $(this).find('CFOP').text();
                var ean = $(this).find('cEAN').text();
                elemento += "<li id='infoxml'>"+ "<b>PRODUTO: </b> " + produto +"<br><b>EAN: </b>"+ ean + "<br><b>CFOP: </b>"+ cfop + "</li><br><br>";
            });
            elemento += "</ul>";
            $('#listagem').html(elemento);
        }
        function falha() {

        }        
             });
    </script>
</body>

</html>