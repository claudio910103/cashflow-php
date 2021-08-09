<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Cashflow</title>
</head>

<body>
    <header class="header-div div-flex">
        <h3><i class="fas fa-money-check-alt"></i> CASHFLOW</h3>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-12 centrado">
                <i class="fas fa-plus-square btn-agregar" onclick="mostrarModal2()"></i>
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
                                <input type="text" id="categoria" class="form-control" placeholder="Escribir nueva categoria">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="myModal1" onclick="cerrarModal()">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="cambiarValor()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal" id="myModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Nueva Categoria</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="clasificacion">Clasificacion:</label>
                                <input type="text" id="clasificacion2" class="form-control" placeholder="Escribir nueva clasificacion">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="categoria">Categoria:</label>
                                <input type="text" id="categoria2" class="form-control" placeholder="Escribir nueva categoria">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="subcategoria">Subcategoria:</label>
                                <input type="text" id="subcategoria2" class="form-control" placeholder="Escribir nueva subcategoria">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="myModal2" onclick="cerrarModal2()">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="button-modal-2" onclick="addCategory()">Insertar</button>
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

    function mostrarModal(idcat) {
        $('#idCategoria').val(idcat);
        $('#clasificacion').val('');
        $('#categoria').val('');
        $('#subcategoria').val('');
        consultaCategoria(idcat);
        $('#myModal1').modal('show');
    }

    function mostrarModal2() {
        $('#myModal2').modal('show');
    }

    function cerrarModal2() {
        $('#myModal2').modal('hide');
    }

    function cerrarModal() {
        $('#myModal1').modal('hide');
    }

    function cambiarValor() {

        let idcat = $('#idCategoria').val();
        let clasificacion = $('#clasificacion').val();
        let cat = $('#categoria').val();
        let subcat = $('#subcategoria').val();
        let json = {
            idCategoria: idcat,
            clasificacion: clasificacion,
            categoria: cat,
            subcategoria: subcat,
        };
        $.ajax({
            url: 'arhivoAjax.php?tipo=1',
            type: 'post',
            data: JSON.stringify(json),
            success: function(respuesta) {
                // console.log(respuesta);
                if (respuesta.estatus.includes('OK')) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se actualizo correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    consultarTabla();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: respuesta.estatus,
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
        plantillaHTML += "  <td colspan='4'><div class='div-loading'><div class='loading'></div></div></td>";
        plantillaHTML += "</tr>";
        $('#tabla1').html(plantillaHTML);
    }

    function consultarTabla() {
        loadingTabla();
        $.ajax({
            url: 'arhivoAjax.php?tipo=2',
            type: 'get',
            success: function(respuesta) {
                // console.log(respuesta);
                let plantillaHTML = "";
                if (respuesta.estatus.includes('OK')) {
                    for (let i = 0; i < respuesta.datos.length; i++) {
                        const registro = respuesta.datos[i];
                        plantillaHTML += "<tr>";
                        plantillaHTML += "  <td class='centrado'> " + registro.clasificacion + "</td>";
                        plantillaHTML += "  <td class='centrado'> " + registro.categoria + "</td>";
                        plantillaHTML += "  <td class='centrado'> " + registro.subCategoria + "</td>";
                        plantillaHTML += "  <td class='centrado'>";
                        plantillaHTML += "      <button class='btn btn-primary btn-sm' onclick=\mostrarModal('" + registro.id + "')\><i class='fas fa-edit'></i></button>";
                        plantillaHTML += "      <button class='btn btn-danger btn-sm' onclick=\confirmarEliminar('" + registro.id + "')\><i class='fas fa-trash-alt'></i></button>";
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

    function consultaCategoria(id) {

        let json = {
            idCategoria: id,
        };
        $.ajax({
            url: 'arhivoAjax.php?tipo=3',
            type: 'post',
            data: JSON.stringify(json),
            success: function(respuesta) {
                console.log(respuesta);
                if (respuesta.estatus.includes('OK')) {
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

    function addCategory() {

        $("#button-modal-2").hide();
        let clasificacion = $('#clasificacion2').val();
        let categoria = $('#categoria2').val();
        let subcategoria = $('#subcategoria2').val();

        let json = {
            clasificacion: clasificacion,
            categoria: categoria,
            subcategoria: subcategoria
        }
        $.ajax({
            url: 'arhivoAjax.php?tipo=4',
            type: 'POST',
            data: JSON.stringify(json),
            success: function(response) {
                if (response.estatus.includes("OK")) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se agrego correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    consultarTabla();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: response.estatus,
                        showConfirmButton: false,
                    });
                }
                $("#button-modal-2").show();
                setTimeout(() => {
                    $('#myModal2').modal('hide');
                }, 3000);
                $('#clasificacion2').val('');
                $('#categoria2').val('');
                $('#subcategoria2').val('');
            },
            error: function(error) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: error,
                    showConfirmButton: false,
                });
            }

        })
    }

    function eliminaRegistro(id) {

        $.ajax({
            url: 'arhivoAjax.php?tipo=5',
            type: 'POST',
            data: {
                id: id
            },
            success: (response) => {
                if (response.estatus.includes("OK")) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se elimino correctamente',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    consultarTabla();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: response.estatus,
                        showConfirmButton: false,
                    });
                }
            },
            error: (error) => Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: error,
                showConfirmButton: false,
            })
        })
    }

    function confirmarEliminar(id) {
        Swal.fire({
            title: 'Seguro que quieres eliminar?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: `SI`,
            cancelButtonText: `NO`,
            icon: 'warning',
        }).then((result) => {
            if (result.isConfirmed) {
                eliminaRegistro(id);
            }
        });
    }
</script>