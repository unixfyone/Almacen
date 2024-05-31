<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $Fila2['id_cons']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Consumo</b></font>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="" action="">
					<div class="row">
						<Input Type="hidden" name="id" value="<?Php echo $Fila2['id_cons'] ?>">
						<Input Type="hidden" name="cia_cons" value="<?Php echo $cia_cons ?>">
						<Input Type="hidden" name="zone_cons" value="<?Php echo $zone_cons ?>">
    					<label>Nombre del Consumo</label>
						<input type="text" name="name_cons" maxlength="45" class="form-control" value="<?php echo $Fila2['name_cons']; ?>" required />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
				
				<button class="btn btn-outline-<?php echo $classButtonFooter; ?>" formaction="action/EditarConsumo.php" formmethod="post" type="submit" id="editar" name="editar"><span class="fa fa-save"></span> Grabar Cambios</button>
			</div>
			</form>
		</div>
	</div>
</div>
