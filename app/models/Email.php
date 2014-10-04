<?php
class Email extends Eloquent {

	/*  Elaborado por: Jonathan Lopez Torres / Lissette Ochoa Vera 
	 *  Fecha : 04/10/2014
	 *  Proyecto: Prometeo
	 *  Proposito:  Funcion que te permite enviar un correo electronico 

	  1  parametro   template a usar
	  2  array informacion del Correo que recibira el template
	  3  array Usuario/s de envio de correo(from)
	  4  array Usuario/s de envio de correo(cc) - Opcional
	  5  array Usuario/s de envio de correo(bcc) - Opcional
	  6  array Asunto de Correo Nobre de Quien lo envia - y Asunto del Correo
	  7  parametro Ruta del Ajunto - Opcional */

public static function SendEmail ($template,$data,$from,$fromCc=null,$fromBcc=null,$dataAsunto,$attachments = null) {
	$mensaje=null;
	
	try {
	
	Mail::send($template,$data,function ($mensaje) use($attachments,$from,$dataAsunto,$fromBcc,$fromCc){
		$mensaje->to ($from); //los correo de Para:
		$mensaje->from ($dataAsunto["FromEmail"],$dataAsunto["FromName"]);//El Correo de:
		if (!empty($fromBcc))
		{
			$mensaje->cc($fromCc);//Correo de Copia CC
		}
		
		if (!empty($fromBcc))
		{
				$mensaje->bcc($fromBcc);//Correo con copia Oculta Cco
		}
		$mensaje->subject($dataAsunto["Asunto"]); // Asunto
		if (!empty($attachments))
		{
		$mensaje->attach($attachments);//Adjunto
		}
		
	});
		$respuesta='OK';
	}
    catch (Exception $e) 
    {
       $respuesta='Error';
    }
        
	return  $respuesta;

}}