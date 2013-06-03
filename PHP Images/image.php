<?
/*
** Image avec les informations des postes qui fonctionnent dans la salle **
** Création: Boulouk Hugo, le 2013/04/12 **
*/
header("Content-Type:image/png\r\n\r\n");
/*
** Déclaration de la base de données **
*/
mysql_connect('localhost','root','root');
mysql_select_db('dbsi6');
/*
** Mise en place de l'image de fond et des images des postes **
*/
$image=ImageCreateFromPng("plan.png");
$pc=ImageCreateFromPng('pc.png');
$serveur=ImageCreateFromPng('serveur.png');			
$imgOk=ImageCreateFromPng('ok.png');
$imgPasOk=ImageCreateFromPng('pasOk.png');
$colorPc=imagecolorallocate($image, 255, 255, 255);
$colorSe=imagecolorallocate($image, 0, 0, 0);
/*
** Fonction pour ping les postes **
*/
function ping($host)
{
        $package = "\x08\x00\x7d\x4b\x00\x00\x00\x00PingHost";
        $socket  = socket_create(AF_INET, SOCK_RAW, 1);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 0, 'usec' => 500));
        socket_connect($socket, $host, null);
        socket_send($socket, $package, strLen($package), 0);
        if (socket_read($socket, 255))
                $result = "ok";
        else    $result = "pOk";
        socket_close($socket);
        return $result;
}
/*
** Exécution du ping des ordinateurs à partir de la base de données **
*/
$sqlOrdi="SELECT ipIp, ipX, ipY FROM ipOrdi";
$resultOrdi=mysql_query($sqlOrdi);
while($row=mysql_fetch_array($resultOrdi))
{
	$x=$row['ipX'];
	$y=$row['ipY'];
	$ip=$row['ipIp'];
	imagestring($image,1 , $x-20, $y+20,  $ip, $colorPc);
	imagecopy($image, $pc, $x-15, $y-28, 0, 0, 48, 48);
	$resultat=ping($ip);	
	if($resultat=="ok")
	{			
		imagecopy($image, $imgOk, $x+8, $y-11, 0, 0, 16, 16);
	}
	else
	{
		imagecopy($image, $imgPasOk, $x+8, $y-11, 0, 0, 16, 16);
	}
}
/*
** Exécution du ping des serveurs/services à partir de la base de données **
*/
$sqlServeur="SELECT ipDisposer.id, idPort, ipServeur.ip, ipServeur.x AS xServ, ipServeur.y AS yServ, ipService.x AS xPort, ipService.y AS yPort, libelle
FROM ipDisposer INNER JOIN ipServeur ON idServeur=ipServeur.id INNER JOIN ipService ON nPort=idPort";
$resultServeur=mysql_query($sqlServeur);
while($row=mysql_fetch_array($resultServeur))
{
	$xS=$row['xServ'];
	$yS=$row['yServ'];
	$xP=$row['xPort'];
	$yP=$row['yPort'];
	$ip=$row['ip'];
	$port=$row['idPort'];
	$libelle=$row['libelle'];
	imagestring($image, 3, $xS+5, $yS-55, $ip, $colorSe);
	imagestring($image, 1, $xP+30, $yP-5, $port, $colorSe);
	imagestring($image, 1, $xP+45, $yP-5, $libelle, $colorSe);
	imagecopy($image, $serveur, $xS-15, $yS-28, 0, 0, 128, 128);
	$fp=fsockopen($ip, $port, $errno, $errstr, 30);
	if($fp)
	{			
		imagecopy($image, $imgOk, $xP+8, $yP-11, 0, 0, 16, 16);
	}
	else
	{
		imagecopy($image, $imgPasOk, $xP+8, $yP-11, 0, 0, 16, 16);
	}
}

imagePng($image);
?>
