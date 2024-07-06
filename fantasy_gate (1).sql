SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS fantasy_gate DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE fantasy_gate;

CREATE TABLE `admin` (
  name varchar(20) NOT NULL,
  pass varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO admin (name, pass) VALUES
('admin', 'admin');

CREATE TABLE books (
  book_isbn varchar(20) NOT NULL,
  book_title varchar(60) DEFAULT NULL,
  book_author varchar(60) DEFAULT NULL,
  book_image varchar(40) DEFAULT NULL,
  book_descr text DEFAULT NULL,
  book_price decimal(6,2) NOT NULL,
  publisherid int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO books (book_isbn, book_title, book_author, book_image, book_descr, book_price, publisherid) VALUES
('9789722369848', 'Solo Leveling Volume 1', 'Chugong', 'SL1.png', 'O fenómeno do Webtoon coreano, bestseller mundial, chega finalmente a Portugal.\r\nUm dia aconteceu: apareceram portais desconhecidos a ligar o nosso mundo a uma realidade totalmente extraordinária e alternativa, cheia de monstros e seres fantásticos… O seu objetivo? Matar humanos.\r\n\r\nEra preciso atacar este novo perigo. Assim surgiram os Caçadores, humanos que foram «despertados» e ganharam poderes para enfrentar aquelas criaturas medonhas. Mas, entre estes, há um que se destaca e é conhecido como «o mais fraco de todos os caçadores». O seu nome é Seong Jinu, e a sua sorte está prestes a mudar: a incursão que tem pela frente devia ser fácil, mas torna-se um verdadeiro pesadelo…', 15.00, 14),
('9789722370172', 'Solo Leveling volume 2', 'Chugong', 'SoloLeveling2.png', 'Chegou o segundo volume do fenómeno da manhwa que já tem milhões de leitores em todo o mundo!\r\nPassou ao nível seguinte...\r\n\r\nDesde que aqueles portais desconhecidos apareceram nos quatro cantos do mundo, a humanidade teve de encontrar forma de combater os monstros que deles saíam. Caso contrário, os humanos acabariam por ser massacrados pelas mais terríveis criaturas. Os Caçadores são destemidos e não têm medo de entrar nas dungeons para lutar com os seres que lá se escondem.\r\n\r\nSeong Jinu, conhecido por ser «o mais fraco de todos os caçadores», sobreviveu à primeira incursão e está prestes a descobrir que, apesar de estar vivo, alguma coisa em si mudou…', 15.00, 14),
('9789722370813', 'Solo Leveling Volume 3', 'Chugong', 'SL3.png', 'Chegou o terceiro volume do fenómeno da Manhwa que já tem milhões de leitores em todo o mundo!\r\n\r\nO que não me mata... torna-me mais forte!\r\nSeong Jinu percebeu que algo tinha mudado em si. Era conhecido por ser «o mais fraco de todos os caçadores», estava no nível mais baixo, mas foi tomado por uma vontade brutal de chegar ao topo. Como podia deixar escapar uma oportunidade destas?\r\n\r\nPorém, o novo raid chega com uma inesperada novidade. Seong Jinu vai reencontrar velhos conhecidos, sim, mas também novos caçadores: um grupo de prisioneiros. E há algo que parece estar a ser tramado nas sombras…\r\n\r\nContinua a saga Solo Leveling, que já conquistou milhares de leitores portugueses e em breve chegará ao anime.', 15.00, 14),
('9789722371292', 'Solo Leveling Volume 4', 'Chugong', 'SL4.png', 'Chegou o quarto volume do fenómeno da Manhwa que já tem milhões de leitores em todo o mundo!\r\n\r\nPara de proteger o lugar de alguém que já partiu. Que tal protegeres-me a mim, que estou à tua frente? Ergue-te!\r\n\r\nSeong Jinu continua a progredir e, agora, está numa dungeon em que terá de enfrentar monstros variados: cavaleiros, assassinos, arqueiros, feiticeiros… a luta parece interminável, mas o caçador irá em breve deparar com uma autêntica surpresa: sem perceber bem como, alcança a classificação de necromante. Mas em que consiste exatamente esta nova classe? Deverá Seong Jinu aceitá-la? E, se o fizer, o que poderá acontecer?\r\n\r\nContinua a saga Solo Leveling, que já conquistou milhares de leitores portugueses e em breve chegará ao anime.', 15.00, 14),
('9789722372343', 'Solo Leveling Volume 5', 'Chugong', 'SL5.png', 'Chegou o quinto volume do fenómeno da manhwa que já tem milhões de leitores em todo o mundo!Depois de derrotar o boss da dungeon em que ficou preso, o portal vermelho volta a abrir-se e Seong Jinu regressa a Seul como o herói da Guilda do Tigre Branco. As atenções estão viradas para um mero caçador de nível E. Impressionante!Entretanto, no Japão, os monstros da ilha Jeju sofrem uma mutação que põe em causa a segurança mundial… Nos Estados Unidos, Seong Ilhwan, o pai de Seong Jinu, é encontrado numa dungeon, dez anos depois...', 15.00, 14),
('9789722372572', 'Solo Leveling volume 6', 'Chugong', 'SL6.png', 'Chegou o sexto volume do fenómeno da manhwa que já tem milhões de leitores em todo o mundo! Nada detém Seong Jinu. Mas o regresso ao castelo demoníaco pode não correr como esperado… Não há dúvidas: Seong Jinu é o décimo caçador de nível S da Coreia. De nível E para S, a atenção de várias guildas, bem como da Organização de Caçadores da República da Coreia, está virada para si. Depois de atingir esta classificação, os seus problemas são agora outros. Jinu tem de voltar ao castelo demoníaco e derrotar o terceiro boss, se quer salvar a sua mãe do sono eterno - uma doença que surgiu com o aparecimento dos portais. Para isso, ele tem de ficar mais forte. Com esse objetivo, Jinu junta-se sub-repticiamente a um esquadrão de exploração mineira da guilda dos Hunters e acaba a acompanhar, como porteiro, uma equipa B a uma dungeon de classe A, fingindo ser um caçador de nível E. Aí começam a surgir suspeitas sobre a sua verdadeira identidade… Continua a saga Solo Leveling, que já conquistou milhares de leitores portugueses e que em breve chegará ao anime.', 15.00, 14),
('9789722373296', 'Solo Leveling Volume 7', 'Chugong', 'SL7.png', 'Chegou o sétimo volume do fenómeno da manhwa que já tem milhões de leitores em todo o mundo! Seong Jinu teve um Segundo despertar.O pior caçador de sempre é agora…um nível S. Seong Jinu subiu cinco níveis e foi notícia em toda a parte. O interesse dos mestres das guildas aumenta, agora que sabem quem tem participado, sob disfarce, nos seus raids e tem salvado os seus membros. Entretanto, Jinho é expulso de casa por defender Seong Jinu à revelia do pai, recusando a posição de mestre de guilda. A quem irá ele pedir guarida? No castelo demoníaco, Jinu continua a missão: quer chegar ao 100.º piso, derrotar o último boss e produzir o elixir que salvará a mãe. Desta vez, com a companhia inesperada de um demónio com uma aparência humana e muito feminina…. Continua a saga Solo Leveling, que já conquistou milhares de leitores portugueses e que já tem anime.', 15.00, 14),
('9789727228164', 'Programação em Python', 'Ernesto Costa', 'python.png', 'Este é um livro que apresenta os fundamentos da programação em Python, linguagem de programação de alto nível, estruturado em duas partes. Numa primeira parte, aprofunda-se a programação procedimental, fazendo-se, numa segunda parte, uma breve introdução à programação orientada aos objetos (POO). Assim, o livro apresenta não só uma panorâmica do essencial da programação, como também aprofunda os conceitos básicos da programação e os aspetos complementares, mais avançados, da linguagem Python, discutindo- -se vários aspetos do desenvolvimento de programas. O leitor pode encontrar, ainda, outros temas, como as estruturas de dados e tipos de dados abstratos, os conceitos essenciais da POO, as noções básicas de desenho de soluções e de diagramas de classes, e a programação guiada por eventos.\r\nA abordagem adotada permite que se possam começar a escrever os primeiros programas após o primeiro capítulo, e a organização e conteúdo do texto possibilitam que este seja usado por vários tipos de leitores, seja num contexto de formação ou autoformação – estudantes dos ensinos profissional e superior –, seja em contexto profissional – programadores de aplicações e profissionais da informática.\r\nO livro inclui vários exemplos já resolvidos, sumários da matéria abordada e exercícios teóricos e práticos.', 30.00, 22);

CREATE TABLE customers (
  customerid int(10) UNSIGNED NOT NULL,
  name varchar(60) NOT NULL,
  address varchar(80) NOT NULL,
  city varchar(30) NOT NULL,
  zip_code varchar(10) NOT NULL,
  country varchar(60) NOT NULL,
  email varchar(188) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO customers (customerid, name, address, city, zip_code, country, email) VALUES
(20, 'ffdsg', 'dg', 'a', 'a', 'Portugalewfw', 'admin@gmail.com'),
(21, 'ANA', 'mafra', 'mafra', '1234', 'PORTUGAL', 'ANA@gmail.com'),
(22, 'dasdgerg', 'dsfghj', 'sdfghjk', 'fghjk', 'sdfghjkl', 'asdfghjkl@gmail.com'),
(23, 'armando', '123', '123', '123', 'Portugal', 'correiajp@gmail.com'),
(24, 'armando', '123', '123', '123', 'Portugal', ''),
(25, 'filipe', 'rua', 'mafra', '1244', '', 'fdsgsadg@gmail.com'),
(26, 'filipe', 'rua', 'mafra', '', '', 'fdsgsadg@gmail.com'),
(27, 'filipe', 'rua', 'mafra', '', '', 'filipeiskaovcr@gmail.com'),
(28, 'filipe', 'rua', 'mafra', '', '', 'filipeisakovcr7@gmail.com'),
(29, 'filipe', 'rua', 'mafra', '', '', 'loucenco.anam@gmail.com'),
(30, 'filipe', 'rua', 'mafra', '', '', 'lourenco.anam@gmail.com'),
(31, 'sfdsgfsd', 'gdfghdfh', 'fdhgfh', 'fgjgfj', 'jfgjgf', 'filipeisakovcr7@gmail.com'),
(32, 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com');

CREATE TABLE orders (
  orderid int(10) UNSIGNED NOT NULL,
  customerid int(10) UNSIGNED NOT NULL,
  amount decimal(6,2) DEFAULT NULL,
  date timestamp NOT NULL DEFAULT current_timestamp(),
  ship_name char(60) NOT NULL,
  ship_address char(80) NOT NULL,
  ship_city char(30) NOT NULL,
  ship_zip_code char(10) NOT NULL,
  ship_country char(20) NOT NULL,
  email varchar(188) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO orders (orderid, customerid, amount, date, ship_name, ship_address, ship_city, ship_zip_code, ship_country, email) VALUES
(1, 1, 60.00, '2015-12-03 13:30:12', 'a', 'a', 'a', 'a', 'a', ''),
(21, 15, 15.00, '2024-05-29 10:08:25', 'hreIOFFDR', 'SDFGHHKJT', 'JHRRSTGFHJH', 'RSDGFJHJKJ', 'DFGHHHHJH', ''),
(22, 16, 12.00, '2024-05-29 10:13:45', 'gdfhjlk', 'fdsghhj', 'sdfghjk', 'dfghjkl', 'xnm,', ''),
(23, 17, 15.00, '2024-05-29 10:16:55', 'z<czxvbnbnb', 'vcxbnn', 'xgxbfbn', 'vcxbgdfb', 'vxgdfbn', ''),
(24, 18, 15.00, '2024-05-29 10:20:09', 'sfsdgsd', 'gfdghdfh', 'hgfhs', 'gfhgfhgfjd', 'hgfhjf', ''),
(25, 19, 24.00, '2024-05-29 11:08:46', 'admin', 'a', 'a', 'a', 'Portugalewfw', ''),
(26, 20, 12.00, '2024-05-29 11:31:14', 'ffdsg', 'dg', 'a', 'a', 'Portugalewfw', 'admin@gmail.com'),
(27, 21, 20.00, '2024-05-29 11:39:28', 'ANA', 'mafra', 'mafra', '1234', 'PORTUGAL', 'ANA@gmail.com'),
(28, 22, 15.00, '2024-05-30 15:20:37', 'dasdgerg', 'dsfghj', 'sdfghjk', 'fghjk', 'sdfghjkl', 'asdfghjkl@gmail.com'),
(29, 22, 15.00, '2024-05-30 15:29:24', 'dasdgerg', 'dsfghj', 'sdfghjk', 'fghjk', 'sdfghjkl', 'asdfghjkl@gmail.com'),
(30, 23, 50.00, '2024-06-04 20:57:26', 'armando', '123', '123', '123', 'Portugal', 'correiajp@gmail.com'),
(31, 24, 30.00, '2024-06-05 08:47:52', 'armando', '123', '123', '123', 'Portugal', ''),
(32, 25, 115.00, '2024-06-05 09:38:09', 'filipe', 'rua', 'mafra', '1244', '', 'fdsgsadg@gmail.com'),
(33, 26, 15.00, '2024-06-05 09:46:59', 'filipe', 'rua', 'mafra', '', '', 'fdsgsadg@gmail.com'),
(34, 26, 15.00, '2024-06-05 09:55:53', 'filipe', 'rua', 'mafra', '', '', 'fdsgsadg@gmail.com'),
(35, 27, 15.00, '2024-06-05 09:58:02', 'filipe', 'rua', 'mafra', '', '', 'filipeiskaovcr@gmail.com'),
(36, 28, 15.00, '2024-06-05 09:58:41', 'filipe', 'rua', 'mafra', '', '', 'filipeisakovcr7@gmail.com'),
(37, 28, 15.00, '2024-06-05 10:01:26', 'filipe', 'rua', 'mafra', '', '', 'filipeisakovcr7@gmail.com'),
(38, 29, 15.00, '2024-06-05 10:04:40', 'filipe', 'rua', 'mafra', '', '', 'loucenco.anam@gmail.com'),
(39, 30, 15.00, '2024-06-05 10:11:33', 'filipe', 'rua', 'mafra', '', '', 'lourenco.anam@gmail.com'),
(40, 31, 15.00, '2024-06-05 10:24:50', 'sfdsgfsd', 'gdfghdfh', 'fdhgfh', 'fgjgfj', 'jfgjgf', 'filipeisakovcr7@gmail.com'),
(41, 31, 30.00, '2024-06-05 21:02:27', 'sfdsgfsd', 'gdfghdfh', 'fdhgfh', 'fgjgfj', 'jfgjgf', 'filipeisakovcr7@gmail.com'),
(42, 31, 15.00, '2024-06-05 21:25:14', 'sfdsgfsd', 'gdfghdfh', 'fdhgfh', 'fgjgfj', 'jfgjgf', 'filipeisakovcr7@gmail.com'),
(43, 32, 15.00, '2024-06-05 23:06:11', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(44, 32, 15.00, '2024-06-05 23:15:54', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(45, 32, 15.00, '2024-06-05 23:17:16', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(46, 32, 15.00, '2024-06-05 23:23:51', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(47, 32, 15.00, '2024-06-05 23:44:48', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(48, 32, 75.00, '2024-06-05 23:52:55', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(49, 32, 60.00, '2024-06-06 00:14:04', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(50, 32, 60.00, '2024-06-06 00:16:34', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(51, 32, 60.00, '2024-06-06 00:19:15', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(52, 32, 60.00, '2024-06-07 18:57:50', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(53, 32, 15.00, '2024-06-07 18:58:10', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com'),
(54, 32, 60.00, '2024-06-07 19:02:11', 'Filipe', 'Rua da Liberdade nº1', 'Mafra', '2655-319', 'Portugal', 'filipeisakov06@gmail.com');

CREATE TABLE order_items (
  orderid int(10) UNSIGNED NOT NULL,
  book_isbn varchar(20) NOT NULL,
  item_price decimal(6,2) NOT NULL,
  quantity tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

INSERT INTO order_items (orderid, book_isbn, item_price, quantity) VALUES
(21, '9789722369848', 15.00, 1),
(22, '123', 12.00, 1),
(23, '9789722369848', 15.00, 1),
(24, '9789722369848', 15.00, 1),
(25, '123', 12.00, 2),
(26, '123', 12.00, 1),
(27, '9789727221561', 20.00, 1),
(28, '9789722369848', 15.00, 1),
(28, '9789722372343', 15.00, 1),
(30, '9789727221561', 20.00, 1),
(30, '9789722370813', 15.00, 2),
(31, '9789722369848', 15.00, 2),
(36, '9789722369848', 15.00, 1),
(38, '9789722369848', 15.00, 1),
(39, '9789722369848', 15.00, 1),
(40, '9789722369848', 15.00, 1),
(40, '9789722369848', 15.00, 1),
(40, '9789722370172', 15.00, 1),
(40, '9789722369848', 15.00, 1),
(43, '9789722369848', 15.00, 1),
(43, '9789722370172', 15.00, 1),
(43, '9789722370813', 15.00, 1),
(43, '9789722370172', 15.00, 1),
(43, '9789722370172', 15.00, 1),
(43, '9789722372572', 15.00, 5),
(43, '9789727228164', 30.00, 2),
(43, '9789727228164', 30.00, 2),
(43, '9789727228164', 30.00, 2),
(43, '9789722370813', 15.00, 2),
(43, '9789727228164', 30.00, 1),
(43, '9789722370813', 15.00, 1),
(43, '9789722370813', 15.00, 2),
(43, '9789727228164', 30.00, 1);

CREATE TABLE publisher (
  publisherid int(10) UNSIGNED NOT NULL,
  publisher_name varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO publisher (publisherid, publisher_name) VALUES
(14, 'Editorial Presença'),
(22, 'FCA');


ALTER TABLE admin
  ADD PRIMARY KEY (name,pass);

ALTER TABLE books
  ADD PRIMARY KEY (book_isbn);

ALTER TABLE customers
  ADD PRIMARY KEY (customerid);

ALTER TABLE orders
  ADD PRIMARY KEY (orderid);

ALTER TABLE publisher
  ADD PRIMARY KEY (publisherid);


ALTER TABLE customers
  MODIFY customerid int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

ALTER TABLE orders
  MODIFY orderid int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

ALTER TABLE publisher
  MODIFY publisherid int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
