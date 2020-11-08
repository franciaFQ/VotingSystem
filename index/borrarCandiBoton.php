<?php
    if(!$veri){
        header('location:logout.php');
    }
?>
<!-- Delete -->
    <div class="modal fade" id="del<?php echo $candi['carnet']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Eliminar Candidato</h4></center>
                </div>
                <div class="modal-body">	
				<div class="container-fluid">
					<h5><center>Estudiante: <strong><?php echo $candi['nombre']; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancelar</button>
                    <form method="POST" action="borrarCandiAcciones.php" id="del<?php echo $candi['carnet']; ?>">
                        <input type="hidden" name="idDCand" id="idDCand" value="<?php echo $candi['carnet'] ?>">
                        <input type="hidden" name="accCand" id="accCand" value="del">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- /.modal -->