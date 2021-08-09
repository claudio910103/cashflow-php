<?php
    header('Content-Type: application/json');   
    include("conexion.php");
    $estatusJson = "Error tipo de consulta no encontrada";
    $array1 = array();
    $tipo = $_GET['tipo'];

    if($tipo==1) {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $idcategoria = $data['idCategoria'];
        $clasificacion = $data['clasificacion'];
        $categoria = $data['categoria'];
        $subcategoria = $data['subcategoria'];

        if(isset($idcategoria) and isset($clasificacion) and isset($categoria) and isset($subcategoria)){
            $sql = "UPDATE categoria SET clasificacion='$clasificacion',categoria='$categoria',subCategoria='$subcategoria' 
            WHERE idCategoria='$idcategoria'";
            $resultado = mysqli_query($db, $sql);
            if($resultado==true){
                $estatusJson = "OK Se actualizo";
            }else{
                $estatusJson = "No se pudo actualizar";
            }
        }

    }
    if($tipo==2) {
        $estatusJson = "OK";
        $sql = "SELECT * FROM categoria";
        $resultado = mysqli_query($db, $sql);
        while($datos=mysqli_fetch_array($resultado)){
            extract($datos);
            $array1[] = array(
                "id"=> $idCategoria,
                "clasificacion"=> $clasificacion,
                "categoria"=> $categoria,
                "subCategoria"=> $subCategoria,
            );
        }
    }
    if($tipo==3) {
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $idcategoria = $data['idCategoria'];
        $sql = "SELECT * FROM categoria WHERE idCategoria='$idcategoria'";
        $resultado = mysqli_query($db, $sql);
        $countResultado = mysqli_num_rows($resultado);
        if($countResultado > 0){
            $estatusJson = "OK";
            $datosconsulta = $resultado->fetch_assoc();
            $array1 = array(
                "id"=> $idcategoria,
                "clasificacion" => $datosconsulta['clasificacion'],
                "categoria" => $datosconsulta['categoria'],
                "subCategoria" => $datosconsulta['subCategoria'],
            );
        }
    }
    if($tipo==4){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        $clasificacion = $data['clasificacion'];
        $categoria = $data['categoria'];
        $subcategoria = $data['subcategoria'];
        $sql = "INSERT INTO categoria (idCategoria,clasificacion,categoria,subcategoria) VALUES (UUID(),'$clasificacion','$categoria','$subcategoria')";
        $resultado = mysqli_query($db,$sql);
      
        if ($resultado == true) {
            $estatusJson = "OK Se creo";
        }else{
            $estatusJson = "No se pudo insertar";
        }
    }
    if ($tipo==5) {
      $id = $_POST['id'];
      $sql = "DELETE FROM categoria where idCategoria='$id'";
      $resultado= mysqli_query($db, $sql);
      if ($resultado==true) {
        $estatusJson = "OK Se elimino";
      }else{
        $estatusJson = "No se pudo eliminar";
      }
    }

    $array2 = array(
        "estatus" => $estatusJson,
        "datos" => $array1,
    );
    echo json_encode($array2);
    mysqli_close($db);
?>