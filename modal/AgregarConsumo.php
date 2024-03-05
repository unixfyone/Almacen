<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Adicionar Consumo</b></font>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
				<div class="container-fluid">
					<form method="" action="">
					<Input Type="hidden" name="cia_cons" id="cia_cons" value="<?Php echo $CIA ?>">
					<Input Type="hidden" name="zone_cons" id="zone_cons" value="<?Php echo $ZON ?>">	
					<label>Nombre del Consumo</label>
					<input type="text" name="name_cons" id="name_cons" maxlength="45" class="form-control" required />
				</div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
				
				<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" formaction="action/AgregarNuevoConsumo.php" formmethod="post" type="submit" id="agregar" name="agregar"><span class="fa fa-save"></span> Grabar Cambios</button>				
				</form>
            </div>
        </div>
    </div>
</div>