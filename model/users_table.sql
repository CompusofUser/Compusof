create table usuarios(
		idUsuario int auto_increment ,
		nombre varchar (25) not null,
		apellidos varchar (25) not null,
		email varchar(50) not null,
		numeroTelefono varchar(10) not null,
		password vachar(255),
		fechaNac date,
		genero enum ('hombre','mujer'),
        creadoEn datetime default current_timestamp,
        actualizadoEn datetime default current_timestamp on update current_timestamp,
        constraint pk_idUsuario primary key (idUsuario)
	);