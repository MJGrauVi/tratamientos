drop table if exists inversor;

create table inversor(
    nombre varchar(100),
    email varchar(255),
    fecha_nac DATE,
    dni varchar(9)
);

create table fondoindexado(
    nombre varchar(100),
    pais varchar(100),
    gastos float
);

create table empresa(
    id integer,
    nombre varchar(100),
    rentabilidad float
);

alter table inversor add constraint pk_inversor primary key (email);
alter table fondoindexado add constraint pk_fondo primary key (nombre);
alter table empresa add constraint pk_empresa primary key (id);

insert into inversor (nombre, email, fecha_nac, dni) values ('carlos','carlos@carlos.com','2001-03-01','12345678A');
insert into inversor (nombre, email, fecha_nac, dni) values ('paco','paco@paco.com','2001-03-02','12345678B');
insert into inversor (nombre, email, fecha_nac, dni) values ('marta','marta@marta.com','2001-03-03','12345678C');
insert into inversor (nombre, email, fecha_nac, dni) values ('eva','eva@eva.com','2001-03-04','12345678D');

insert into empresa (id, nombre, rentabilidad) values ('1','Apple Inc.',1.4);
insert into empresa (id, nombre, rentabilidad) values ('2','Amazon',2.1);
insert into empresa (id, nombre, rentabilidad) values ('3','Nvidia',3.5);
insert into empresa (id, nombre, rentabilidad) values ('4','Facebook',0.4);
insert into empresa (id, nombre, rentabilidad) values ('5','AMD',2.8);

insert into fondoindexado (nombre, pais, gastos) values ('SP500','EEUU',0.3);
insert into fondoindexado (nombre, pais, gastos) values ('Vanguard European','France',0.1);
insert into fondoindexado (nombre, pais, gastos) values ('FTSE AW High','EEUU',0.4);
insert into fondoindexado (nombre, pais, gastos) values ('MSCI World','EEUU',0.2);
insert into fondoindexado (nombre, pais, gastos) values ('Renta Fija','UK',0.1);

