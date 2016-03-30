<?php 
	/* CARLOS HORACIO GONZALEZ DE LA ROSA 178591 
		Declaro haber realizado este examen con estricot apego al codigo de honor de la udem
	*/
	if(!empty($_POST)){
		$tipoDeVehiculo = $_POST["tipoDeVehiculo"];
		$zona= $_POST["zona"];
		$marcaModelo= trim($_POST["marcaModelo"]);
		$numeroPuertas= $_POST["numeroPuertas"];
		$color= trim($_POST["color"]);
		$precio= trim($_POST["precio"]);
		$telefono= trim($_POST["telefono"]);
		if(isset($_POST["extras"]))
			$extras= $_POST["extras"];
		$descripcion= trim($_POST["descripcion"]);

		$verificador = 1;
		$verificador2 = 1;
		$directorio = "fotos/";
		$nombre ="";
		$archivoASubir = $directorio . preg_replace("/[a-zA-Z0-9._-]/","", basename($_FILES["foto"]["name"]));
		$tipoArchivo = pathinfo($archivoASubir,PATHINFO_EXTENSION);
		$archivo = $_FILES["foto"]["tmp_name"];

		if(file_exists($archivo)){
			 // Verificar el tamaño del archivo
			if ($_FILES["foto"]["size"] > 256000) {
	   			//echo "Una disculpa este archivo es muy grande";
	    		$verificador = 0;
	    		$verificador2 = 0;
			}
			// Verificar si no se marco ningun error al subir el archivo
			if ($verificador == 0) {
			    //echo "Lo siento hubo un error al subir tu archivo";
			} else {
				// Si el archivo se subio correctamente abrirlo
			    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $archivoASubir)) {
			    } else
			        echo "Lo siento hubo un error al subir tu archivo";
			}
		}else{
			$verificador=0;
		}

		if(!empty($tipoDeVehiculo) && !empty($zona) &&  !empty($marcaModelo) && !empty($numeroPuertas) &&  !empty($color) &&  !empty($precio) &&  !empty($telefono && $verificador2 !=0) ){
			$string="
					<h1>Registro de Vehiculo</h1>
					<p>Datos introducidos desde el formulario:</p>
					<ul>
					  <li>Tipo: ".$tipoDeVehiculo." </li>
					  <li>Zona: ".$zona." </li>
					  <li>Marca y Modeo: ".$marcaModelo." </li>
					  <li>Numero de puertas: ".$numeroPuertas." </li>
					  <li>Color: ".$color." </li>
					  <li>Precio: ".$precio." </li>
					  <li>Telefono:  ".$telefono." </li>
					  <li>Extras: ";
					  foreach($extras as $value) {
					  	$string.=" ".(string)$value.",";
					  }
					  $string.=" </li>
					  <li>Descripcion: ".$descripcion." </li>
					  ";
					  if($verificador == 0){
							$string.="<li>SIN FOTO</li>";
						}else{
							$string.="<li>Foto:[<a href=".$archivoASubir.">ver foto</a>]</li>";
						}
					 $string.="</ul>
							<br>
							[<a href='178591.php'>Insertar Otro</a>]
							 ";
				 echo $string;
		}else{
			// INICIO HASTA TIPO DE VEHICUULO
			$string= "
				<!DOCTYPE html>
				<html>
				<head>
				</head>
				<body>
					<h1>
						Captura de Vehiculo
					</h1>
					<p>
						introducir los datos del vehiculo
					</p>
					<form action='178591.php' name='form' method='POST' enctype='multipart/form-data'>
						<p> Tipo de Vehiculo:
							<select id='tipoDeVehiculo' name='tipoDeVehiculo' checked required>
								<option value='Motocicleta' >Motocicleta</option>
								<option value='Auto' >Auto</option>
								<option value='Camioneta' >Camioneta</option>
							</select>
						</p>";

			if(empty($tipoDeVehiculo)){
				$string.="<p style='color:red;'>Favor de ingresar su tipo de vehiculo</p>";
			}else{
				$string.="<script>document.getElementById('tipoDeVehiculo').value = '".$tipoDeVehiculo."';</script>";
			}
			// ZONA
			$string.="<p> Zona:
						<select id='zona' name='zona' checked required>
							<option value='Apodaca' >Apodaca</option>
							<option value='Guadalupe' >Guadalupe</option>
							<option value='Monterrey' >Monterrey</option>
							<option value='San Pedro Garza Garcia' >San Pedro Garza Garcia</option>
						</select>
					</p>";
			if(empty($zona)){
				$string.="<p style='color:red;'>Favor de ingresar una zona</p>";
			}else{
				$string.="<script>document.getElementById('zona').value = '".$zona."';</script>";
			}
			// marca y modelo
			$string.="<p> Marca y Modelo:
						<input type='text' id='marcaModelo' name='marcaModelo' maxlength='60' placeholder='Escribe tu marca y modelo' required>
					</p>";
			if(empty($marcaModelo)){
				$string.="<p style='color:red;'>Favor de ingresar la Marca y el Modelo</p>";
			}else{
				$string.="<script>document.getElementById('marcaModelo').value = '".$marcaModelo."';</script>";
			}
			//numero de puertas
			$string.="<p> Numero de Puertas:
						<input type='radio' id='numeroPuertas' name='numeroPuertas' value='0' checked> 0
						<input type='radio' id='numeroPuertas' name='numeroPuertas' value='1' > 1
						<input type='radio' id='numeroPuertas' name='numeroPuertas' value='2' > 2
						<input type='radio' id='numeroPuertas' name='numeroPuertas' value='3' > 3
						<input type='radio' id='numeroPuertas' name='numeroPuertas' value='4' > 4
						<input type='radio' id='numeroPuertas' name='numeroPuertas' value='5'>5<br>		
					</p>";
			if($numeroPuertas<0||$numeroPuertas>5){
				$string.="<p style='color:red;'>Favor de ingresar el numero de puertas de su vehiculo</p>";
			}else{
				$string.="<script>document.getElementById('numeroPuertas').value = '".$numeroPuertas."';</script>";
			}
			//color
			$string.="<p> Color:
						<input type='text' id='color' name='color' maxlength='60' placeholder='Escribe el color' required>
					</p>";
			if(empty($color)){
				$string.="<p style='color:red;'>Favor de ingresar el color de su vehiculo </p>";
			}else{
				$string.="<script>document.getElementById('color').value = '".$color."';</script>";
			}
			//Precio
			$string.="<p> Precio:
						$<input type='number' id='precio' name='precio' placeholder='Solo numeros' required>
					</p>";
			if(empty($precio)){
				$string.="<p style='color:red;'>Favor de ingresar el precio de su vehiculo</p>";
			}else{
				$string.="<script>document.getElementById('precio').value = '".$precio."';</script>";
			}

			//Telefono
			$string.="<p> Telefono:
						<input type='text' id='telefono' name='telefono' maxlength='10'  placeholder='Solo 10 digitos' required>
					</p>";
			if(empty($telefono)){
				$string.="<p style='color:red;'>Favor de ingresar un Telefono</p>";
			}else{
				$string.="<script>document.getElementById('telefono').value = '".$telefono."';</script>";
			}
			// Extras y Foto
			$string.="<p> Extras con los que cuenta el vehiculo:
						<input type='checkbox' id='extras1' name='extras[]' value='Aire Acondicionado' > Aire Acondicionado
						<input type='checkbox' id='extras2' name='extras[]' value='Alarma' > Alarma
						<input type='checkbox' id='extras3' name='extras[]' value='Seguros Electricos' > Seguros Electricos
						<input type='checkbox' id='extras4' name='extras[]' value='Quemacocos' > Quemacocos
					</p>
					 <p>Foto (Max 256KB):
						<input type='file' id='foto' name='foto' accept='image/*'>
					</p>";

			if($verificador2==0){
				$string.="<p style='color:red;'>El tamaño del archivo excede 250kb</p>";
			}else{
				$string.="<script>document.getElementById('foto').value = '".$nombre."';</script>";
				$contador = 1;
				foreach ($extras as $value) {
					$string.="<script>document.getElementById('extras".$contador."').value = '".$value."';</script>";
				}
			}

			$string.="<p>Descripcion
							<textarea rows='3' id='descripcion' name='descripcion' maxlength='300'></textarea>
						</p>
						<input type='submit' name='Guardar Vehiculo' value='Guardar Vehiculo' />
					</form>
				</body>
				</html>";
			if(!empty($descripcion)){
				$string.="<script>document.getElementById('descripcion').value = '".$descripcion."';</script>";
			}
			echo $string;

		}

	}else{ 
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h1>
		Captura de Vehiculo
	</h1>
	<p>
		introducir los datos del vehiculo
	</p>
	<form action="178591.php" name="form" method="POST" enctype="multipart/form-data">
		<p> Tipo de Vehiculo:
			<select id="tipoDeVehiculo" name="tipoDeVehiculo" checked required>
				<option value="Motocicleta" >Motocicleta</option>
				<option value="Auto" >Auto</option>
				<option value="Camioneta" >Camioneta</option>
			</select>
		</p>
		<p> Zona:
			<select id="zona" name="zona" checked required>
				<option value="Apodaca" >Apodaca</option>
				<option value="Guadalupe" >Guadalupe</option>
				<option value="Monterrey" >Monterrey</option>
				<option value="San Pedro Garza Garcia" >San Pedro Garza Garcia</option>
			</select>
		</p>
		<p> Marca y Modelo:
			<input type="text" id="marcaModelo" name="marcaModelo" maxlength="60" placeholder="Escribe tu marca y modelo" required>
		</p>
		<p> Numero de Puertas:
			<input type="radio" id="numeroPuertas" name="numeroPuertas" value="0" checked> 0
			<input type="radio" id="numeroPuertas" name="numeroPuertas" value="1" > 1
			<input type="radio" id="numeroPuertas" name="numeroPuertas" value="2" > 2
			<input type="radio" id="numeroPuertas" name="numeroPuertas" value="3" > 3
			<input type="radio" id="numeroPuertas" name="numeroPuertas" value="4" > 4
			<input type="radio" id="numeroPuertas" name="numeroPuertas" value="5">5<br>		
		</p>
		<p> Color:
			<input type="text" id="color" name="color" maxlength="60" placeholder="Escribe el color" required>
		</p>
		<p> Precio:
			$<input type="number" id="precio" name="precio" placeholder="Solo numeros" required>
		</p>
		<p> Telefono:
			<input type="text" id="telefono" name="telefono" maxlength="10"  placeholder="Solo 10 digitos" required>
		</p>
		<p> Extras con los que cuenta el vehiculo:
			<input type="checkbox" id="extras" name="extras[]" value="Aire Acondicionado" > Aire Acondicionado
			<input type="checkbox" id="extras" name="extras[]" value="Alarma" > Alarma
			<input type="checkbox" id="extras" name="extras[]" value="Seguros Electricos" > Seguros Electricos
			<input type="checkbox" id="extras" name="extras[]" value="Quemacocos" > Quemacocos
		</p>
		<p>Foto (Max 256KB):
			<input type="file" id="foto" name="foto" accept="image/*">
		</p>
		<p>Descripcion
			<textarea rows="3" id="descripcion" name="descripcion" maxlength="300"></textarea>
		</p>
		<input type="submit" name="Guardar Vehiculo" value="Guardar Vehiculo" />
	</form>
</body>
</html>
<?php
}
?>