<?php
//install
//base dados do site

	include 'config.php';
	
	//criar base de dados
	
	    $user = "root";
        $password = "1234";
        
	$ligacao = new PDO("mysql:host=$host", $user, $password);
	$motor = $ligacao->prepare("CREATE DATABASE $base_dados");
	$motor->execute();
	$ligacao = null; 
	
	
	
	//abrir a base de dados
	$ligacao = new PDO("mysql:dbname=$base_dados;host=$host", $user, $password);
	
	//criar tabela tipo de utilizador
	$sql="create table tipoutilizador(
		ID_Tipo_Utilizador int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		Descricao varchar(80)
	)";
	
	$motor=$ligacao->prepare($sql);
	$motor->execute();

	
	
	
	//adicionar tabela utilizador
	$sql="create table utilizador(
		ID_Utilizador int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		nome varchar(20),
		apelido varchar(20),
		username varchar(30),
		email varchar(50),   
		pass_word varchar(40),
		estado varchar(10),
		morada varchar(60),
		sexo varchar(10),    
		data_nascimento varchar(20),
		telemovel int(10),
		avatar varchar(250),
		cc varchar(15),
		nif int(20),
		cs varchar(15),
		habilitacoes varchar(250),
		ID_Tipo_Utilizador int,
		FOREIGN key (ID_Tipo_Utilizador) references TipoUtilizador(ID_Tipo_Utilizador)
	)";
	
	$motor=$ligacao->prepare($sql);
	$motor->execute();
	
	
	//adicionar tabela TipoServico
	
	$sql="create table tiposervico(
		ID_Tipo_Servico int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		nome varchar(30) not null,
		Descricao varchar(80) not null
	)";
	
	$motor=$ligacao->prepare($sql);
	$motor->execute();
	
	
	
	//adicionar tabela Material
	
	$sql="create table material(
		ID_Material int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		nome varchar(30) not null,
		Descricao varchar(100)
	)";
	
	$motor=$ligacao->prepare($sql);
	$motor->execute();
	
	
	
	//adicionar tabela Servico
	
	$sql="create table servico(	
		ID_Servico int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		Data_Inicial varchar(30) not null,
		Hora_chegada time not null,
		Hora_saida time not null,
		estado varchar(15),
		relatorio varchar(100),
		ID_Utente int,
		ID_Funcionario int,
		ID_Tipo_Servico int,
		ID_Material int,
		FOREIGN key (ID_Utente) references Utilizador(ID_Utilizador),
		FOREIGN key (ID_Funcionario	) references Utilizador(ID_Utilizador),
		FOREIGN key (ID_Tipo_Servico) references TipoServico(ID_Tipo_Servico),
		FOREIGN key (ID_Material) references Material(ID_Material)
	)";
	
	$motor=$ligacao->prepare($sql);
	$motor->execute();
	
	

	//adicionar tabela Agenda
	
	$sql="create table agenda(
		ID_Evento int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		data varchar not null,
		hora varchar(10) not null,
		ID_Servico int,
		FOREIGN key (ID_Servico) references Servico(ID_servico)
	)";
	
	$motor=$ligacao->prepare($sql);
	$motor->execute();
	
	
	//adicionar tabela posts

	$sql="create table posts(
		ID_Post int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		titulo varchar(20),
		mensagem varchar(100),
		estados varchar(10),
		data_post DATETIME,
		ID_Utilizador int,
		FOREIGN key (ID_Utilizador) references utilizador(ID_Utilizador)
	)";

	$motor=$ligacao->prepare($sql);
	$motor->execute();

	

	//adicionar tabela respostaposts

	$sql="create table resposta_posts(
		ID_Resposta int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		mensagem varchar(100),
		estado_resposta varchar(10),
		data_resposta DATETIME,
		ID_Utilizador int,
		ID_Post int,
		FOREIGN key (ID_Utilizador) references utilizador(ID_Utilizador),
		FOREIGN key (ID_Post) references Posts(ID_Post)

	)";

	$motor=$ligacao->prepare($sql);
	$motor->execute();




	$tipo_utilizador_INSERT = "INSERT INTO tipoutilizador (ID_Tipo_Utilizador, Descricao) VALUES (1, 'Admin'), (2, 'Funcionario'), (3, 'Utente')";
	
    $motor = $ligacao->prepare($tipo_utilizador_INSERT);
    $motor->execute();

	$utilizador_INSERT = "INSERT INTO utilizador (ID_Utilizador, nome, apelido, username, email, pass_word, estado, morada, sexo, data_nascimento, telemovel, cc , nif, cs, habilitacoes, ID_Tipo_Utilizador, avatar) VALUES (1, 'Admin',  'Admin',  'admin',  'admin@gmail.com',  md5('admin'), 'ativo', 'rua do admin', 'Masculino',  '2019-03-31',  '913606842', NULL , '123456789' , NULL, NULL, 1, 'default.png')";
	
    $motor = $ligacao->prepare($utilizador_INSERT);
	$motor->execute();
	
	$utilizador2_INSERT = "INSERT INTO utilizador (ID_Utilizador, nome, apelido, username, email, pass_word, estado, morada, sexo, data_nascimento, telemovel, cc , nif, cs, habilitacoes, ID_Tipo_Utilizador, avatar) VALUES (2, 'João',  'Teixeira',  'joao',  'joaoteixeira@gmail.com',  md5('password'), 'ativo', 'rua do ola', 'Masculino',  '2001-09-03',  '913606842', NULL, '123456789', NULL, NULL, 3, 'default.png')";
	
    $motor = $ligacao->prepare($utilizador2_INSERT);
	$motor->execute();
	
	$utilizador3_INSERT = "INSERT INTO utilizador (ID_Utilizador, nome, apelido, username, email, pass_word, estado, morada, sexo, data_nascimento, telemovel, cc , nif, cs, habilitacoes, ID_Tipo_Utilizador, avatar) VALUES (3, 'Luís',  'António',  'luis',  'luis@gmail.com',  md5('password'), 'ativo', 'rua do luis', 'Masculino',  '2005-03-31',  '913606842',  '123456789' , '123456789', '123456789', '12º Ano de escolaridade ou equivalente', 2, 'listar.png')";
	
    $motor = $ligacao->prepare($utilizador3_INSERT);
	$motor->execute();

	$posts_INSERT="INSERT INTO posts (ID_Post, titulo, mensagem, estados , data_post, ID_Utilizador) VALUES (1, 'Teste1','Mensagem de teste1', 'ativo','2021-01-19  10:28:00', 1)"; 

	$motor=$ligacao->prepare($posts_INSERT);
	$motor->execute();

	$resposta_posts_INSERT="INSERT INTO resposta_posts (ID_Resposta, mensagem, estado_resposta , data_resposta, ID_Utilizador, ID_Post ) VALUES (1, 'Clicar na aba de pesquisa','ativo','2021-01-19', 1, 1)"; 

	$motor=$ligacao->prepare($resposta_posts_INSERT);
	$motor->execute();

	$tservico_INSERT="INSERT INTO tiposervico VALUES (1, 'Medicação','Medicação do Utente')"; 

	$motor=$ligacao->prepare($tservico_INSERT);
	$motor->execute();

	$tservico2_INSERT="INSERT INTO tiposervico VALUES (2, 'Alimentação','Alimentação do Utente')"; 

	$motor=$ligacao->prepare($tservico2_INSERT);
	$motor->execute();

	$tservico3_INSERT="INSERT INTO tiposervico VALUES (3, 'Higiene','Higiene do utente em casa')"; 

	$motor=$ligacao->prepare($tservico3_INSERT);
	$motor->execute();

	$material_INSERT="INSERT INTO material VALUES (1, 'Luvas Descartáveis','Luvas de látex brancas com pó e sem pó em látex 100% natural.')"; 

	$motor=$ligacao->prepare($material_INSERT);
	$motor->execute();

	$material2_INSERT="INSERT INTO material VALUES (2, 'Aveltais Descartáveis', '1 unidade por pessoa. Material:Polietílenno-plástico. Tamanho: 130x80cm. Espessura:25mm.')"; 

	$motor=$ligacao->prepare($material2_INSERT);
	$motor->execute();

	$material3_INSERT="INSERT INTO material VALUES (3, 'Seringa de alimentação','Capacidade: 100ml. Material:Plástico.')"; 

	$motor=$ligacao->prepare($material3_INSERT);
	$motor->execute();

	$material4_INSERT="INSERT INTO material VALUES (4, 'Resguardo de alimentação','Os resguardos de protecção para camas e assentos são feitos em fluff.')"; 

	$motor=$ligacao->prepare($material3_INSERT);
	$motor->execute();

	$servico_INSERT="INSERT INTO servico VALUES (1, '2021-01-18', '09:09 ', '10:10', 'Ativo', 'No serviço foram realizadas todas as atividades propostas', 2, 3, 1, 1)"; 

	$motor=$ligacao->prepare($servico_INSERT);
	$motor->execute();

	$servico_INSERT="INSERT INTO servico VALUES (2, '2021-01-16', '10:11 ', '11:10', 'Ativo', 'No serviço as atividades propostas foram parcialmente realizadas ', 2, 3, 1, 1)"; 

	$motor=$ligacao->prepare($servico_INSERT);
	$motor->execute();

	$servico_INSERT="INSERT INTO servico VALUES (3, '2021-01-17', '12:11 ', '12:10', 'Ativo', 'No serviço foram realizadas todas as atividades propostas', 2, 3, 1, 1)"; 

	$motor=$ligacao->prepare($servico_INSERT);
	$motor->execute();

	$servico_INSERT="INSERT INTO servico VALUES (4, '22021-01-22', '14:09 ', '17:10', 'Ativo', 'No serviço foram realizadas todas as atividades propostas', 2, 3, 1, 1)"; 

	$motor=$ligacao->prepare($servico_INSERT);
	$motor->execute();

	$ligacao = null;

	
	
?>
