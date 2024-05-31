<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Adicionar Zonas de Ubicación</b></font>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
				<div class="container-fluid">
					<form method="POST" action="action/AgregarNuevaZona.php">
						<?php include('function.php');	?>				
					<div class="row">
						<div class="col-sm-8">
							<div class="form-group">
								<label><font color="#303030" FACE="times new roman" size="3px">Compañia</font></label>
								<select name="zcompany_id" class="form-control" required>
									<option value="">Seleccionar Compañia</option>
									<?php echo fill_companies_list($connect); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								<label><font color="#303030" FACE="times new roman" size="3px"> Código de la Zona</font></label>
								<input type="text" name="zone_id" maxlength="6" class="form-control" placeholder="Codigo ID de la Zona" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label><font color="#303030" FACE="times new roman" size="3px"> Prefijo Compañia-Zona</font></label>
						<input type="text" name="zone_prefix" maxlength="25" class="form-control" placeholder="Prefijo" required />
					</div>							
					<div class="form-group">
						<label><font color="#303030" FACE="times new roman" size="3px"> Descripción de la Zona</font></label>
						<input type="text" name="zone_desc" size="60" maxlength="60" class="form-control" placeholder="Descripción de Zona" required />
					</div>
					<div class="form-group">
						<label><font color="#303030" FACE="times new roman" size="3px"> Ubicación de la Zona</font></label>
						<input type="text" name="zone_ubic" size="60" maxlength="60" class="form-control" placeholder="Área Ubicación de la Zona" required />
					</div>
					<div class="form-group">
						<label><font color="#303030" FACE="times new roman" size="3px"> Direccíon de la Zona</font></label>
						<input type="text" name="zone_direc" size="100" maxlength="100" class="form-control" placeholder="Dirección de la Zona" required />
					</div>						
				</div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-<?php echo $classButtonFooter; ?>" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                <button type="submit" name="agregar" class="btn btn-outline-<?php echo $classButtonFooter; ?>"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Registro</button>
			</form>
            </div>
        </div>
    </div>
</div>