<?php
    if(!$veri){
        header('location:logout.php');
    }
?>

<!-- Delete -->
    <div class="modal fade" id="del<?php echo $code; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar Estudiante</h4></center>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center>Estudiante: <strong><?php echo $nameC; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <form method="POST" action="actions.php" id="del<?php echo $code; ?>">
                        <input type="hidden" name="idD" id="idD" value="<?php echo $code ?>">
                        <input type="hidden" name="acc" id="acc" value="del">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->


<!-- Edit -->
    <div class="modal fade" id="edit<?php echo $code; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Editar estudiante</h4></center>
                </div>
                <div class="modal-body">
					
					<div class="container-fluid">
						<form action="actions.php" method="POST"  id="edit<?php echo $code; ?>">
                            
                            <div class="form-group label-floating">
                                <label class="control-label" for="namee">Nombre: </label>
                                <input class="form-control" name="namee" id="namee" type="text" value="<?php echo $nameC; ?>" required="true" >
                            </div>
                            <div style="height:10px;"></div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="estadoe">Estado: </label>
                                <input class="form-control" name="estadoe" id="estadoe" type="text" value="<?php echo $user['estado']; ?>" required="true" >
                            </div>
                            <div style="height:10px;"></div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="turnoe">Turno: </label>
                                <input class="form-control" name="turnoe" id="turnoe" type="text" value="<?php echo $user['turno']; ?>" required="true" >
                            </div>
                            
                            <input type="hidden" name="acc" id="acc" value="edit">
                            <input type="hidden" name="idE" id="idE" value="<?php echo $code; ?>">
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