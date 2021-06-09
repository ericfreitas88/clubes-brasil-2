-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: clubesbrasil
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `noticias`
--

DROP TABLE IF EXISTS `noticias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `noticias` (
  `noticiaId` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) DEFAULT NULL,
  `imagem` varchar(200) DEFAULT NULL,
  `conteudo` varchar(500) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  PRIMARY KEY (`noticiaId`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
INSERT INTO `noticias` VALUES (19,'What is Lorem Ipsum?',NULL,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.\r\n    ','2021-05-17'),(20,'Why do we use it?',NULL,'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.','2021-05-17'),(21,'Where does it come from?',NULL,'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.','2021-05-17'),(22,'O que é o Lorem Ipsum?',NULL,'O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos, mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada. Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset.','2021-05-17'),(23,'Porque é que o usamos?',NULL,'É um facto estabelecido de que um leitor é distraído pelo conteúdo legível de uma página quando analisa a sua mancha gráfica. Logo, o uso de Lorem Ipsum leva a uma distribuição mais ou menos normal de letras, ao contrário do uso de \"Conteúdo aqui, conteúdo aqui\", tornando-o texto legível. Muitas ferramentas de publicação electrónica e editores de páginas web usam actualmente o Lorem Ipsum como o modelo de texto usado por omissão.','2021-05-17'),(24,'De onde é que ele vem?',NULL,'Ao contrário da crença popular, o Lorem Ipsum não é simplesmente texto aleatório. Tem raízes numa peça de literatura clássica em Latim, de 45 AC, tornando-o com mais de 2000 anos. Richard McClintock, um professor de Latim no Colégio Hampden-Sydney, na Virgínia, procurou uma das palavras em Latim mais obscuras (consectetur) numa passagem Lorem Ipsum. Teste.','2021-05-17'),(29,'FLAMENGO',NULL,'Com menos um, desde o início do 1º tempo, Flamengo empata com a LDU em 2x2.','2021-05-20'),(30,'Contratação de meio-campista na Colina',NULL,'Alexandre Pássaro, executivo de futebol, revela que Vasco pagou US$ 500 mil (cerca de R$ 2,64 milhões) por 60% dos direitos econômicos do paraguaio de 19 anos.','2021-05-20'),(31,'Mirassol confirma empréstimos',NULL,'O Mirassol confirmou a liberação do lateral-direito Daniel Borges e do volante Luís Oyama para assinarem contrato por empréstimo com o Botafogo até o fim da temporada. Ambos estão no Rio de Janeiro e dependem apenas da aprovação dos exames médicos para firmarem vínculo com o time carioca.','2021-05-20'),(32,'Flamengo aguarda nova proposta',NULL,'Clube tem sinalização de que Al Nassr fará nova investida após negociação bater na trave em janeiro. Na ocasião, oferta de 6 mi de euros com mais 3 por bônus agradou, mas esbarrou em conflito de calendário.','2021-05-20'),(33,'Fluminense pode se classificar',NULL,'Se a derrota na última terça-feira para o Junior Barranquilla, da Colômbia, foi péssima para o Fluminense, a vitória por 2 a 1 do River Plate sobre o Santa Fe nesta quarta, na Argentina, foi tão ruim quanto. O Tricolor perdeu a liderança do Grupo D e agora terá menos combinações para se classificar na última rodada, quando visitará os argentinos na próxima terça-feira, às 19h15 (de Brasília), no Monumental de Núñez. Por sua vez, o Junior vai enfrentar um já eliminado Santa Fe.','2021-05-20'),(34,'Pendências resolvidas',NULL,'O anúncio da contratação de Douglas Costa pelo Grêmio é apenas questão de tempo. As pendências que faltavam para a liberação da Juventus foram resolvidas, e o clube gaúcho já está redigindo o contrato do atacante.','2021-05-20'),(35,'Corinthians prioriza Renato Gaúcho',NULL,'No aguardo da resposta de Renato Gaúcho, que pode sair nesta quinta-feira, o Corinthians tem convicção de que o treinador é o nome certo para o cargo deixado por Vagner Mancini. A certeza é tamanha que a diretoria não trabalha com plano B, pois não há consenso sobre quem, além de Renato, mudaria o panorama do clube.','2021-05-20'),(36,'Goleiro do Barcelona perderá Eurocopa',NULL,'O goleiro Marc-André ter Stegen, do Barcelona, será submetido a uma operação no joelho direito na próxima quinta-feira e vai perder o último jogo do time na temporada. Além disso, ele será desfalque para a Alemanha na disputa da Eurocopa.','2021-05-20'),(37,'Mbappé bate recorde pessoal',NULL,'Segundo dados do PSG, Mbappé precisou de 45 jogos e 3542 minutos jogados para atingir os 40 gols em 2020/21. Antes disso, sua melhor temporada em número de bolas na rede foi em 2018/19, a segunda pelo time de Paris, quando anotou 39 gols.','2021-05-20'),(38,'Adeus no Real',NULL,'Em sua penúltima entrevista coletiva em 2020/21, o técnico Zinedine Zidane deixou no ar uma possível despedida do Real Madrid ao fim da temporada. O comandante conversou com a imprensa na véspera do confronto contra o Athletic de Bilbao e, em meio à disputa pelo título espanhol, foi questionado sobre seu futuro no clube. E, apesar de dizer que \"tudo pode acontecer\", acenou para um adeus com sua declaração.','2021-05-20'),(39,'Crespo: cérebro, pernas e coração',NULL,'Aos 45 anos, argentino une tudo o que aprendeu como jogador e leva à beira do campo como técnico para tentar acabar com o jejum de títulos do São Paulo','2021-05-20'),(40,'Santos encaminha renovação',NULL,'O Santos encaminhou a renovação de contrato de Lucas Braga. O atacante deve assinar ainda nesta quinta-feira um novo vínculo, válido até maio de 2026 – o atual se encerra em maio de 2022','2021-05-20');
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usuarioId` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `sobrenome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `perfil` int DEFAULT NULL,
  PRIMARY KEY (`usuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Eric','Freitas','eric@freitas.com.br','999999999','1234',1),(10,'Victor Hugo','Machado','victor@machado.com.br','999999977','1234',1),(11,'Fernando','Gaspar','fernado@gaspar.com.br','999999999','1234',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'clubesbrasil'
--

--
-- Dumping routines for database 'clubesbrasil'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-26 13:39:25
