 <?php
include 'conexion.php';

    $v1 =$_POST['carne'];
    //echo $v1."<br>";
    $v2 =$_POST['cargo1'];
    //echo $v2;
   if(!isset($_FILES['foto'])){
       //echo "Complete los campos";
       header('Location: candidatos.php');
   }
    $consulta=$conn->query("SET NAMES 'utf8'");
    $consulta=$conn->prepare("select turno from usuarios where carnet = ?");
    $consulta->bindParam(1,$v1);
    if($consulta->execute()){
      $datos = $consulta->fetchAll();
      $anio = $datos[0][0][0];
      echo "$anio";
      if ($anio == 1) {
        if ($v2 == 1 || $v2 == 2) {
          echo "$anio";
        header('Location: candidatos.php?e=e');
        exit();
        }
      }
    }

//capturamos los datos del fichero subido    
$type=$_FILES['foto']['type'];
$tmp_name = $_FILES['foto']["tmp_name"];
$name = $_FILES['foto']["name"];

//Creamos una nueva ruta (nuevo path)
//Así guardaremos nuestra imagen en la carpeta "images"
$nuevo_path="images/".$name;

//Movemos el archivo desde su ubicación temporal hacia la nueva ruta
# $tmp_name: la ruta temporal del fichero
# $nuevo_path: la nueva ruta que creamos
move_uploaded_file($tmp_name,$nuevo_path);

//Extraer la extensión del archivo. P.e: jpg
# Con explode() segmentamos la cadena de acuerdo al separador que definamos. En este caso punto (.)
$array=explode('.',$nuevo_path);

# Capturamos el último elemento del array anterior que vendría a ser la extensión
$ext = end($array);
  
try{
    
    $pdoQuery = "INSERT INTO `candidatos`(`codigo_candidato`, `imagen`, `codigo_puesto`) VALUES (:fname,:lname,:age)";
    $pdoResult = $conn->query("SET NAMES 'utf8'");
    $pdoResult = $conn->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":fname"=>$v1,":lname"=>$nuevo_path,":age"=>$v2));

    
    $conn=null;
    //echo "Candidato ingresado";
    header('Location: candidatos.php'); 
}catch(Exception $e){
    //echo "No puede repetir el candidato";
    header('Location: candidatos.php');
}
                                          
?>