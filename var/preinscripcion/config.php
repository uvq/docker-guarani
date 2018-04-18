<?php
return array (
 'global' => array (
	/**
	 * Indica si el sistema est� o no en un entorno de producci�n
	 *  - Valores posibles: true|false
	 */
	'produccion' => false,

	/**
	 * Indica si el sistema utiliza personalizaciones. Se debe complementar indicando
	 * el ID de personalizaci�n en la configuraci�n de los puntos de acceso.
	 *  - Valores posibles: true|false
	 */
	'usar_personalizaciones' => true,

	/**
	* Path al directorio donde se guardar�n los attachments de los mensajes. 
	* En esta carpeta apache debe tener permisos de escritura.
	*  - Valores posibles: string (un path)
	*/
	'dir_attachment' => '/tmp',

	/**
	 * M�ximo tiempo de inactividad (en minutos). Vencido el mismo, 
	 * se pedir� identificarse nuevamente
	 *  - Valores posibles: n�meros enteros
	 */
	'sesion_timeout' => 30,

	/**
	 * M�xima duraci�n de la sesi�n (en minutos)
	 *  - Valores posibles: n�meros enteros
	 */
	'sesion_maxtime' => 120,

	/**
	 * Sufijo del archivo de idioma, donde se definen todos los mensajes y 
	 * etiquetas del sistema. En la carpeta src/siu/mensajes debe existir 
	 * un archivo llamado "mensajes.<locale>.php". 
	 * El archivo por defecto entregado por el SIU es "mensajes.es.php"
	 */
	'locale' => 'es',

	/**
	* En algunos lugares de la aplicaci�n se encriptan cadenas con sha1. 
	* Se utiliza este SALT para hacer la encriptaci�n de las claves de los 
	* alumnos preinscriptos. Cambiar este valor no reviste inconvenientes.
	*  - Valores posibles: string
	*/
	'salt' => '9bf057558b90263987bd8f99caf2e92f7efc1a13',

	/**
	 * Valor de SALT usado para cifrar las claves default de la secci�n de 
	 * administraci�n (usuarios administradores). 
	 * 
	 */
	'salt_admin' => '9bf057558b90263987bd8f99caf2e92f7efc1a13',

	/**
	 * Configuraci�n de logging. Si no se especifica este bloque no se usa 
	 * el log (es lo mismo que setear activo en false).
	 */
	'log' => array (
		/**
		 * Indica si el log est� activo o no
		 *  - Valores posibles: true|false
		 */
		'activo' => true,

		/**
		 * NIVELES DE ERROR: 
		 *  - 'error' -> recomendado en producci�n
		 *  - 'info'
		 *  - 'debug' -> recomendado en desarrollo
		 */
		'nivel'	=> 'debug',
	),

	//--------------------------------------------------------------------------
	//---- Configuraci�n de captcha --------------------------------------------
	//--------------------------------------------------------------------------

	/**
	 * Configuraci�n de captchas (se usa recaptcha). Si no se especifica este 
	 * bloque no se usa captcha (es lo mismo que setear activo en false)
	 */
	'captcha' => array (
		/**
		 * Indica si se activan los captchas a trav�s de toda la aplicaci�n
		 *  - Valores posibles: true|false
		 */
		'activo' => true,

		/**
		 * Cantidad de intentos fallidos permitidos antes
		 * de exigir que se complete un captcha en el login
		 */
		'intentos_login' => 2,

		/**
		 * Configuraci�n de reCAPTCHA 2
		 * Para obtener el par de API keys ('site_key' y 'secret_key')
		 * ir a https://www.google.com/recaptcha/admin
		 * 
		 * Los provistos en este ejemplo fueron generados para la URL http://localhost
		 */
		'site_key' => '6LerglMUAAAAAE1-hBuBBO_lJIFCPLcwyfAn-0mJ', 
		'secret_key' => '6LerglMUAAAAAIk1jzGr0iwI69Eb5W4w0G3kblrz', 
	),

	/**
	 * Configuraci�n de Proxy (por defecto desactivado)
	 */
	'proxy' => array(
		'activo' => false,
		'proxy_host' => 'proxy.xxxxxxxxx',
		'proxy_port' => 8080,
		'proxy_username' => 'PROXY-USERNAME',
		'proxy_password' => 'PROXY-PASSWORD'
	),

	//--------------------------------------------------------------------------
	//---- Servidor de correo --------------------------------------------------
	//--------------------------------------------------------------------------

	/**
	 * Se provee un ejemplo de configuraci�n del correo usando el servidor de GMail
	 */
	'smtp' => array (
		'from' => 'guarani@dev.com',
		'from_name' => 'SIU-Preinscripci�n',
		'host' => 'mailhog',
		'seguridad' => null,
		'auth' => false,
		'port' => 1025,
		'reply_to' => 'guarani@dev.com',
		'usuario' => 'guarani@dev.com',
		'clave' => '',
	),

	//--------------------------------------------------------------------------
	//---- Configuraci�n del logo de p�gina ------------------------------------
	//--------------------------------------------------------------------------

	/**
	 * Nombre del archivo del logo de p�gina, relativa a la carpeta www/img/ 
	 * del proyecto o de la carpeta de la personalizaci�n activa
	 */
	'logo_pagina' => 'logo-transparente.png',

	 //--------------------------------------------------------------------------
	 //---- Configuraci�n de SSL, la cual define si la aplicaci�n es accedida ---
	 //---- v�a el protocolo HTTP o HTTPS. --------------------------------------
	 //--------------------------------------------------------------------------

	 /**
	  * alcance: si se indica 'all' la aplicaci�n es accedida v�a el protocolo HTTPS, si se indica 'none' se accede v�a el protocolo HTTP, esta ultima es la opci�n por defecto. Los valores posibles son: 'none'|'all'
	  * redirigir_ssl: indica si se debe redirigir en el caso que se halla accedido con el protocolo incorrecto, por defecto es true (redirige). Puede ser true o false
	  */
	 'ssl' => array(
		 'alcance' => 'none',
		 'redirigir_ssl' => false,
	 ),

	//--------------------------------------------------------------------------
	//---- Configuraci�n de puntos de acceso -----------------------------------
	//--------------------------------------------------------------------------

	'accesos' => array (
		'ua1' => array (
			/**
			 * Id de la personalizaci�n que se va a utilizar. 
			 * Representa el nombre de carpeta dentro de src/pers.
			 * Si se deja en NULL no se utiliza ninguna personalizaci�n.
			 */
			'personalizacion' => ['unq'],

			/**
			 * Informaci�n de conexi�n de la base de datos
			 */
			'database' => array (
				'vendor'		=> 'pgsql',
				'dbname'		=> 'preinscripcion',
				'host'			=> 'pg',
				'port'			=> '5432',
				'pdo_user'		=> 'postgres',
				'pdo_passwd'	=> 'postgres',
			),
			
			/**
			 * Forma de obtener informaci�n de Guaran�
			 *  - Valores posibles: 'consultas_bd'
			 */
			'modo_consultas_g3' => 'consultas_bd',
			
			/**
			 * Si el par�metro 'modo_consultas_g3' est� definido como 'consultas_bd', 
			 * aqu� se configura la informaci�n de conexi�n de la base de datos de Guaran�
			 */
			'database_guarani' => array (
				'vendor'		=> 'pgsql',
				'dbname'		=> 'toba_guarani',
				'schema'		=> 'negocio',
				'host'			=> 'pg',
				'port'			=> '5432',
				'pdo_user'		=> 'postgres',
				'pdo_passwd'	=> 'postgres',
			),
			
			//------------------------------------------------------------------
			//-- Par�metros sistema --------------------------------------------
			//--
			//-- Desde versi�n 3.5.0 estos par�metros se incluyen dentro de este
			//-- bloque, para permitir mayor flexibilidad de configuraci�n en 
			//-- instalaciones que manejan varios puntos de acceso
			//------------------------------------------------------------------

			/**
			 * Longitud m�nima de la clave de usuario
			 *  - Valores permitidos: n�meros enteros
			 */
			'clave_long_minima'	=> 6,

			/**
			 * Formatea uniformemente los campos de texto que ingresa el usuario en el sistema
			 *  - Valores posibles: 
			 *		+ 'libre' : Se deja la entrada tal cual como la ingresa el usuario
			 *		+ 'mayusculas' : Se formatea todo en may�sculas
			 *		+ 'capitalizar' :  Se deja la primera letra de cada palabra en may�sculas y el resto en min�sculas.
			 */
			'formateo_campos' => 'capitalizar',

			/**
			 * Determina si el aspirante debe elegir un turno para la presentaci�n de documentaci�n
			 *  - Valores posibles: true | false
			 */
			'carga_turno_presentacion' => false,
			
			/**
			 * Forma de generaci�n de comprobante para presentar en la Instituci�n
			 *  - Valores posibles: 
			 *      + ra: un comprobante por cada Responsable Acad�mica
			 *      + propuesta: un comprobante por cada Propuesta elegida
			 *      + unico: un s�lo comprobante por aspirante
			 */
			'modo_impresion_comprobante' => 'propuesta',
			
			//------------------------------------------------------------------
			//---- Par�metros del reporte (comprobante del alumno) -------------
			//------------------------------------------------------------------

			/**
			 * Nombre de la instituci�n que se mostrar� en el encabezado de p�gina
			 */
			'rep_nombre_institucion' => 'Universidad Nacional de Quilmes',

			/**
			 * Determina si se imprime el per�odo de inscripci�n (ID) junto con las propuestas elegidas
			 *  - 1: Se imprime
			 *  - 0: No se imprime
			 */
			'rep_imprime_periodo_insc' => '0',
			
			/**
			 * Determina si se imprime tabla para completar resultado de CBC
			 *  - 1: Se imprime
			 *  - 0: No se imprime
			 */
			'rep_imprime_CBC' => '0',

			/**
			 * Determina si se imprime credencial provisoria
			 *  - 1: Se imprime
			 *  - 0: No se imprime
			 */
			'rep_imprime_credencial_provisoria' => '0',

			/**
			 * URL del logo que se imprime en el encabezado de p�gina, relativa a 
			 * la carpeta www/img/ del proyecto.
			 * IMPORTANTE: el logo debe estar en formato PNG y sin canal alfa
			 * Si se elimina o comenta esta entrada, no se imprime logo.
			 */
			'rep_encabezado_logo' => 'logo2.png',

			/**
			 * Si se desea imprimir el nombre de localidad junto con la fecha, a la altura
			 * de la firma, consignarla aqu�. Si no se desea, dejar un string vac�o ('')
			 * 
			 * Ejemplo de salida (asumiendo fecha actual: 15/11/2012):
			 *  - Completando este valor: Buenos Aires, 15/11/2012
			 *  - Si no se ingresa valor: 15/11/2012
			 */
			'rep_localidad' => 'Buenos Aires',
			
			/**
			 * Arreglo para poner los �tems que se quieran imprimir como avisos en 
			 * la impresi�n. 
			 * Aparecer�n en forma de lista numerada, respetando el orden de definici�n.
			 * Se proveen valores de ejemplo.
			 */
			'rep_avisos' => array(
			   'La presente tiene car�cter de <b>DECLARACI�N JURADA</b>, la cual deber� ser completada personalmente por el firmante.',
			   //'-- Completar aqu� avisos que ser�n listados en el comprobante --',
			   //'-- Cada l�nea de este arreglo aparecer� como un �tem de una lista numerada --',
			),
		),
	),
),
);
?>
