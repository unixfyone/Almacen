<!-- Ventana Editar Registros CRUD -->
<div class="modal fade" id="edit_<?php echo $Fila2['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Editar Linea</b></font>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
			<div class="modal-body">
				<div class="container-fluid">
				
					<form method="POST" action="action/EditarLinea.php?id=<?php echo $Fila2['id']; ?>">

					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label><font FACE="times new roman" size="3px">Prefijo Cod SAP</font></label>
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-spell-check"></i></span>
											<input type="text" name="acronym" maxlength="20" class="form-control" value="<?php echo $Fila2['acronym']; ?>" onkeyup="this.value = this.value.toUpperCase();" required />
										</div>
									</div> 
								</div>  
								<div class="col-sm-8">
									<div class="form-group">
										<label><font FACE="times new roman" size="3px">Descripción de la Linea</font></label>
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-sticky-note "></i></span>
											<input type="text" name="namel" maxlength="80" class="form-control" value="<?php echo $Fila2['namel']; ?>" onkeyup="this.value = this.value.toUpperCase();" required />
										</div>
									</div>                                 
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label><font color="#606060" FACE="times new roman" size="3px"> Tipo Línea</font></label>
										<?Php $typel = $Fila2['typel']; ?>
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-bars"></i></span>
											<select name="typel" class="form-control" required />
												<option tal:repeat="link sequence" tal:attributes="selected python:link==prev"  ></option>
												<?php
												  echo '<option ';
													if($typel == 'LIN') echo 'selected ';
												  echo 'value=' . 'LIN' .'>'. 'LIN' . "\n";
													echo '<option ';
													if($typel == 'DPTO') echo 'selected ';
												  echo 'value=' . 'DPTO' .'>'. 'DPTO' . "\n";
													echo '<option ';
													if($typel == 'EMP') echo 'selected ';
												  echo 'value=' . 'EMP' .'>'. 'EMP' . "\n";
												?>
											</select>											
										</div>
									</div> 
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label><font FACE="times new roman" size="3px">Consecutivo Material Línea</font></label>
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-object-ungroup"></i></span>
											<input type="number" name="cont_cod" maxlength="5" class="form-control" value="<?php echo $Fila2['cont_cod']; ?>" required />
										</div>
									</div>                                 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button type="submit" name="editar" class="btn btn-outline-<?php echo $classButtonFooter; ?>"><span class="glyphicon glyphicon-check"></span> Actualizar Ahora</a>
			</form>			
			</div> 
		</div>
	</div>
</div>
