<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $Fila2['zone_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Zona</b></font>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="action/EditarZona.php?id=<?php echo $Fila2['zone_id']; ?>">
					<div class="row">
						<div class="col-sm-12">
							<input type="hidden" name="zcompany_id" value="<?php echo $Fila2['zcompany_id']; ?>"/>
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px">Compañia</font></label>
										<input type="text" name="company" class="form-control" value="<?php echo $Fila2['company']; ?>" readonly />
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Código de la Zona</font></label>
										<input type="text" name="zone_id" class="form-control" value="<?php echo $Fila2['zone_id']; ?>" readonly />
									</div>
								</div>
							</div>							
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Descripción de la Zona</font></label>
										<input type="text" name="zone_desc" maxlength="60" class="form-control" value="<?php echo $Fila2['zone_desc']; ?>" required />
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Prefijo Compañia-Zona</font></label>
										<input type="text" name="zone_prefix" maxlength="25" class="form-control" value="<?php echo $Fila2['zone_prefix']; ?>" required />
									</div>
								</div>							
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Ubicación de la Zona</font></label>
										<input type="text" name="zone_ubic" size="60" maxlength="60" class="form-control" value="<?php echo $Fila2['zone_ubic']; ?>" required />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Direccíon de la Zona</font></label>
										<input type="text" name="zone_direc" maxlength="100" class="form-control" value="<?php echo $Fila2['zone_direc']; ?>" required />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Contador Doc. Salidas</font></label>
										<input type="text" name="zone_doc_sm" class="form-control" value="<?php echo $Fila2['zone_doc_sm']; ?>" required />
									</div>
								</div>							
								<div class="col-sm-6">	
									<div class="form-group">
										<label><font color="#303030" FACE="times new roman" size="3px"> Contador Doc. Entradas<font></label>
										<input type="text" name="zone_doc_em" class="form-control" value="<?php echo $Fila2['zone_doc_em']; ?>" required />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
				<button type="submit" name="editar" class="btn btn-outline-<?php echo $classButtonFooter; ?>"><span class="glyphicon glyphicon-check"></span> Actualizar</a>
			</div>
			</form>
		</div>
	</div>
</div>
