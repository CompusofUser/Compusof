--Codigo para crear la tabla de usuarios la cual almacenara las credenciales de c/u
create table usuarios(
		idUsuario int auto_increment ,
		nombre varchar (25) not null,
		apellidos varchar (25) not null,
		email varchar(50) not null,
		numeroTelefono varchar(10) not null,
		password varchar(255),
		fechaNac date,
		genero enum ('hombre','mujer'),
        creadoEn datetime default current_timestamp,
        actualizadoEn datetime default current_timestamp on update current_timestamp,
        constraint pk_idUsuario primary key (idUsuario)
	);

	
-- Modificar tabla usuarios
ALTER TABLE usuarios
ADD COLUMN two_factor_secret VARCHAR(32) NULL,
ADD COLUMN two_factor_enabled BOOLEAN DEFAULT FALSE,
ADD COLUMN reset_token VARCHAR(64) NULL,
ADD COLUMN reset_token_expires DATETIME NULL;

ALTER TABLE usuarios ADD COLUMN extension VARCHAR(5) NULL;
--no copiar en la base de datos
$dbname ="Compusof";
$dbuser="root";
$dbpasword="";
$dbhost="localhost";