/* Establecemos la creacion de tablas por sectores
*/
CREATE TABLE h_cliente (
    id int(11) NOT NULL AUTO_INCREMENT,
    cliente_id int(11) NOT NULL,
    codigo_cliente varchar(50) NOT NULL,
    cliente varchar(250) NOT NULL,
    contacto varchar(150) DEFAULT NULL,
    telefono varchar(15) DEFAULT NULL,
    email varchar(100) DEFAULT NULL,
    tiempo_contrato varchar(100) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE cliente (
    id int(11) NOT NULL AUTO_INCREMENT,
    codigo_cliente varchar(50) NOT NULL ,
    cliente varchar(250) NOT NULL,
    contacto varchar(150) DEFAULT NULL,
    telefono varchar(15) DEFAULT NULL,
    email varchar(100) DEFAULT NULL,
    tiempo_contrato varchar(100) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_cotizacion (
    id int(11) NOT NULL AUTO_INCREMENT,
    cotizacion_id int(11) NOT NULL,
    numero_cotizacion varchar(100) NOT NULL,
    cliente_id int(11) DEFAULT 1,
    monto int(11) DEFAULT NULL,
    asunto varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE cotizacion (
    id int(11) NOT NULL AUTO_INCREMENT,
    numero_cotizacion varchar(100) NOT NULL,
    cliente_id int(11) DEFAULT 1,
    monto int(11) DEFAULT NULL,
    asunto varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
     PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_area (
    id int(11) NOT NULL AUTO_INCREMENT,
    area_id int(11) NOT NULL,
    area varchar(50) NOT NULL ,
    descripcion varchar(250) NOT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE area (
    id int(11) NOT NULL AUTO_INCREMENT,
    area varchar(50) NOT NULL  ,
    descripcion varchar(250) NOT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_empleado (
    id int(11) NOT NULL AUTO_INCREMENT,
    empleado_id int(11) NOT NULL,
    area_id int(11) NOT NULL,
    nombres varchar(250) NOT NULL,
    apellidos varchar(150) DEFAULT NULL,
    dni varchar(15) DEFAULT NULL,
    email varchar(100) DEFAULT NULL,
    fecha_nacimiento varchar(100) DEFAULT NULL,
    licencia_conducir varchar(100) DEFAULT NULL,
    profesion varchar(100) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE empleado (
    id int(11) NOT NULL AUTO_INCREMENT,
    area_id int(11) NOT NULL,
    nombres varchar(250) NOT NULL,
    apellidos varchar(150) DEFAULT NULL,
    dni varchar(15) DEFAULT NULL,
    email varchar(100) DEFAULT NULL,
    fecha_nacimiento varchar(100) DEFAULT NULL,
    licencia_conducir varchar(100) DEFAULT NULL,
    profesion varchar(100) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_contenedor (
    id int(11) NOT NULL AUTO_INCREMENT,
    contenedor_id int(11) NOT NULL,
    codigo varchar(250) NOT NULL,
    tipo_contenedor varchar(150) DEFAULT NULL,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE contenedor (
    id int(11) NOT NULL AUTO_INCREMENT,
    codigo varchar(250) NOT NULL,
    tipo_contenedor varchar(150) DEFAULT NULL,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_maquina (
    id int(11) NOT NULL AUTO_INCREMENT,
    maquina_id int(11) NOT NULL,
    codigo varchar(250) NOT NULL,
    producto varchar(150) DEFAULT NULL,
    marca varchar(150) DEFAULT NULL,
    modelo varchar(150) DEFAULT NULL,
    regrigerante varchar(150) DEFAULT NULL,
    serie varchar(150) DEFAULT NULL,
    controlador varchar(150) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE maquina (
    id int(11) NOT NULL AUTO_INCREMENT,
    codigo varchar(250) NOT NULL,
    producto varchar(150) DEFAULT NULL,
    marca varchar(150) DEFAULT NULL,
    modelo varchar(150) DEFAULT NULL,
    regrigerante varchar(150) DEFAULT NULL,
    serie varchar(150) DEFAULT NULL,
    controlador varchar(150) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_orden_trabajo (
    id int(11) NOT NULL AUTO_INCREMENT,
    orden_trabajo_id int(11) NOT NULL,
    cotizacion_id int(11) NOT NULL,
    empleado_id int(11) NOT NULL,
    maquina_id int(11) DEFAULT 1,
    contenedor_id int(11) DEFAULT 1,
    numero_ot varchar(50) NOT NULL,
    descripcion varchar(250) DEFAULT NULL,
    supervisa varchar(100) DEFAULT NULL,
    trabajo_realizar varchar(150) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE orden_trabajo (
    id int(11) NOT NULL AUTO_INCREMENT,
    cotizacion_id int(11) NOT NULL,
    empleado_id int(11) NOT NULL,
    maquina_id int(11) DEFAULT 1,
    contenedor_id int(11) DEFAULT 1,
    numero_ot varchar(50) NOT NULL,
    descripcion varchar(250) DEFAULT NULL,
    supervisa varchar(100) DEFAULT NULL,
    trabajo_realizar varchar(150) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_contenedor_maquina (
    id int(11) NOT NULL AUTO_INCREMENT,
    contenedor_maquina_id int(11) NOT NULL,
    maquina_id int(11) NOT NULL,
    contenedor_id int(11) NOT NULL,
    referencia varchar(50) NOT NULL,
    descripcion varchar(150) DEFAULT NULL,    
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE contenedor_maquina (
    id int(11) NOT NULL AUTO_INCREMENT,
    maquina_id int(11) NOT NULL,
    contenedor_id int(11) NOT NULL,
    referencia varchar(50) NOT NULL,
    descripcion varchar(150) DEFAULT NULL,    
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `cotizacion` 
ADD CONSTRAINT `cotizacion_ibfk_1`
  FOREIGN KEY (`cliente_id`)
  REFERENCES `cliente` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `h_cliente` 
ADD CONSTRAINT `h_cliente_ibfk_1`
  FOREIGN KEY (`cliente_id`)
  REFERENCES `cliente` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_cotizacion` 
ADD CONSTRAINT `h_cotizacion_ibfk_1`
  FOREIGN KEY (`cotizacion_id`)
  REFERENCES `cotizacion` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_area` 
ADD CONSTRAINT `h_area_ibfk_1`
  FOREIGN KEY (`area_id`)
  REFERENCES `area` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_empleado` 
ADD CONSTRAINT `h_empleado_ibfk_1`
  FOREIGN KEY (`empleado_id`)
  REFERENCES `empleado` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_maquina` 
ADD CONSTRAINT `h_maquina_ibfk_1`
  FOREIGN KEY (`maquina_id`)
  REFERENCES `maquina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_contenedor` 
ADD CONSTRAINT `h_contenedor_ibfk_1`
  FOREIGN KEY (`contenedor_id`)
  REFERENCES `contenedor` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_orden_trabajo` 
ADD CONSTRAINT `h_orden_trabajo_ibfk_1`
  FOREIGN KEY (`orden_trabajo_id`)
  REFERENCES `orden_trabajo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_contenedor_maquina` 
ADD CONSTRAINT `h_contenedor_maquina_ibfk_1`
  FOREIGN KEY (`contenedor_maquina_id`)
  REFERENCES `contenedor_maquina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `empleado` 
ADD CONSTRAINT `empleado_ibfk_1`
  FOREIGN KEY (`area_id`)
  REFERENCES `area` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `orden_trabajo` 
ADD CONSTRAINT `orden_trabajo_ibfk_1`
  FOREIGN KEY (`cotizacion_id`)
  REFERENCES `cotizacion` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `orden_trabajo` 
ADD CONSTRAINT `orden_trabajo_ibfk_2` 
  FOREIGN KEY (`empleado_id`)
  REFERENCES `empleado` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `orden_trabajo` 
ADD CONSTRAINT `orden_trabajo_ibfk_3` 
  FOREIGN KEY (`maquina_id`)
  REFERENCES `maquina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `orden_trabajo` 
ADD CONSTRAINT `orden_trabajo_ibfk_4` 
  FOREIGN KEY (`contenedor_id`)
  REFERENCES `contenedor` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `contenedor_maquina` 
ADD CONSTRAINT `contenedor_maquina_ibfk_1` 
  FOREIGN KEY (`contenedor_id`)
  REFERENCES `contenedor` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `contenedor_maquina` 
ADD CONSTRAINT `contenedor_maquina_ibfk_2` 
  FOREIGN KEY (`maquina_id`)
  REFERENCES `maquina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


/*  
descripcion de la segunda parte de la estructura de datos 
tabla categoria
tabla insumo
tabla receta
tabla receta_insumo
tabal inventario

tabla usuario
tabla permiso
tabla usuario_permiso
tabla general

*/

CREATE TABLE h_categoria (
    id int(11) NOT NULL AUTO_INCREMENT,
    categoria_id int(11) NOT NULL ,
    nombre_categoria varchar(50) NOT NULL  ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,

    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE categoria (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre_categoria varchar(50) NOT NULL  ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_receta (
    id int(11) NOT NULL AUTO_INCREMENT,
    receta_id int(11) NOT NULL ,
    codigo_receta varchar(50) DEFAULT NULL,
    nombre_receta varchar(50) NOT NULL ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,

    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE receta (
    id int(11) NOT NULL AUTO_INCREMENT,
    codigo_receta varchar(50) DEFAULT NULL,
    nombre_receta varchar(50) NOT NULL ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_insumo (
    id int(11) NOT NULL AUTO_INCREMENT,
    insumo_id int(11) NOT NULL ,
    codigo_insumo varchar(50) NOT NULL,
    nombre_insumo varchar(50) NOT NULL ,
    categoria_id int(2) DEFAULT 1,
    descripcion varchar(250) DEFAULT NULL,
    part_number_1 varchar(50) DEFAULT NULL ,
    part_number_2 varchar(50) DEFAULT NULL ,
    part_number_3 varchar(50) DEFAULT NULL ,
    part_number_4 varchar(50) DEFAULT NULL ,
    marca varchar(50) DEFAULT NULL ,
    almacen_id int(2) DEFAULT 1,
    rack varchar(20) DEFAULT NULL ,
    anaquel varchar(20) DEFAULT NULL ,
    piso varchar(20) DEFAULT NULL ,
    sector varchar(20) DEFAULT NULL ,
    imagen_insumo varchar(250) DEFAULT NULL ,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,

    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE insumo (
    id int(11) NOT NULL AUTO_INCREMENT,
    codigo_insumo varchar(50) NOT NULL,
    nombre_insumo varchar(50) NOT NULL ,
    categoria_id int(2) DEFAULT 1,
    descripcion varchar(250) DEFAULT NULL,
    part_number_1 varchar(50) DEFAULT NULL ,
    part_number_2 varchar(50) DEFAULT NULL ,
    part_number_3 varchar(50) DEFAULT NULL ,
    part_number_4 varchar(50) DEFAULT NULL ,
    marca varchar(50) DEFAULT NULL ,
    almacen_id int(2) DEFAULT 1,
    rack varchar(20) DEFAULT NULL ,
    anaquel varchar(20) DEFAULT NULL ,
    piso varchar(20) DEFAULT NULL ,
    sector varchar(20) DEFAULT NULL ,
    imagen_insumo varchar(250) DEFAULT NULL ,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*
Establecer un modulo almacen 
*/

CREATE TABLE h_almacen (
    id int(11) NOT NULL AUTO_INCREMENT,
    almacen_id int(11) NOT NULL ,
    codigo_almacen varchar(50) DEFAULT NULL,
    nombre_almacen varchar(50) NOT NULL ,
    descripcion varchar(250) DEFAULT NULL,
    ubicacion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,

    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE almacen (
    id int(11) NOT NULL AUTO_INCREMENT,
    codigo_almacen varchar(50) DEFAULT NULL,
    nombre_almacen varchar(50) NOT NULL ,
    descripcion varchar(250) DEFAULT NULL,
    ubicacion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE h_receta_insumo (
    id int(11) NOT NULL AUTO_INCREMENT,
    receta_insumo_id int(11) NOT NULL ,
    receta_id int(11) NOT NULL ,
    insumo_id int(11) NOT NULL ,
    cantidad int(11) NOT NULL ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE receta_insumo (
    id int(11) NOT NULL AUTO_INCREMENT,
    receta_id int(11) NOT NULL ,
    insumo_id int(11) NOT NULL ,
    cantidad int(11) NOT NULL ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_inventario (
    id int(11) NOT NULL AUTO_INCREMENT,
    inventario_id int(11) NOT NULL ,
    receta_insumo_id int(11) NOT NULL ,
    cantidad_entregada int(11) NOT NULL ,
    observaciones varchar(250) DEFAULT NULL,
    entregado_por varchar(100) DEFAULT NULL,
    referencia varchar(100) DEFAULT NULL,
    fecha_entrega varchar(50) DEFAULT NULL,
    autorizacion varchar(100) DEFAULT NULL,
    extra1 varchar(100) DEFAULT NULL,
    extra2 varchar(100) DEFAULT NULL,
    extra3 varchar(100) DEFAULT NULL,
    extra4 varchar(100) DEFAULT NULL,
    orden_trabajo_id int(11) NOT NULL ,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE inventario (
    id int(11) NOT NULL AUTO_INCREMENT,
    receta_insumo_id int(11) NOT NULL ,
    cantidad_entregada int(11) NOT NULL ,
    observaciones varchar(250) DEFAULT NULL,
    entregado_por varchar(100) DEFAULT NULL,
    referencia varchar(100) DEFAULT NULL,
    fecha_entrega varchar(50) DEFAULT NULL,
    autorizacion varchar(100) DEFAULT NULL,
    extra1 varchar(100) DEFAULT NULL,
    extra2 varchar(100) DEFAULT NULL,
    extra3 varchar(100) DEFAULT NULL,
    extra4 varchar(100) DEFAULT NULL,
    orden_trabajo_id int(11) NOT NULL ,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_permiso (
    id int(11) NOT NULL AUTO_INCREMENT,
    permiso_id int(11) NOT NULL ,
    nombre_permiso varchar(50) NOT NULL  ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE permiso (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre_permiso varchar(50) NOT NULL  ,
    descripcion varchar(250) DEFAULT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_usuario (
    id int(11) NOT NULL AUTO_INCREMENT,
    usuario_id int(11) NOT NULL ,
    nombre_usuario varchar(100) NOT NULL,
    clave varchar(250) NOT NULL,
    empleado_id int(11) DEFAULT 1 ,
    correo_envio varchar(100) NOT NULL,
    token_correo varchar(250) NOT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE usuario (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre_usuario varchar(100) NOT NULL,
    clave varchar(250) NOT NULL,
    empleado_id int(11) DEFAULT 1 ,
    correo_envio varchar(100) NOT NULL,
    token_correo varchar(250) NOT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_usuario_permiso (
    id int(11) NOT NULL AUTO_INCREMENT,
    usuario_permiso_id int(11) NOT NULL ,
    usuario_id int(11) NOT NULL,
    permiso_id int(11) NOT NULL ,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE usuario_permiso (
    id int(11) NOT NULL AUTO_INCREMENT,
    usuario_id int(11) NOT NULL,
    permiso_id int(11) NOT NULL ,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE h_general (
    id int(11) NOT NULL AUTO_INCREMENT,
    general_id int(11) NOT NULL ,
    nombre_empresa varchar(100) NOT NULL,
    ruc varchar(20) NOT NULL,
    telefono varchar(20) DEFAULT NULL,
    direccion varchar(200) DEFAULT NULL,
    logo varchar(200) DEFAULT NULL,
    correo varchar(100) NOT NULL,
    estado int(2) DEFAULT 1,
    fecha timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user int(2) DEFAULT 1,
    evento varchar(100) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE general (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre_empresa varchar(100) NOT NULL,
    ruc varchar(20) NOT NULL,
    telefono varchar(20) DEFAULT NULL,
    direccion varchar(200) DEFAULT NULL,
    logo varchar(200) DEFAULT NULL,
    correo varchar(100) NOT NULL,
    estado int(2) DEFAULT 1,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_c int(2) DEFAULT 1,
    user_m int(2) DEFAULT 1,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `h_categoria` 
ADD CONSTRAINT `h_categoria_ibfk_1`
  FOREIGN KEY (`categoria_id`)
  REFERENCES `categoria` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_insumo` 
ADD CONSTRAINT `h_insumo_ibfk_1`
  FOREIGN KEY (`insumo_id`)
  REFERENCES `insumo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_receta_insumo` 
ADD CONSTRAINT `h_receta_insumo_ibfk_1`
  FOREIGN KEY (`receta_insumo_id`)
  REFERENCES `receta_insumo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_receta` 
ADD CONSTRAINT `h_receta_ibfk_1`
  FOREIGN KEY (`receta_id`)
  REFERENCES `receta` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_inventario` 
ADD CONSTRAINT `h_inventario_ibfk_1`
  FOREIGN KEY (`inventario_id`)
  REFERENCES `inventario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_usuario` 
ADD CONSTRAINT `h_usuario_ibfk_1`
  FOREIGN KEY (`usuario_id`)
  REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_usuario_permiso` 
ADD CONSTRAINT `h_usuario_permiso_ibfk_1`
  FOREIGN KEY (`usuario_permiso_id`)
  REFERENCES `usuario_permiso` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `h_general` 
ADD CONSTRAINT `h_general_ibfk_1`
  FOREIGN KEY (`general_id`)
  REFERENCES `general` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `receta_insumo` 
ADD CONSTRAINT `receta_insumo_ibfk_1`
  FOREIGN KEY (`receta_id`)
  REFERENCES `receta` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `receta_insumo` 
ADD CONSTRAINT `receta_insumo_ibfk_2`
  FOREIGN KEY (`insumo_id`)
  REFERENCES `insumo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `insumo` 
ADD CONSTRAINT `insumo_ibfk_1`
  FOREIGN KEY (`categoria_id`)
  REFERENCES `categoria` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `inventario` 
ADD CONSTRAINT `inventario_ibfk_1`
  FOREIGN KEY (`receta_insumo_id`)
  REFERENCES `receta_insumo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `inventario` 
ADD CONSTRAINT `inventario_ibfk_2`
  FOREIGN KEY (`orden_trabajo_id`)
  REFERENCES `orden_trabajo` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `usuario` 
ADD CONSTRAINT `usuario_ibfk_1`
  FOREIGN KEY (`empleado_id`)
  REFERENCES `empleado` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `usuario_permiso` 
ADD CONSTRAINT `usuario_permiso_ibfk_1`
  FOREIGN KEY (`usuario_id`)
  REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `usuario_permiso` 
ADD CONSTRAINT `usuario_permiso_ibfk_2`
  FOREIGN KEY (`permiso_id`)
  REFERENCES `permiso` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;