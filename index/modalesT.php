<?php
    if (!$veri) {
        header("location: logout.php");
    }
?>

<!-- Delete -->
    <div class="modal fade" id="del<?php echo $carnet; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar Teacher</h4></center>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center>Teacher: <strong><?php echo $user['nombre']; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <form method="POST" action="./procesos/eliminarteacher.php" id="del<?php echo $carnet; ?>">
                        <input type="hidden" name="idD" id="idD" value="<?php echo $carnet ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->


<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $carnet; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar teacher</h4></center>
                </div>
                <div class="modal-body">
					
					<div class="container-fluid">
						<form action="./procesos/modificarteacher.php" method="POST"  id="edit<?php echo $carnet; ?>">
                            
                            <div class="form-group label-floating">
                                <label class="control-label" for="namee">Nombre: </label>
                                <input class="form-control" name="namee" id="namee" type="text" value="<?php echo $user['nombre']; ?>" required="true" >
                            </div>
                            <div style="height:10px;"></div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="contrae">Contraseña: </label>
                                <input class="form-control" name="contrae" id="contrae" type="text" value="<?php echo $user['contrasena']; ?>" required="true" >
                            </div>
                            
                            <input type="hidden" name="carnete" id="carnete" value="<?php echo $carnet; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <button type="submit" class="btn btn-warning"> Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->