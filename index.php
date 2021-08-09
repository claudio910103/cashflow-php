
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Cashflow</title>
</head>
<body>
    <style>
        header {
            margin-bottom: 2rem;
        }
        th {
            color: #FFFFFF;
        }

        .btn-agregar:before {
            width: 2.5rem;
            background-color: #0277bd;
            padding: 0.8rem;
            border-radius: 50%;
        }
        .btn-agregar {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
            cursor: pointer;
        }
        .btn-agregar:hover {
            color: #e1f5fe;
        }
        
        .header-div {
            padding: 1rem;
            background-color: #ef6c00;
            color: #fff;
        }
        .centrado {
            text-align: center;
        }

        .tablascroll {
            height: 70vh;
            overflow-y: scroll;
        }

        @media (min-width: 300px) {
            .div-flex h3 {
                font-size: 1rem;
            }
            .div-flex {
                display: flex;
                justify-content: center;
            }
        }
        @media (min-width: 400px) {
            .div-flex h3 {
                font-size: 1.1rem;
            }
        }
        @media (min-width: 700px) {
            .div-flex h3 {
                font-size: 1.4rem;
            }
            .div-flex {
                justify-content: start;
            }
        }
        @media (min-width: 1200) {
            .div-flex h3 {
                font-size: 1.6rem;
            }
        }
    </style>

    <header class="header-div div-flex">
        <h3><i class="fas fa-money-check-alt"></i> CASHFLOW</h3>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-12 centrado">
                <i class="fas fa-plus-square btn-agregar"></i>
            </div>
            <div class="col-12 tablascroll">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="bg-danger">
                            <th class="centrado" scope="col">Clasificacion</th>
                            <th class="centrado" scope="col">Categoria</th>
                            <th class="centrado" scope="col">Subcategoria</th>
                            <th class="centrado" scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla1">   
                        <!-- Se llena por ajax -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <!-- MODALES -->
    <div class="modal" id="myModal1" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ACTUALIZAR</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="clasificacion">Clasificacion:</label>
                            <input type="text" id="clasificacion" class="form-control" placeholder="Escribir nueva clasificacion">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="categoria">Categoria:</label>
                            <input type="text" id="categoria" class="form-control"placeholder="Escribir nueva categoria">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="subcategoria">Subcategoria:</label>
                            <input type="text" id="subcategoria" class="form-control" placeholder="Escribir nueva subcategoria">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="idCategoria">
                <button type="button" class="btn btn-secondary" data-dismiss="myModal1"onclick="cerrarModal()">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="cambiarValor()">Actualizar</button>
            </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<script>
    consultarTabla();

    function mostrarModal(idcat){
        $('#idCategoria').val(idcat);
        $('#clasificacion').val('');
        $('#categoria').val('');
        $('#subcategoria').val('');
        consultaCategoria(idcat);
        $('#myModal1').modal('show');
    }

    function cerrarModal(){
        $('#myModal1').modal('hide');
    }

    function cambiarValor(){

        let idcat = $('#idCategoria').val();
        let clasificacion = $('#clasificacion').val();
        let cat = $('#categoria').val();
        let subcat = $('#subcategoria').val();
        let json = {
            idCategoria : idcat,
            clasificacion : clasificacion,
            categoria : cat,
            subcategoria : subcat,
        };
        $.ajax({
                url: 'arhivoAjax.php?tipo=1',
                type: 'post',
                data: JSON.stringify(json),
                success: function (respuesta) {
                    // console.log(respuesta);
                    if(respuesta.estatus.includes('OK')){
                        Swal.fire({
                            icon: 'success',
                            title: 'Se actualizo correctamente',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        consultarTabla();
                    }else{
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: respuesta,
                            showConfirmButton: false,
                        });
                    }
                    $('#myModal1').modal('hide');
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error,
                        showConfirmButton: false,
                    });
                }
        });
    }

    function loadingTabla() {
        let plantillaHTML = "";
        plantillaHTML += "<tr>";
        plantillaHTML += "  <td style='text-align: center' colspan='4'><i class='fab fa-bitcoin fa-spin' style='color: #ef6c00; font-size: 2rem;'></i></td>";
        plantillaHTML += "</tr>";
        $('#tabla1').html(plantillaHTML);
    }

    function consultarTabla(){
        loadingTabla();
        $.ajax({
                url: 'arhivoAjax.php?tipo=2',
                type: 'get',
                success: function (respuesta) {
                    // console.log(respuesta);
                    let plantillaHTML = "";
                    if(respuesta.estatus.includes('OK')){
                        for (let i = 0; i < respuesta.datos.length; i++) {
                            const registro = respuesta.datos[i];
                            plantillaHTML += "<tr>";
                            plantillaHTML += "  <td class='centrado'> " +registro.clasificacion +"</td>";
                            plantillaHTML += "  <td class='centrado'> " +registro.categoria+"</td>";
                            plantillaHTML += "  <td class='centrado'> " +registro.subCategoria+"</td>";
                            plantillaHTML += "  <td class='centrado'>";
                            plantillaHTML += "      <button class='btn btn-primary btn-sm' onclick=\mostrarModal('" + registro.id + "')\><i class='fas fa-edit'></i></button>";
                            plantillaHTML += "      <button class='btn btn-danger btn-sm' onclick=\eliminaRegistro('" + registro.id + "')\><i class='fas fa-trash-alt'></i></button>";
                            plantillaHTML += "  </td>";
                            plantillaHTML += "</tr>";
                        }
                    }
                    $('#tabla1').html(plantillaHTML);
                    
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error,
                        showConfirmButton: false,
                    });
                }
        });
    }

    function consultaCategoria(id){

        let json = {
            idCategoria : id,
        };
        $.ajax({
                url: 'arhivoAjax.php?tipo=3',
                type: 'post',
                data: JSON.stringify(json),
                success: function (respuesta) {
                    console.log(respuesta);
                    if(respuesta.estatus.includes('OK')){
                        $('#clasificacion').val(respuesta.datos.clasificacion);
                        $('#categoria').val(respuesta.datos.categoria);
                        $('#subcategoria').val(respuesta.datos.subCategoria);
                    }
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: error,
                        showConfirmButton: false,
                    });
                }
        });
    }
</script>