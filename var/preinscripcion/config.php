<?php
return array (
 'global' => array (
	/**
	 * Indica si el sistema está o no en un entorno de producción
	 *  - Valores posibles: true|false
	 */
	'produccion' => false,

	/**
	 * Indica si el sistema utiliza personalizaciones. Se debe complementar indicando
	 * el ID de personalización en la configuración de los puntos de acceso.
	 *  - Valores posibles: true|false
	 */
	'usar_personalizaciones' => false,

	/**
	 * Si está activo busca una clase siu\debug y ejecuta el metodo ini() 
	 * después de cargar el núcleo
	 *  - Valores posibles: true|false
	 * En producción: false
	 */
	'ini_debug' => false,

	/**
	* Path al directorio donde se guardarán los attachments de los mensajes. 
	* En esta carpeta apache debe tener permisos de escritura.
	*  - Valores posibles: string (un path)
	*/
	'dir_attachment' => '/tmp',

	/**
	 * Máximo tiempo de inactividad (en minutos). Vencido el mismo, 
	 * se pedirá identificarse nuevamente
	 *  - Valores posibles: números enteros
	 */
	'sesion_timeout' => 30,

	/**
	 * Máxima duración de la sesión (en minutos)
	 *  - Valores posibles: números enteros
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
	* En algunos lugares de la aplicación se encriptan cadenas con sha1. 
	* Se utiliza este SALT para hacer la encriptación de las claves de los 
	* alumnos preinscriptos. Cambiar este valor no reviste inconvenientes.
	*  - Valores posibles: string
	*/
	'salt' => '9bf057558b90263987bd8f99caf2e92f7efc1a13',

	/**
	 * Valor de SALT usado para cifrar las claves default de la sección de 
	 * administración (usuarios administradores y gerenciales). Se recomienda 
	 * NO CAMBIAR este valor.
	 */
	'salt_admin' => '9bf057558b90263987bd8f99caf2e92f7efc1a13',

	/**
	 * Clave que se asigna por defecto al momento de crear un usuario gerencial.
	 * En el primer acceso, se forzará al usuario a cambiarla.
	 * También es la clave que se asigna al momento de resetear una clave de 
	 * un usuario gerencial, volviendo a repetirse la necesidad de cambiarla en
	 * el primer acceso
	 */
	'clave_default' => 'lala4321',

	/**
	 * Configuración de logging. Si no se especifica este bloque no se usa 
	 * el log (es lo mismo que setear activo en false).
	 */
	'log' => array (
		/**
		 * Indica si el log está activo o no
		 *  - Valores posibles: true|false
		 */
		'activo' => true,

		/**
		 * NIVELES DE ERROR: 
		 *  - 'error' -> recomendado en producción
		 *  - 'info'
		 *  - 'debug' -> recomendado en desarrollo
		 */
		'nivel'	=> 'error',
	),

	//--------------------------------------------------------------------------
	//---- Configuración de puntos de acceso -----------------------------------
	//--------------------------------------------------------------------------

	'accesos' => array (
		'alumno_ua1' => array (
			/**
			 * Id de la personalización que se va a utilizar. 
			 * Representa el nombre de carpeta dentro de src/pers.
			 * Si se deja en NULL no se utiliza ninguna personalización.
			 */
			'personalizacion' => NULL,

			/**
			 * Información de conexión de la base de datos
			 */
			'database' => array (
				'vendor'		=> 'pgsql',
				'dbname'		=> 'preinscripcion',
				'host'			=> 'pg',
				'port'			=> '5432',
				'pdo_user'		=> 'postgres',
				'pdo_passwd'	=> 'postgres',
			),
		),

		'admin_ua1'	=> array (
			/**
			 * Id de la personalización que se va a utilizar. 
			 * Representa el nombre de carpeta dentro de src/pers.
			 * Si se deja en NULL no se utiliza ninguna personalización.
			 */
			'personalizacion'	=> NULL,

			/**
			 * Información de conexión de la base de datos
			 */
			'database' => array (
				'vendor'		=> 'pgsql',
				'dbname'		=> 'preinscripcion',
				'host'			=> 'pg',
				'port'			=> '5432',
				'pdo_user'		=> 'postgres',
				'pdo_passwd'	=> 'postgres',
			),
		),
	),

	//--------------------------------------------------------------------------
	//---- Configuración de captcha --------------------------------------------
	//--------------------------------------------------------------------------

	/**
	 * Configuración de captchas (se usa recaptcha). Si no se especifica este 
	 * bloque no se usa captcha (es lo mismo que setear activo en false)
	 */
	'captcha' => array (
		/**
		 * Indica si se activan los captchas a través de toda la aplicación
		 *  - Valores posibles: true|false
		 */
		'activo' => false,

		/**
		 * Cantidad de intentos fallidos permitidos antes
		 * de exigir que se complete un captcha en el login
		 */
		'intentos_login' => 2,

		/**
		 * Los valores de clave pública y privada provistos en este
		 * ejemplo representan el valor de la URL http://localhost
		 * 
		 * Para generar las claves correspondientes a la URL de la instalación, 
		 * dirigirse a https://www.google.com/recaptcha/admin
		 */
		'public_key' => '6Ldja84SAAAAAKdiYZIbx6qjQMtAdzWXiW474_Af',
		'private_key' => '6Ldja84SAAAAABchqHlz65yICNXJQ8ENbZpLvmS5',
	),

	/**
	 * Configuración de Proxy (por defecto desactivado)
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
	 * Se provee un ejemplo de configuración del correo usando el servidor de GMail
	 */
    'smtp' => array (
        'from' => '******@gmail.com',
        'from_name' => 'SIU-Preinscripción',
        'host' => 'smtp.gmail.com',
        'seguridad' => 'ssl',
        'auth' => true,
        'port' => 465,
        'usuario' => '********@gmail.com',
        'clave' => '*******',
    ), 
	//--------------------------------------------------------------------------
	//---- Configuración del logo de página ------------------------------------
	//--------------------------------------------------------------------------

	/**
	 * Nombre del archivo del logo de página, relativa a la carpeta www/img/ 
	 * del proyecto o de la carpeta de la personalización activa
	 */
	'logo_pagina' => 'logo-transparente.png',

	//--------------------------------------------------------------------------
	//---- Parámetros sistema --------------------------------------------------
	//--------------------------------------------------------------------------

	/**
	 * Longitud mínima de la clave de usuario
	 *  - Valores permitidos: números enteros
	 */
	'clave_long_minima'	=> 6,

	/**
	 * Cantidad máxima de inscripciones permitidas 
	 *  - Valores permitidos: números enteros
	 * (0 : sin límite)
	 */
	'cant_max_carreras_insc' => 0,

	/**
	 * Determina si se cargan datos en la sección "Discapacidad"
	 *  - Valores posibles: true | false
	 */
	'carga_datos_discapacidad' => true,
	 
	/**
	 * Formatea uniformemente los campos de texto que ingresa el usuario en el sistema
	 *  - Valores posibles: 
	 *		+ 'libre' : Se deja la entrada tal cual como la ingresa el usuario
	 *		+ 'mayusculas' : Se formatea todo en mayúsculas
	 *		+ 'capitalizar' :  Se deja la primera letra de cada palabra en mayúsculas y el resto en minúsculas.
	 */
	'formateo_campos' => 'mayusculas',
	 
	/**
	 * Determina si el aspirante debe elegir un turno para la presentación de documentación
	 *  - Valores posibles: true | false
	 */
	'carga_turno_presentacion' => false,

	//--------------------------------------------------------------------------
	//---- Parámetros del reporte (comprobante del alumno) ---------------------
	//--------------------------------------------------------------------------

	/**
	 * Nombre de la institución que se mostrará en el encabezado de página
	 */
	'rep_nombre_institucion' => 'INSTITUCIÓN SIU',

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
	'rep_imprime_credencial_provisoria' => '1',

	/**
	 * URL del logo que se imprime en el encabezado de página, relativa a 
	 * la carpeta www/img/ del proyecto.
	 * IMPORTANTE: el logo debe estar en formato PNG y sin canal alfa
	 * Si se elimina o comenta esta entrada, no se imprime logo.
	 */
	'rep_encabezado_logo' => 'logo2.png',

	/**
	 * Arreglo para poner los ítems que se quieran imprimir como avisos en 
	 * la impresión. 
	 * Aparecerán en forma de lista numerada, respetando el orden de definición.
	 * Se proveen valores de ejemplo.
	 */
	'rep_avisos' => array(
		'La presente tiene carácter de <b>DECLARACIÓN JURADA</b>, la cual deberá ser completada personalmente por el firmante.',
		'Se considerará <b>FALTA GRAVE</b>, pasible de suspensión de uno (1) a cinco (5) años de acuerdo a su importancia, el falseamiento de datos de la presente declaración jurada según lo dispuesto por Res. Nº1268/85 del Consejo Superior Provisorio de la Universidad de Buenos Aires. La presente deberá estar acompañada de tres (3) fotos, dos (2) fotocopias del título secundario legalizadas por U.B.A. Fotocopia de las dos (2) primeras hojas del DNI y una (1) fotocopia de la  Libreta Universitaria del CBC.',
		'A partir de la fecha y durante el transcurso del presente ciclo lectivo, el peticionante deberá cumplir con el requisito obligatorio de la <b>revisación médica</b>, de no realizarla perderá su condición de alumno regular.',
		'El trámite de <b>Libreta Universitaria</b> de esta Factultad deberá ser tramitada únicamente por el firmante en el próximo cuatrimestre desde la fecha de inscripción.',
	),

	/**
	 * Si se desea imprimir el nombre de localidad junto con la fecha, a la altura
	 * de la firma, consignarla aquí. Si no se desea, dejar un string vacío ('')
	 * 
	 * Ejemplo de salida (asumiendo fecha actual: 15/11/2012):
	 *  - Completando este valor: Buenos Aires, 15/11/2012
	 *  - Si no se ingresa valor: 15/11/2012
	 */
	'rep_localidad' => 'Buenos Aires',
),
);
?>
