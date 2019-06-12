--
--Código para criação das tabelas do sistema
--
create database uau_chat;
use uau_chat;
create table tb_chat(
	id_chat int not null auto_increment,
    titulo varchar(80) not null,     
    constraint pk_chat
		primary key(id_chat)		
);
create table tb_usuario(
	nick varchar(100) not null,
    id_chat int,
    constraint pk_usuario
		primary key(nick),
	constraint fk_usuario_chat
		foreign key(id_chat)
			references tb_chat (id_chat)    
);
create table tb_msg(
	id_msg int not null auto_increment,
    ct_msg varchar(350) not null,
    usuario varchar(100),
    hr_msg datetime,
    id_chat int,
    constraint pk_msg
		primary key(id_msg),
	constraint fk_msg_chat
		foreign key(id_chat)
			references tb_chat(id_chat),
);
create table tb_report(
	id_chat int,
    nick_report varchar(80) not null,
    nick_reportador varchar(80) not null,
    constraint fk_report_chat
		foreign key (id_chat)
			references tb_chat(id_chat)
);