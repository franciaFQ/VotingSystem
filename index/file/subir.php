<?php
$ruta = './'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente continuamos 
		{
			$NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
			$temporal = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino = $ruta.$NombreOriginal;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada

			# conectare la base de datos
    $con = @mysqli_connect("localhost:3306", "root", "", "votacion_adp");

    if(!$con){
        die("Imposible conectarse: ".mysqli_error($con));
    }

    if (@mysqli_connect_errno()) {
        die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
	
	$alumnos = fopen ($Destino, "r" );//leo el archivo que contiene los datos del alumno

	while (($datos = fgetcsv($alumnos, 1000, ",")) !== FALSE )
	//Leo linea por linea del archivo hasta un maximo de 1000 caracteres por linea leida usando coma(,) como delimitador
	{
 		$linea[] = array(
 			'carnet'=>$datos[0],
 			'nombre'=>$datos[1],
 			'turno'=>$datos[2]
 		);//Arreglo Bidimensional para guardar los datos de cada linea leida del archivo
	}

	fclose ($alumnos);//Cierra el archivo

	$ingresado = 0;//Variable que almacenara los insert exitosos
	$error = 0;//Variable que almacenara los errores en almacenamiento
	$duplicado = 0;//Variable que almacenara los registros duplicados

    foreach($linea as $indice=>$value) 
    //Iteracion el array para extraer cada uno de los valores almacenados en cada items
	{
		$carnet=$value["carnet"];//carnet del alumno
		$nombre=$value["nombre"];//nombre del alumno
		$turno=$value["turno"];//estado del alumno

		$sql=mysqli_query($con,"select * from usuarios where carnet='$carnet'");//Consulta a la tabla usuarios
		
		$num=mysqli_num_rows($sql);//Cuenta el numero de registros devueltos por la consulta
		
		if ($num == 0)//Si es == 0 inserto
		{
			if ($insert=mysqli_query($con,"insert into usuarios (carnet, nombre, turno, contrasena, codigo_tipo) values('$carnet', '$nombre', '$turno', '$carnet', '1')"))
			{
				$ingresado+=1;
			}//fin del if que comprueba que se guarden los datos
			else//sino ingresa el alumno
			{
				echo $msj='<font color=red>Alumno <b>'.$carnet.' </b> NO Guardado '.mysqli_error().'</font><br/>';
				$error+=1;
			}
		}//fin de if que comprueba que no haya en registro duplicado
		else{
			$duplicado+=1;
			echo $duplicate='<font color=red>El alumno carnet: <b>'.$carnet.'</b> Esta duplicado<br></font>';
		}
	}

	echo "<font color=green>".$ingresado." Alumnos almacenados con exito<br/>";
	echo "<font color=red>".$duplicado." Alumnos duplicados<br/>";
	echo "<font color=red>".$error." Errores de almacenamiento<br/>";

		}

	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
			$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
		}
	if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
		{
			$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: \n'.$key['error']; 
		}
	
}
echo $mensage;// Regresamos los mensajes generados al cliente

?>