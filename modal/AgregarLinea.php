<!-- Agregar Nuevos Registros -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#<?=$ccolor;?>">
				<font color='#FFFFFF' FACE='times new roman' size='5px'><b>Agregar Linea</b></font>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="action/AgregarNuevaLinea.php">

				<div class="row">		
					<div class="col-sm-4">
						<div class="form-group">
							<label><font FACE="times new roman" size="3px">Sigla</font></label>
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-spell-check"></i></span>
								<input type="text" name="acronym" maxlength="20" class="form-control" onkeyup="this.value = this.value.toUpperCase();" />
							</div>
						</div> 
					</div>			
					<div class="col-sm-8">
						<div class="form-group">
							<label><font FACE="times new roman" size="3px">Descripción de la Linea</font></label>
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-sticky-note "></i></span>
								<input type="text" name="namel" maxlength="80" class="form-control" onkeyup="this.value = this.value.toUpperCase();" />
							</div>
						</div>                                 
					</div>				
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label><font color="#606060" FACE="times new roman" size="3px"> Tipo Línea</font></label>
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-bars"></i></span>
								<select name="typel" class="form-control" > 
									<option value="">Seleccionar Tipo</option>
									<option value="LIN">LIN</option>
									<option value="DPTO">DPTO</option>
									<option value="EMP">EMP</option>
								<select>											
							</div>
						</div> 
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label><font FACE="times new roman" size="3px">Consecutivo Material Línea</font></label>
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-object-ungroup"></i></span>
									<input type="text" name="cont_cod" maxlength="5" class="form-control" required />
							</div>
						</div>                                 
					</div>
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