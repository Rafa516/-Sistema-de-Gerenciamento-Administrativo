-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2023 às 14:30
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_sistema`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_alterar_imagem_perfil` (IN `pid_usuario` INT(11), IN `pfoto` VARCHAR(64))   BEGIN
 
    UPDATE tb_usuarios
    SET
        foto = pfoto
      
	WHERE id_usuario = pid_usuario;
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_alterar_localizacao` (IN `pid_localidade` INT(11), IN `pid_usuario` INT(11), IN `plng` DOUBLE, IN `plat` DOUBLE)  NO SQL BEGIN
   
   UPDATE tb_localidades
    SET
        id_localidade= pid_localidade,
        id_usuario = pid_usuario,
        lng = plng,    
        lat = plat

        WHERE id_localidade  = pid_localidade;
        
      SELECT * FROM tb_localidades WHERE id_localidade = pid_localidade ;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_alterar_repag_efetivos` (IN `pid_repag_efetivo` INT(11), IN `pid_beneficio_efetivo` INT(11), IN `pjus` DOUBLE, IN `pvalor_recebido` DOUBLE, IN `pcusteio` DOUBLE, IN `preceber` DOUBLE, IN `pdevolver` DOUBLE, IN `pdias` INT(60), IN `pvencimento` DOUBLE, IN `pfrequencia` VARCHAR(30), IN `pano_frequencia` VARCHAR(20))  NO SQL BEGIN
   
   UPDATE tb_repag_efetivos
    SET
        id_repag_efetivo = pid_repag_efetivo,
        id_beneficio_efetivo = pid_beneficio_efetivo,    
        jus = pjus,
        valor_recebido = pvalor_recebido,
        custeio = pcusteio,
        receber = preceber,
        devolver = pdevolver,
        dias = pdias,
        vencimento = pvencimento,
        frequencia = pfrequencia,
        ano_frequencia = pano_frequencia


        WHERE id_repag_efetivo  = pid_repag_efetivo;
        
      SELECT * FROM tb_repag_efetivos WHERE id_repag_efetivo = pid_repag_efetivo;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_alterar_repag_temporario` (IN `pid_repag_temporario` INT(11), IN `pid_beneficio` INT(11), IN `pid_itinerarios` INT(11), IN `pjus` DOUBLE, IN `pvalor_recebido` DOUBLE, IN `pcusteio` DOUBLE, IN `preceber` DOUBLE, IN `pdevolver` DOUBLE, IN `pdias` INT(60), IN `pvencimento` DOUBLE, IN `pfrequencia` VARCHAR(30), IN `pano_frequencia` VARCHAR(20))  NO SQL BEGIN
   
   UPDATE tb_repag_temporarios
    SET
        id_repag_temporario = pid_repag_temporario,
        id_beneficio = pid_beneficio, 
        id_itinerarios = pid_itinerarios,
        jus = pjus,
        valor_recebido = pvalor_recebido,
        custeio = pcusteio,
        receber = preceber,
        devolver = pdevolver,
        dias = pdias,
        vencimento = pvencimento,
        frequencia = pfrequencia,
        ano_frequencia = pano_frequencia


        WHERE id_repag_temporario  = pid_repag_temporario ;
        
      SELECT * FROM tb_repag_temporarios WHERE id_repag_temporario  = pid_repag_temporario;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_alterar_transporte_efetivos` (IN `pid_beneficio_efetivo` INT(11), IN `pid_efetivo` INT(11), IN `pid_itinerarios` INT(11), IN `pid_usuario` INT(11), IN `pbeneficio` VARCHAR(60), IN `pprocesso` VARCHAR(60), IN `pdata_processo` DATE, IN `psituacao` VARCHAR(60), IN `pmes` VARCHAR(30), IN `pano` VARCHAR(20), IN `preferencia` VARCHAR(60))   BEGIN
    UPDATE tb_beneficios_efetivos
    SET
    id_beneficio_efetivo = pid_beneficio_efetivo,
    id_efetivo = pid_efetivo,
    id_itinerarios = pid_itinerarios,
    id_usuario = pid_usuario,
    beneficio = pbeneficio,
    processo = pprocesso,
    data_processo = pdata_processo,
    situacao = psituacao,
    mes = pmes,
    ano = pano,
    referencia = preferencia
    
   
    
      WHERE id_beneficio_efetivo = pid_beneficio_efetivo;

  SELECT * FROM tb_beneficios_efetivos  WHERE id_beneficio_efetivo = pid_beneficio_efetivo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_altera_analista_termo` (IN `pid_termos` INT(11), IN `pid_usuario` INT(11))   BEGIN
 
    UPDATE tb_termos
    SET
        id_usuario = pid_usuario
        
        WHERE id_termos = pid_termos;
        
        
          SELECT * FROM tb_termos WHERE id_termos = pid_termos;
        
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_arquivo_documento_add` (IN `pid_documento` INT(11), IN `pid_usuario` INT(11), IN `parquivo_documento` VARCHAR(64))  NO SQL BEGIN

INSERT INTO tb_arquivos_documentos (id_documento,id_usuario,arquivo_documento)
    VALUES(pid_documento,pid_usuario,parquivo_documento);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_arquivo_dossie_add` (IN `pid_dossie` INT(11), IN `pid_usuario` INT(11), IN `parquivo_dossie` VARCHAR(60), IN `pano_arquivo` VARCHAR(60))  NO SQL BEGIN

INSERT INTO tb_arquivos_dossiers (id_dossie,id_usuario,arquivo_dossie,ano_arquivo)
    VALUES(pid_dossie,pid_usuario,parquivo_dossie,pano_arquivo);


 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_cidades` (IN `pcidade` VARCHAR(60))   BEGIN
     INSERT INTO  tb_cidades (cidade)
    VALUES(pcidade);
  SELECT * FROM  tb_cidades  WHERE id_cidade = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_componentes` (IN `pcomponente` VARCHAR(60))   BEGIN
     INSERT INTO  tb_componentes (componente)
    VALUES(pcomponente);
  SELECT * FROM  tb_componentes  WHERE id_componente = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_coordenadores` (IN `pid_unidade` INT(11), IN `pcoordenador_pedagogico` VARCHAR(60))  NO SQL BEGIN
 DECLARE vid_unidade INT;
     INSERT INTO  tb_coordenadores (id_unidade,coordenador_pedagogico)
    VALUES(pid_unidade,pcoordenador_pedagogico);
 
 SELECT * FROM  tb_coordenadores a INNER JOIN tb_unidades b USING(id_unidade) WHERE a.id_coordenador = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_informacao` (IN `pid_usuario` INT(11), IN `ptitulo` VARCHAR(64), IN `pinformacoes` TEXT)   BEGIN
   
    INSERT INTO tb_informacoes
    (id_usuario,titulo,informacoes     
    )
    
    VALUES(pid_usuario,ptitulo,pinformacoes
     );
    
  
  SELECT * FROM tb_informacoes  WHERE id_informacao = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_itinerarios` (IN `pid_usuario` INT(11), IN `pnome_itinerario` VARCHAR(60), IN `pcidade` VARCHAR(60), IN `pobservacoes` TEXT)  NO SQL BEGIN
   
    INSERT INTO tb_itinerarios
    (id_usuario,nome_itinerario,cidade,observacoes
    )
    
    VALUES(pid_usuario,pnome_itinerario,pcidade,pobservacoes
     );
    
  
  SELECT * FROM tb_itinerarios  WHERE id_itinerarios = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_itinerario_linhas` (IN `pid_itinerarios` INT(11), IN `pid_linha` INT(11))  NO SQL BEGIN
 DECLARE vid_itinerarios INT;
     INSERT INTO  tb_itinerarios_linhas (id_itinerarios,id_linha)
    VALUES(pid_itinerarios,pid_linha);
 
 SELECT * FROM  tb_itinerarios_linhas a INNER JOIN tb_itinerarios b USING(id_itinerarios) WHERE a.id_itinerarios_linhas = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_supervisores` (IN `pid_unidade` INT(11), IN `psupervisor` VARCHAR(60))  NO SQL BEGIN
 DECLARE vid_unidade INT;
     INSERT INTO  tb_supervisores (id_unidade,supervisor)
    VALUES(pid_unidade,psupervisor);
 
 SELECT * FROM  tb_supervisores a INNER JOIN tb_unidades b USING(id_unidade) WHERE a.id_supervisor = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_unidade` (IN `pid_usuario` INT(11), IN `pnome` VARCHAR(128), IN `psigla` VARCHAR(64), IN `plocalidade` VARCHAR(128), IN `ptelefone` VARCHAR(60), IN `punidade` VARCHAR(60))   BEGIN
INSERT INTO tb_unidades (id_usuario,nome,sigla,localidade,telefone,unidade)
    
    VALUES(pid_usuario,pnome,psigla,plocalidade,ptelefone,punidade);
    
    SELECT * FROM tb_unidades  WHERE id_unidade = LAST_INSERT_ID();
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cadastro_usuario` (IN `pnome_user` VARCHAR(64), IN `plogin` VARCHAR(64), IN `psenha` VARCHAR(256), IN `pemail` VARCHAR(128), IN `pinadmin` TINYINT(4), IN `pfoto` INT(64))   BEGIN
   
    INSERT INTO tb_usuarios (nome_user,login,senha,email,inadmin,foto)
    
    VALUES(pnome_user,plogin,psenha,pemail,pinadmin,pfoto);
    
    
  SELECT * FROM tb_usuarios  WHERE id_usuario = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_senha` (IN `pid_usuario` INT(11), IN `psenha` VARCHAR(256))   BEGIN
 
    UPDATE tb_usuarios
    SET
        senha = psenha
        
        WHERE id_usuario = pid_usuario;
        
        
          SELECT * FROM tb_usuarios WHERE id_usuario = pid_usuario;
        
        
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_editar_usuario` (IN `pid_usuario` INT(11), IN `pnome_user` VARCHAR(64), IN `pinadmin` TINYINT(4))   BEGIN
 
    UPDATE tb_usuarios
    SET
        nome_user = pnome_user,
        inadmin = pinadmin
       
        
        WHERE id_usuario = pid_usuario;
        
        
          SELECT * FROM tb_usuarios WHERE id_usuario = pid_usuario;
        
      
    
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_anotacoes` (IN `pid_anotacao` INT(11), IN `pid_usuario` INT(11), IN `pnome` VARCHAR(50), IN `panotacoes` TEXT)  NO SQL BEGIN
   
   UPDATE tb_anotacoes
    SET
        id_usuario = pid_usuario,
        nome = pnome,
        anotacoes = panotacoes
       
        
        WHERE id_anotacao = pid_anotacao;
        
      SELECT * FROM tb_anotacoes WHERE  id_anotacao = pid_anotacao;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_avaliacao` (IN `pid_avaliacao` INT(11), IN `pid_unidade` INT(11), IN `pid_usuario` INT(11), IN `psemestre` VARCHAR(60), IN `psituacao` VARCHAR(60), IN `pobservacao` TEXT)  NO SQL BEGIN
   
   UPDATE tb_avaliacoes
    SET
        id_avaliacao = pid_avaliacao,
        id_unidade = pid_unidade,    
        id_usuario = pid_usuario,
        semestre = psemestre,
        situacao = psituacao,
        observacao = pobservacao

        WHERE id_avaliacao = pid_avaliacao;
        
      SELECT * FROM tb_avaliacoes WHERE id_avaliacao = pid_avaliacao ;
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_beneficio` (IN `pid_beneficio` INT(11), IN `pbeneficio` VARCHAR(60), IN `pid_temporario` INT(11), IN `pid_usuario` INT(11), IN `pinicio` DATE, IN `pfim` DATE, IN `pprocesso` VARCHAR(60), IN `pcarencia` VARCHAR(60), IN `pdata_processo` DATE, IN `pmes` VARCHAR(20), IN `pano` VARCHAR(20), IN `psituacao` VARCHAR(60), IN `pexercicio` VARCHAR(20), IN `pobservacoes` TEXT)   BEGIN
UPDATE tb_beneficios
    SET
    id_beneficio = pid_beneficio,
    beneficio = pbeneficio,
    id_temporario = pid_temporario,
    id_usuario = pid_usuario,
    inicio = pinicio,
    fim = pfim,
    processo = pprocesso,
    carencia = pcarencia,
    data_processo = pdata_processo,
    mes = pmes,
    ano = pano,
    situacao = psituacao,
    exercicio = pexercicio,
    observacoes = pobservacoes
    
      WHERE id_beneficio = pid_beneficio;

  SELECT * FROM tb_beneficios  WHERE id_beneficio = pid_beneficio;
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_documento` (IN `pid_documento` INT(11), IN `pid_usuario` INT(11), IN `pnome_documento` TEXT, IN `pdt_documento` DATE)   BEGIN
 
    UPDATE tb_documentos
    SET
        id_usuario = pid_usuario,
        nome_documento = pnome_documento,
        dt_documento = pdt_documento
          
        WHERE id_documento = pid_documento;
        
      SELECT * FROM tb_documentos WHERE id_documento = pid_documento;

      END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_dossie` (IN `pid_dossie` INT(11), IN `pid_temporario` INT(11), IN `pid_usuario` INT(11), IN `pregime` VARCHAR(60))   BEGIN
 
    UPDATE tb_dossiers
    SET
        id_temporario = pid_temporario,
        id_usuario = pid_usuario,
        regime = pregime
          
        WHERE id_dossie = pid_dossie ;
        
      SELECT * FROM tb_dossiers WHERE id_dossie  = pid_dossie ;

      END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_efetivo` (IN `pid_efetivo` INT(11), IN `pid_unidade` INT(11), `pnome_servidor` VARCHAR(60), IN `pmatricula` VARCHAR(60), IN `pcarreira` VARCHAR(60))   BEGIN
 
    UPDATE tb_efetivos
    SET
        id_efetivo = pid_efetivo,
        id_unidade = pid_unidade,
        nome_servidor = pnome_servidor,
        matricula = pmatricula,
        carreira = pcarreira
        
        WHERE id_efetivo = pid_efetivo;
        
      SELECT * FROM tb_efetivos WHERE id_efetivo  = pid_efetivo ;

      END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_horas_pagas` (IN `pid_horas_pagas` INT(11), IN `pvalor_horas` DOUBLE, IN `pvencimento` DOUBLE, IN `preferencia1` DOUBLE, IN `preferencia2` INT(20))  NO SQL BEGIN
   
   UPDATE tb_horas_pagas
    SET
        id_horas_pagas = pid_horas_pagas,
        valor_horas = pvalor_horas,    
        vencimento = pvencimento,
        referencia1 = preferencia1,
        referencia2 = preferencia2

        WHERE id_horas_pagas  = pid_horas_pagas;
        
      SELECT * FROM tb_horas_pagas WHERE id_horas_pagas = pid_horas_pagas ;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_itinerario` (IN `pid_itinerarios` INT(11), IN `pid_usuario` INT(11), IN `pnome_itinerario` TEXT, IN `pcidade` VARCHAR(60), IN `pobservacoes` TEXT)  NO SQL BEGIN
   
   UPDATE tb_itinerarios
    SET
        id_itinerarios = pid_itinerarios,
        id_usuario = pid_usuario,    
        nome_itinerario = pnome_itinerario,
        cidade = pcidade,
        observacoes = pobservacoes
       
        WHERE id_itinerarios = pid_itinerarios;
        
      SELECT * FROM tb_itinerarios WHERE id_itinerarios = pid_itinerarios ;

    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_linhas` (IN `pid_linha` INT(11), IN `pcodigo` TEXT, IN `pcidade_linha` TEXT, IN `pvalor` DECIMAL(5,2), IN `pvalor_diario` DECIMAL(5,2))  NO SQL BEGIN
   
   UPDATE tb_linhas
    SET
        id_linha = pid_linha,
        codigo = pcodigo,    
        cidade_linha = pcidade_linha,
        valor = pvalor,
        valor_diario = pvalor_diario

        WHERE id_linha  = pid_linha;
        
      SELECT * FROM tb_linhas WHERE id_linha = pid_linha ;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_temporario` (IN `pid_temporario` INT(11), IN `pnome` VARCHAR(60), IN `pmatricula` VARCHAR(60), IN `pcpf` VARCHAR(60), IN `pcomponente` VARCHAR(60), IN `pano` VARCHAR(20))   BEGIN
 
    UPDATE tb_temporarios
    SET
        nome = pnome,
        matricula = pmatricula,
        cpf = pcpf,
        componente = pcomponente,
        ano = pano
        
        WHERE id_temporario = pid_temporario;
        
      SELECT * FROM tb_temporarios WHERE id_temporario  = pid_temporario ;

      END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_unidades` (IN `pid_unidade` INT(11), IN `pid_usuario` INT(11), IN `pnome` VARCHAR(128), IN `psigla` VARCHAR(64), IN `pcodigo` VARCHAR(128), IN `pdiretor` VARCHAR(60), IN `pvice_diretor` VARCHAR(60), IN `pchefe_secretaria` VARCHAR(60), IN `plocalidade` VARCHAR(128), IN `ptelefone` VARCHAR(60), IN `petapa` VARCHAR(60), IN `pqtd_turmas` INT(28), IN `pturnos` VARCHAR(64), IN `peducacao_integral` VARCHAR(28), IN `ptel_diretor` VARCHAR(20), IN `ptel_vice` VARCHAR(20), IN `ptel_chefe_secretaria` VARCHAR(20))   BEGIN
UPDATE tb_unidades
    SET
    id_unidade = pid_unidade,
    id_usuario = pid_usuario,
    nome = pnome,
    sigla = psigla,
    codigo = pcodigo,
    diretor = pdiretor,
    vice_diretor = pvice_diretor,
    chefe_secretaria = pchefe_secretaria,
    localidade = plocalidade,
    telefone = ptelefone,
    etapa = petapa,
    qtd_turmas = pqtd_turmas,
    turnos = pturnos,
    educacao_integral = peducacao_integral,
    tel_diretor = ptel_diretor,
    tel_vice = ptel_vice,
    tel_chefe_secretaria = ptel_chefe_secretaria
    
    
    
      WHERE id_unidade = pid_unidade;

  SELECT * FROM tb_unidades  WHERE id_unidade = pid_unidade;
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edita_unidades_administrativas` (IN `pid_unidade` INT(11), IN `pid_usuario` INT(11), IN `pnome` VARCHAR(128), IN `psigla` VARCHAR(64), IN `pcodigo` VARCHAR(128), IN `pcoordenador` VARCHAR(64), IN `punigep` VARCHAR(64), IN `puniae` VARCHAR(64), IN `puniag` VARCHAR(64), IN `punieb` VARCHAR(64), IN `puniplat` VARCHAR(64))   BEGIN
UPDATE tb_unidades
    SET
    id_unidade = pid_unidade,
    id_usuario = pid_usuario,
    nome = pnome,
    sigla = psigla,
    codigo = pcodigo,
    coordenador = pcoordenador,
    unigep = punigep,
    uniae = puniae,
    unieb = punieb,
    uniplat = puniplat
 
      WHERE id_unidade = pid_unidade;

  SELECT * FROM tb_unidades  WHERE id_unidade = pid_unidade;
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_edtitar_pagamentos` (IN `pid_pagamento` INT(11), IN `pid_temporario` INT(11), IN `pid_grade` INT(11), IN `pid_horas_pagas` INT(11), IN `pid_usuario` INT(11), IN `pcod_carencia` VARCHAR(20), IN `pdata_inicial` DATE, IN `pdata_final` DATE, IN `pdias` INT(20), IN `pdias_pagos` INT(20), IN `phoras_pagas` INT(20), IN `pvalor_horas_pagas` DOUBLE, IN `pvencimento_pag` DOUBLE, IN `pgaped` DOUBLE, IN `pgaa` DOUBLE, IN `pgazr` DOUBLE, IN `pgaee` DOUBLE, IN `psoma` DOUBLE, IN `pum_doze_avos` DOUBLE)  NO SQL BEGIN
   
    UPDATE tb_pagamentos
    SET
        id_pagamento = pid_pagamento,
        id_temporario = pid_temporario,
        id_grade = pid_grade,
        id_horas_pagas = pid_horas_pagas,
        id_usuario = pid_usuario,
        cod_carencia = pcod_carencia,
        data_inicial = pdata_inicial,
        data_final = pdata_final,
        dias = pdias,
        dias_pagos = pdias_pagos,
        horas_pagas = phoras_pagas,
        valor_horas_pagas = pvalor_horas_pagas,
        vencimento_pag = pvencimento_pag,
        gaped = pgaped,
        gaa = pgaa,
        gazr= pgazr,
        gaee= pgaee,
        soma= psoma,
        um_doze_avos= um_doze_avos
        
        WHERE id_pagamento = pid_pagamento;
        
      SELECT * FROM tb_pagamentos WHERE id_pagamento = pid_pagamento;
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_image_unidade_add` (IN `pid_unidade` INT(11), IN `pid_usuario` INT(11), IN `pnome_foto` VARCHAR(64))  NO SQL BEGIN

INSERT INTO tb_unidades_fotos (id_unidade,id_usuario,nome_foto)
    VALUES(pid_unidade,pid_usuario,pnome_foto);
   

 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_incluir_observacoes` (IN `pid_pagamento` INT(11), IN `pid_usuario` INT(11), IN `pobservacoes` TEXT)  NO SQL BEGIN
   
    UPDATE tb_pagamentos
    SET
        id_pagamento = pid_pagamento,
        id_usuario = pid_usuario,
        observacoes = pobservacoes

        WHERE id_pagamento = pid_pagamento;
        
      SELECT * FROM tb_pagamentos WHERE id_pagamento = pid_pagamento;
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_incluir_observacoes_transporte_efetivo` (IN `pid_beneficio_efetivo` INT(11), IN `pid_usuario` INT(11), IN `pobs_transporte_efetivo` TEXT)  NO SQL BEGIN
   
    UPDATE tb_beneficios_efetivos
    SET
        id_beneficio_efetivo = pid_beneficio_efetivo,
        id_usuario = pid_usuario,
        obs_transporte_efetivo = pobs_transporte_efetivo

        WHERE id_beneficio_efetivo = pid_beneficio_efetivo;
        
      SELECT * FROM tb_beneficios_efetivos WHERE id_beneficio_efetivo = pid_beneficio_efetivo;
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_informacao_editar` (IN `pid_informacao` INT(11), IN `palteracao` VARCHAR(60), IN `ptitulo` VARCHAR(64), IN `pinformacoes` TEXT)   BEGIN
   
   UPDATE tb_informacoes
    SET
        id_informacao = pid_informacao,
        alteracao = palteracao,
        titulo = ptitulo,
        informacoes = pinformacoes
        
        WHERE id_informacao  = pid_informacao;
        
      SELECT * FROM tb_informacoes WHERE id_informacao = pid_informacao;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_localidade_unidade_add` (IN `pid_unidade` INT(11), IN `pid_usuario` INT(11), IN `plng` FLOAT(25), IN `plat` FLOAT(25))   BEGIN
INSERT INTO tb_localidades (id_unidade,id_usuario,lng,lat)
    
    VALUES(pid_unidade,pid_usuario,plng,plat);
    SELECT * FROM tb_localidades  WHERE id_localidade = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_anotacoes` (IN `pid_usuario` INT(11), IN `pnome` VARCHAR(50), IN `panotacoes` TEXT)   BEGIN
   
    INSERT INTO tb_anotacoes
    (id_usuario,nome,anotacoes   
    )
    
    VALUES(pid_usuario,pnome,panotacoes 
     );
    
  
  SELECT * FROM tb_anotacoes  WHERE id_anotacao = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_avaliacao` (IN `pid_unidade` INT(11), IN `pid_usuario` INT(11), IN `psemestre` VARCHAR(60), IN `psituacao` VARCHAR(60), IN `pobservacao` TEXT)  NO SQL BEGIN
   
    INSERT INTO tb_avaliacoes
    (id_unidade,id_usuario,semestre,situacao,observacao    
    )
    
    VALUES (pid_unidade,pid_usuario,psemestre,psituacao,pobservacao    
    );
    
  
  SELECT * FROM tb_avaliacoes  WHERE id_avaliacao = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_beneficios` (IN `pbeneficio` VARCHAR(60), IN `pid_temporario` INT(11), IN `pid_usuario` INT(11), IN `pinicio` DATE, IN `pfim` DATE, IN `pprocesso` VARCHAR(60), IN `pcarencia` VARCHAR(60), IN `pdata_processo` DATE, IN `pmes` VARCHAR(20), IN `pano` VARCHAR(20), IN `psituacao` VARCHAR(60), IN `pexercicio` VARCHAR(20), IN `pobservacoes` TEXT)  NO SQL BEGIN
    INSERT INTO 
    tb_beneficios(beneficio,id_temporario,id_usuario,inicio,fim,processo,carencia,data_processo,mes,ano,situacao,exercicio,observacoes)
   VALUES(pbeneficio,pid_temporario,pid_usuario,pinicio,pfim,pprocesso,pcarencia,pdata_processo,pmes,pano,psituacao,pexercicio,pobservacoes);
 												
 SELECT * FROM  tb_beneficios  WHERE id_beneficio = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_documentos` (IN `pid_usuario` INT(11), IN `pnome_documento` TEXT, IN `pdt_documento` TEXT)  NO SQL BEGIN
   
    INSERT INTO tb_documentos
    (id_usuario,nome_documento,dt_documento
    
    )
    
    VALUES(pid_usuario,pnome_documento,pdt_documento  
    
     );
    
  
  SELECT * FROM tb_documentos  WHERE id_documento = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_dossiers` (IN `pid_usuario` INT(11), IN `pid_temporario` VARCHAR(60), IN `pregime` VARCHAR(60))  NO SQL BEGIN
   
    INSERT INTO tb_dossiers
    (id_usuario,id_temporario,regime)
    
    VALUES(pid_usuario,pid_temporario,pregime);
    
  
  SELECT * FROM tb_dossiers  WHERE id_dossie = LAST_INSERT_ID();
      
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_efetivo` (IN `pid_unidade` INT(11), IN `pnome_servidor` VARCHAR(60), IN `pmatricula` VARCHAR(60), IN `pcarreira` VARCHAR(60))  NO SQL BEGIN
   
    INSERT INTO tb_efetivos
    (id_unidade,nome_servidor,matricula,carreira)
    
    VALUES(pid_unidade,pnome_servidor,pmatricula,pcarreira);
    
  
  SELECT * FROM tb_efetivos  WHERE id_efetivo = LAST_INSERT_ID();
      
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_grades` (IN `pnome_progressao` VARCHAR(20), IN `pvalor` INT(20), IN `phora_padrao` DOUBLE)   BEGIN
   
    INSERT INTO tb_grades
    (nome_progressao,valor,hora_padrao   
    )
    
    VALUES(pnome_progressao,pvalor,phora_padrao
     );
    
  
  SELECT * FROM tb_grades  WHERE id_grade = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_historico` (IN `pusuario` VARCHAR(100), IN `pinformacao` TEXT)   BEGIN
     INSERT INTO  tb_historico_exclusao (usuario,informacao)
    VALUES(pusuario,pinformacao);
  SELECT * FROM  tb_historico_exclusao  WHERE id_historico = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_linhas` (IN `pcodigo` TEXT, IN `pcidade_linha` TEXT, IN `pvalor` DECIMAL(5,2), IN `pvalor_diario` DECIMAL(5,2))  NO SQL BEGIN
   
    INSERT INTO tb_linhas
    (codigo,cidade_linha,valor,valor_diario     
    )
    
    VALUES(pcodigo,pcidade_linha,pvalor,pvalor_diario
     );
    
  
  SELECT * FROM tb_linhas  WHERE id_linha = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_pagamentos` (IN `pid_temporario` INT(11), IN `pid_grade` INT(11), IN `pid_horas_pagas` INT(11), IN `pid_usuario` INT, IN `pcod_carencia` VARCHAR(20), IN `pdata_inicial` DATE, IN `pdata_final` DATE, IN `pdias` INT(20), IN `pdias_pagos` INT(20), IN `phoras_pagas` INT(20), IN `pvalor_horas_pagas` DOUBLE, IN `pvencimento_pag` DOUBLE, IN `pgaped` DOUBLE, IN `pgaa` DOUBLE, IN `pgazr` DOUBLE, IN `pgaee` DOUBLE, IN `psoma` DOUBLE, IN `pum_doze_avos` DOUBLE)  NO SQL BEGIN
   
    INSERT INTO tb_pagamentos
    (id_temporario,id_grade,id_horas_pagas,id_usuario,cod_carencia,data_inicial,data_final,dias,
	dias_pagos,horas_pagas,valor_horas_pagas,vencimento_pag,gaped,gaa,gazr,gaee,soma,um_doze_avos    
    )
    
    VALUES(pid_temporario,pid_grade,pid_horas_pagas,pid_usuario,pcod_carencia,pdata_inicial,pdata_final,pdias,
	pdias_pagos,phoras_pagas,pvalor_horas_pagas,pvencimento_pag,pgaped,pgaa,pgazr,pgaee,psoma,pum_doze_avos
     );
    
  
  SELECT * FROM tb_pagamentos  WHERE id_pagamento = LAST_INSERT_ID();
    
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_repag_efetivos` (IN `pid_beneficio_efetivo` INT(11), IN `pjus` DOUBLE, IN `pvalor_recebido` DOUBLE, IN `pcusteio` DOUBLE, IN `preceber` DOUBLE, IN `pdevolver` DOUBLE, IN `pdias` INT(60), IN `pvencimento` DOUBLE, IN `pfrequencia` VARCHAR(30), IN `pano_frequencia` VARCHAR(20))   BEGIN
    INSERT INTO 
     tb_repag_efetivos(id_beneficio_efetivo,jus,valor_recebido,custeio,receber,
    devolver,dias,vencimento,frequencia,ano_frequencia)
   VALUES(pid_beneficio_efetivo,pjus,pvalor_recebido,pcusteio,preceber,
    pdevolver,pdias,pvencimento,pfrequencia,pano_frequencia);
                                                
 SELECT * FROM   tb_repag_efetivos WHERE   id_repag_efetivo = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_repag_temporario` (IN `pid_beneficio` INT(11), IN `pid_itinerarios` INT(11), IN `pjus` DOUBLE, IN `pvalor_recebido` DOUBLE, IN `pcusteio` DOUBLE, IN `preceber` DOUBLE, IN `pdevolver` DOUBLE, IN `pdias` INT(60), IN `pvencimento` DOUBLE, IN `pfrequencia` VARCHAR(30), IN `pano_frequencia` VARCHAR(20))   BEGIN
    INSERT INTO 
     tb_repag_temporarios(id_beneficio,id_itinerarios,jus,valor_recebido,custeio,receber,
    devolver,dias,vencimento,frequencia,ano_frequencia)
   VALUES(pid_beneficio,pid_itinerarios,pjus,pvalor_recebido,pcusteio,preceber,
    pdevolver,pdias,pvencimento,pfrequencia,pano_frequencia);
                                                
 SELECT * FROM   tb_repag_temporarios WHERE   id_repag_temporario = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_temporario` (IN `pnome` VARCHAR(60), IN `pmatricula` VARCHAR(60), IN `pcpf` VARCHAR(60), IN `pcomponente` VARCHAR(60), IN `pano` VARCHAR(20))  NO SQL BEGIN
   
    INSERT INTO tb_temporarios
    (nome,matricula,cpf,componente,ano)
    
    VALUES(pnome,pmatricula,pcpf,pcomponente,pano);
    
  
  SELECT * FROM tb_temporarios  WHERE id_temporario = LAST_INSERT_ID();
      
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registro_transporte_efetivos` (IN `pid_efetivo` INT(11), IN `pid_itinerarios` INT(11), IN `pid_usuario` INT(11), IN `pbeneficio` VARCHAR(60), IN `pprocesso` VARCHAR(60), IN `pdata_processo` DATE, IN `psituacao` VARCHAR(60), IN `pmes` VARCHAR(30), IN `pano` VARCHAR(20), IN `preferencia` VARCHAR(60))   BEGIN
    INSERT INTO 
     tb_beneficios_efetivos(id_efetivo,id_itinerarios,id_usuario,beneficio,processo,data_processo,situacao,mes,ano,referencia)
   VALUES(pid_efetivo,pid_itinerarios,pid_usuario,pbeneficio,pprocesso,pdata_processo,psituacao,pmes,pano,preferencia);
                                                
 SELECT * FROM   tb_beneficios_efetivos WHERE id_beneficio_efetivo = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userspasswordsrecoveries_create` (`pid_usuario` INT, `pdesip` VARCHAR(45))   BEGIN
	
	INSERT INTO tb_userspasswordsrecoveries (id_usuario, desip)
    VALUES(pid_usuario, pdesip);
    
    SELECT * FROM tb_userspasswordsrecoveries WHERE idrecovery = LAST_INSERT_ID();
    
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_anotacoes`
--

CREATE TABLE `tb_anotacoes` (
  `id_anotacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `anotacoes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dt_registro_anotacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dt_registro_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_arquivos_documentos`
--

CREATE TABLE `tb_arquivos_documentos` (
  `id_arquivoD` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `arquivo_documento` text DEFAULT NULL,
  `dt_registro_arquivo_documento` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_arquivos_dossiers`
--

CREATE TABLE `tb_arquivos_dossiers` (
  `id_arquivo_dossie` int(11) NOT NULL,
  `id_dossie` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `arquivo_dossie` varchar(60) NOT NULL,
  `ano_arquivo` varchar(60) NOT NULL,
  `dt_registro_arquivo_dossie` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_avaliacoes`
--

CREATE TABLE `tb_avaliacoes` (
  `id_avaliacao` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `semestre` varchar(60) NOT NULL,
  `situacao` varchar(60) NOT NULL,
  `observacao` text NOT NULL,
  `dt_registro_avaliacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_beneficios`
--

CREATE TABLE `tb_beneficios` (
  `id_beneficio` int(11) NOT NULL,
  `id_temporario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `componente` varchar(60) NOT NULL,
  `beneficio` varchar(60) DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `fim` date DEFAULT NULL,
  `processo` varchar(60) DEFAULT NULL,
  `carencia` varchar(60) DEFAULT NULL,
  `data_processo` date DEFAULT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `ano` varchar(20) DEFAULT NULL,
  `situacao` varchar(60) DEFAULT NULL,
  `exercicio` varchar(20) NOT NULL,
  `total_transporte` double NOT NULL,
  `total_devolver` double NOT NULL,
  `observacoes` text DEFAULT NULL,
  `dt_registro_beneficio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_beneficios_efetivos`
--

CREATE TABLE `tb_beneficios_efetivos` (
  `id_beneficio_efetivo` int(11) NOT NULL,
  `id_efetivo` int(11) NOT NULL,
  `id_itinerarios` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `beneficio` varchar(60) NOT NULL,
  `processo` varchar(60) NOT NULL,
  `data_processo` date NOT NULL,
  `situacao` varchar(60) NOT NULL,
  `mes` varchar(30) NOT NULL,
  `ano` varchar(20) NOT NULL,
  `referencia` varchar(60) NOT NULL,
  `obs_transporte_efetivo` text NOT NULL,
  `total_transporte` double NOT NULL,
  `total_devolver` double NOT NULL,
  `dt_registro_beneficio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cidades`
--

CREATE TABLE `tb_cidades` (
  `id_cidade` int(11) NOT NULL,
  `cidade` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_componentes`
--

CREATE TABLE `tb_componentes` (
  `id_componente` int(11) NOT NULL,
  `componente` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_coordenadores`
--

CREATE TABLE `tb_coordenadores` (
  `id_coordenador` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `coordenador_pedagogico` varchar(60) DEFAULT NULL,
  `telefone_coordenador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_documentos`
--

CREATE TABLE `tb_documentos` (
  `id_documento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome_documento` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dt_documento` date DEFAULT NULL,
  `dt_registro_documento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_dossiers`
--

CREATE TABLE `tb_dossiers` (
  `id_dossie` int(11) NOT NULL,
  `id_temporario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `regime` varchar(60) NOT NULL,
  `dt_registro_dossie` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_efetivos`
--

CREATE TABLE `tb_efetivos` (
  `id_efetivo` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `nome_servidor` varchar(60) NOT NULL,
  `matricula` varchar(60) NOT NULL,
  `carreira` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_grades`
--

CREATE TABLE `tb_grades` (
  `id_grade` int(11) NOT NULL,
  `nome_progressao` varchar(20) NOT NULL,
  `valor` int(20) NOT NULL,
  `hora_padrao` double NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_historico_exclusao`
--

CREATE TABLE `tb_historico_exclusao` (
  `id_historico` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `informacao` text NOT NULL,
  `dt_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_horas_pagas`
--

CREATE TABLE `tb_horas_pagas` (
  `id_horas_pagas` int(11) NOT NULL,
  `mes` varchar(20) NOT NULL,
  `valor_horas` decimal(10,4) NOT NULL,
  `vencimento` double NOT NULL,
  `referencia1` double NOT NULL,
  `referencia2` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_informacoes`
--

CREATE TABLE `tb_informacoes` (
  `id_informacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `alteracao` varchar(60) DEFAULT NULL,
  `titulo` varchar(64) NOT NULL,
  `informacoes` text NOT NULL,
  `dt_registro_informacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dt_alteracao_informacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_itinerarios`
--

CREATE TABLE `tb_itinerarios` (
  `id_itinerarios` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cidade` varchar(60) NOT NULL,
  `nome_itinerario` varchar(60) DEFAULT NULL,
  `observacoes` text NOT NULL,
  `valor_total` decimal(5,2) DEFAULT 0.00,
  `dt_registro_itinerario` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_itinerarios_linhas`
--

CREATE TABLE `tb_itinerarios_linhas` (
  `id_itinerarios_linhas` int(11) NOT NULL,
  `id_itinerarios` int(11) DEFAULT NULL,
  `id_linha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_linhas`
--

CREATE TABLE `tb_linhas` (
  `id_linha` int(11) NOT NULL,
  `codigo` text DEFAULT NULL,
  `cidade_linha` varchar(60) DEFAULT NULL,
  `valor` decimal(5,2) DEFAULT NULL,
  `valor_diario` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_localidades`
--

CREATE TABLE `tb_localidades` (
  `id_localidade` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `dt_registro_localidade` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pagamentos`
--

CREATE TABLE `tb_pagamentos` (
  `id_pagamento` int(11) NOT NULL,
  `id_temporario` int(11) NOT NULL,
  `id_grade` int(11) NOT NULL,
  `id_horas_pagas` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cod_carencia` varchar(20) NOT NULL,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `dias` int(20) NOT NULL,
  `dias_pagos` int(20) NOT NULL,
  `horas_pagas` int(20) NOT NULL,
  `valor_horas_pagas` double NOT NULL,
  `vencimento_pag` double NOT NULL,
  `gaped` double NOT NULL,
  `gaa` double NOT NULL,
  `gazr` double NOT NULL,
  `gaee` double NOT NULL,
  `soma` double NOT NULL,
  `um_doze_avos` double NOT NULL,
  `observacoes` text DEFAULT NULL,
  `dt_registro_pagamento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_repag_efetivos`
--

CREATE TABLE `tb_repag_efetivos` (
  `id_repag_efetivo` int(11) NOT NULL,
  `id_beneficio_efetivo` int(11) NOT NULL,
  `jus` double NOT NULL,
  `valor_recebido` double NOT NULL,
  `custeio` double NOT NULL,
  `receber` double NOT NULL,
  `devolver` double NOT NULL,
  `dias` int(60) NOT NULL,
  `vencimento` double NOT NULL,
  `frequencia` varchar(30) NOT NULL,
  `ano_frequencia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_repag_temporarios`
--

CREATE TABLE `tb_repag_temporarios` (
  `id_repag_temporario` int(11) NOT NULL,
  `id_beneficio` int(11) NOT NULL,
  `id_itinerarios` int(11) NOT NULL,
  `jus` double NOT NULL,
  `valor_recebido` double NOT NULL,
  `custeio` double NOT NULL,
  `receber` double NOT NULL,
  `devolver` double NOT NULL,
  `dias` int(60) NOT NULL,
  `vencimento` double NOT NULL,
  `frequencia` varchar(30) NOT NULL,
  `ano_frequencia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_supervisores`
--

CREATE TABLE `tb_supervisores` (
  `id_supervisor` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `supervisor` varchar(60) DEFAULT NULL,
  `telefone_supervisor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_temporarios`
--

CREATE TABLE `tb_temporarios` (
  `id_temporario` int(11) NOT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `componente` varchar(60) DEFAULT NULL,
  `matricula` varchar(60) DEFAULT NULL,
  `cpf` varchar(60) DEFAULT NULL,
  `ano` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_unidades`
--

CREATE TABLE `tb_unidades` (
  `id_unidade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `sigla` varchar(64) DEFAULT NULL,
  `localidade` varchar(128) DEFAULT NULL,
  `telefone` varchar(60) DEFAULT NULL,
  `etapa` varchar(60) DEFAULT NULL,
  `unidade` varchar(60) DEFAULT NULL,
  `codigo` varchar(128) DEFAULT NULL,
  `diretor` varchar(60) DEFAULT NULL,
  `vice_diretor` varchar(60) DEFAULT NULL,
  `chefe_secretaria` varchar(60) DEFAULT NULL,
  `tel_diretor` varchar(20) NOT NULL,
  `tel_vice` varchar(20) NOT NULL,
  `tel_chefe_secretaria` varchar(20) NOT NULL,
  `qtd_turmas` int(11) DEFAULT NULL,
  `turnos` varchar(64) DEFAULT NULL,
  `educacao_integral` varchar(28) DEFAULT NULL,
  `coordenador` varchar(64) DEFAULT NULL,
  `unigep` varchar(64) DEFAULT NULL,
  `uniae` varchar(64) DEFAULT NULL,
  `uniag` varchar(64) DEFAULT NULL,
  `unieb` varchar(64) DEFAULT NULL,
  `uniplat` varchar(64) DEFAULT NULL,
  `dt_registro_unidade` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_unidades_fotos`
--

CREATE TABLE `tb_unidades_fotos` (
  `id_foto` int(11) NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome_foto` varchar(64) DEFAULT NULL,
  `dt_registro_foto` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_userspasswordsrecoveries`
--

CREATE TABLE `tb_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `nome_user` varchar(64) NOT NULL,
  `login` varchar(64) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `inadmin` tinyint(4) NOT NULL,
  `foto` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `email`, `data_registro`, `nome_user`, `login`, `senha`, `inadmin`, `foto`) VALUES
(1, 'admin@admin.net', '2021-08-04 07:33:56', 'Administrador ', 'admin', '$2y$12$Swu4v57pvo/EqaPJO444JeQHw7Qe3pUHP8kL5HnP7V0wou5.v.wUq', 1, '20230127020151');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_anotacoes`
--
ALTER TABLE `tb_anotacoes`
  ADD PRIMARY KEY (`id_anotacao`),
  ADD KEY `fk_anotacoes_usuarios` (`id_usuario`);

--
-- Índices de tabela `tb_arquivos_documentos`
--
ALTER TABLE `tb_arquivos_documentos`
  ADD PRIMARY KEY (`id_arquivoD`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Índices de tabela `tb_arquivos_dossiers`
--
ALTER TABLE `tb_arquivos_dossiers`
  ADD PRIMARY KEY (`id_arquivo_dossie`),
  ADD KEY `id_dossie` (`id_dossie`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_avaliacoes`
--
ALTER TABLE `tb_avaliacoes`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `id_unidade` (`id_unidade`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_beneficios`
--
ALTER TABLE `tb_beneficios`
  ADD PRIMARY KEY (`id_beneficio`),
  ADD KEY `id_temporario` (`id_temporario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_beneficios_efetivos`
--
ALTER TABLE `tb_beneficios_efetivos`
  ADD PRIMARY KEY (`id_beneficio_efetivo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_efetivo` (`id_efetivo`),
  ADD KEY `id_itinerarios` (`id_itinerarios`);

--
-- Índices de tabela `tb_cidades`
--
ALTER TABLE `tb_cidades`
  ADD PRIMARY KEY (`id_cidade`);

--
-- Índices de tabela `tb_componentes`
--
ALTER TABLE `tb_componentes`
  ADD PRIMARY KEY (`id_componente`);

--
-- Índices de tabela `tb_coordenadores`
--
ALTER TABLE `tb_coordenadores`
  ADD PRIMARY KEY (`id_coordenador`),
  ADD KEY `id_unidade` (`id_unidade`);

--
-- Índices de tabela `tb_documentos`
--
ALTER TABLE `tb_documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_dossiers`
--
ALTER TABLE `tb_dossiers`
  ADD PRIMARY KEY (`id_dossie`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_temporario` (`id_temporario`);

--
-- Índices de tabela `tb_efetivos`
--
ALTER TABLE `tb_efetivos`
  ADD PRIMARY KEY (`id_efetivo`),
  ADD KEY `id_unidade` (`id_unidade`);

--
-- Índices de tabela `tb_grades`
--
ALTER TABLE `tb_grades`
  ADD PRIMARY KEY (`id_grade`);

--
-- Índices de tabela `tb_historico_exclusao`
--
ALTER TABLE `tb_historico_exclusao`
  ADD PRIMARY KEY (`id_historico`);

--
-- Índices de tabela `tb_horas_pagas`
--
ALTER TABLE `tb_horas_pagas`
  ADD PRIMARY KEY (`id_horas_pagas`);

--
-- Índices de tabela `tb_informacoes`
--
ALTER TABLE `tb_informacoes`
  ADD PRIMARY KEY (`id_informacao`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_itinerarios`
--
ALTER TABLE `tb_itinerarios`
  ADD PRIMARY KEY (`id_itinerarios`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_itinerarios_linhas`
--
ALTER TABLE `tb_itinerarios_linhas`
  ADD PRIMARY KEY (`id_itinerarios_linhas`),
  ADD KEY `id_linha` (`id_linha`),
  ADD KEY `id_itinerarios` (`id_itinerarios`),
  ADD KEY `fk_itinerarios_linhas` (`id_itinerarios`) USING BTREE;

--
-- Índices de tabela `tb_linhas`
--
ALTER TABLE `tb_linhas`
  ADD PRIMARY KEY (`id_linha`);

--
-- Índices de tabela `tb_localidades`
--
ALTER TABLE `tb_localidades`
  ADD PRIMARY KEY (`id_localidade`),
  ADD KEY `id_unidade` (`id_unidade`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_pagamentos`
--
ALTER TABLE `tb_pagamentos`
  ADD PRIMARY KEY (`id_pagamento`),
  ADD KEY `id_temporario` (`id_temporario`),
  ADD KEY `id_grade` (`id_grade`),
  ADD KEY `id_horas_pagas` (`id_horas_pagas`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_repag_efetivos`
--
ALTER TABLE `tb_repag_efetivos`
  ADD PRIMARY KEY (`id_repag_efetivo`),
  ADD KEY `id_beneficio_efetivo` (`id_beneficio_efetivo`);

--
-- Índices de tabela `tb_repag_temporarios`
--
ALTER TABLE `tb_repag_temporarios`
  ADD PRIMARY KEY (`id_repag_temporario`),
  ADD KEY `id_beneficio` (`id_beneficio`),
  ADD KEY `id_itinerarios` (`id_itinerarios`);

--
-- Índices de tabela `tb_supervisores`
--
ALTER TABLE `tb_supervisores`
  ADD PRIMARY KEY (`id_supervisor`),
  ADD KEY `id_unidade` (`id_unidade`);

--
-- Índices de tabela `tb_temporarios`
--
ALTER TABLE `tb_temporarios`
  ADD PRIMARY KEY (`id_temporario`);

--
-- Índices de tabela `tb_unidades`
--
ALTER TABLE `tb_unidades`
  ADD PRIMARY KEY (`id_unidade`),
  ADD KEY `id_usuario` (`id_usuario`) USING BTREE;

--
-- Índices de tabela `tb_unidades_fotos`
--
ALTER TABLE `tb_unidades_fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_unidade` (`id_unidade`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD PRIMARY KEY (`idrecovery`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_anotacoes`
--
ALTER TABLE `tb_anotacoes`
  MODIFY `id_anotacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_arquivos_documentos`
--
ALTER TABLE `tb_arquivos_documentos`
  MODIFY `id_arquivoD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `tb_arquivos_dossiers`
--
ALTER TABLE `tb_arquivos_dossiers`
  MODIFY `id_arquivo_dossie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `tb_avaliacoes`
--
ALTER TABLE `tb_avaliacoes`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tb_beneficios`
--
ALTER TABLE `tb_beneficios`
  MODIFY `id_beneficio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT de tabela `tb_beneficios_efetivos`
--
ALTER TABLE `tb_beneficios_efetivos`
  MODIFY `id_beneficio_efetivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `tb_cidades`
--
ALTER TABLE `tb_cidades`
  MODIFY `id_cidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `tb_componentes`
--
ALTER TABLE `tb_componentes`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `tb_coordenadores`
--
ALTER TABLE `tb_coordenadores`
  MODIFY `id_coordenador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de tabela `tb_documentos`
--
ALTER TABLE `tb_documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `tb_dossiers`
--
ALTER TABLE `tb_dossiers`
  MODIFY `id_dossie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `tb_efetivos`
--
ALTER TABLE `tb_efetivos`
  MODIFY `id_efetivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `tb_grades`
--
ALTER TABLE `tb_grades`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_historico_exclusao`
--
ALTER TABLE `tb_historico_exclusao`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `tb_horas_pagas`
--
ALTER TABLE `tb_horas_pagas`
  MODIFY `id_horas_pagas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_informacoes`
--
ALTER TABLE `tb_informacoes`
  MODIFY `id_informacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_itinerarios`
--
ALTER TABLE `tb_itinerarios`
  MODIFY `id_itinerarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `tb_itinerarios_linhas`
--
ALTER TABLE `tb_itinerarios_linhas`
  MODIFY `id_itinerarios_linhas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de tabela `tb_linhas`
--
ALTER TABLE `tb_linhas`
  MODIFY `id_linha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de tabela `tb_localidades`
--
ALTER TABLE `tb_localidades`
  MODIFY `id_localidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de tabela `tb_pagamentos`
--
ALTER TABLE `tb_pagamentos`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tb_repag_efetivos`
--
ALTER TABLE `tb_repag_efetivos`
  MODIFY `id_repag_efetivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `tb_repag_temporarios`
--
ALTER TABLE `tb_repag_temporarios`
  MODIFY `id_repag_temporario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tb_supervisores`
--
ALTER TABLE `tb_supervisores`
  MODIFY `id_supervisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de tabela `tb_temporarios`
--
ALTER TABLE `tb_temporarios`
  MODIFY `id_temporario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT de tabela `tb_unidades`
--
ALTER TABLE `tb_unidades`
  MODIFY `id_unidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `tb_unidades_fotos`
--
ALTER TABLE `tb_unidades_fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  MODIFY `idrecovery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_anotacoes`
--
ALTER TABLE `tb_anotacoes`
  ADD CONSTRAINT `fk_anotacoes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_arquivos_documentos`
--
ALTER TABLE `tb_arquivos_documentos`
  ADD CONSTRAINT `fk_arquivos_documentos_documentos` FOREIGN KEY (`id_documento`) REFERENCES `tb_documentos` (`id_documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_arquivos_documentos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_arquivos_dossiers`
--
ALTER TABLE `tb_arquivos_dossiers`
  ADD CONSTRAINT `fk_arquivos_dossiers_dossiers` FOREIGN KEY (`id_dossie`) REFERENCES `tb_dossiers` (`id_dossie`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_arquivos_dossiers_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_beneficios`
--
ALTER TABLE `tb_beneficios`
  ADD CONSTRAINT `fk_beneficios_temporarios` FOREIGN KEY (`id_temporario`) REFERENCES `tb_temporarios` (`id_temporario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beneficios_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_beneficios_efetivos`
--
ALTER TABLE `tb_beneficios_efetivos`
  ADD CONSTRAINT `fk_beneficios_efetivos_efetivos` FOREIGN KEY (`id_efetivo`) REFERENCES `tb_efetivos` (`id_efetivo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beneficios_efetivos_itinerarios` FOREIGN KEY (`id_itinerarios`) REFERENCES `tb_itinerarios` (`id_itinerarios`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_beneficios_efetivos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_coordenadores`
--
ALTER TABLE `tb_coordenadores`
  ADD CONSTRAINT `fk_coordenadores_unidades` FOREIGN KEY (`id_unidade`) REFERENCES `tb_unidades` (`id_unidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_documentos`
--
ALTER TABLE `tb_documentos`
  ADD CONSTRAINT `fk_documentos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_dossiers`
--
ALTER TABLE `tb_dossiers`
  ADD CONSTRAINT `fk_dossieres_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dossiers_temporarios` FOREIGN KEY (`id_temporario`) REFERENCES `tb_temporarios` (`id_temporario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_efetivos`
--
ALTER TABLE `tb_efetivos`
  ADD CONSTRAINT `fk_efetivos_unidades` FOREIGN KEY (`id_unidade`) REFERENCES `tb_unidades` (`id_unidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_informacoes`
--
ALTER TABLE `tb_informacoes`
  ADD CONSTRAINT `fk_informacoes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_itinerarios`
--
ALTER TABLE `tb_itinerarios`
  ADD CONSTRAINT `fk_termos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_itinerarios_linhas`
--
ALTER TABLE `tb_itinerarios_linhas`
  ADD CONSTRAINT `fk_itinerarios_linhas_itinerarios` FOREIGN KEY (`id_itinerarios`) REFERENCES `tb_itinerarios` (`id_itinerarios`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_itinerarios_linhas_linhas` FOREIGN KEY (`id_linha`) REFERENCES `tb_linhas` (`id_linha`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_localidades`
--
ALTER TABLE `tb_localidades`
  ADD CONSTRAINT `fk_localidade_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `tb_unidades` (`id_unidade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_localidade_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_pagamentos`
--
ALTER TABLE `tb_pagamentos`
  ADD CONSTRAINT `fk_pagamentos_grades_horarias` FOREIGN KEY (`id_grade`) REFERENCES `tb_grades` (`id_grade`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pagamentos_horas_pagas` FOREIGN KEY (`id_horas_pagas`) REFERENCES `tb_horas_pagas` (`id_horas_pagas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pagamentos_temporarios` FOREIGN KEY (`id_temporario`) REFERENCES `tb_temporarios` (`id_temporario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pagamentos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_repag_temporarios`
--
ALTER TABLE `tb_repag_temporarios`
  ADD CONSTRAINT `fk_repag_beneficios_temporarios` FOREIGN KEY (`id_beneficio`) REFERENCES `tb_beneficios` (`id_beneficio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repag_itinerarios` FOREIGN KEY (`id_itinerarios`) REFERENCES `tb_itinerarios` (`id_itinerarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_supervisores`
--
ALTER TABLE `tb_supervisores`
  ADD CONSTRAINT `fk_supervisores_unidades` FOREIGN KEY (`id_unidade`) REFERENCES `tb_unidades` (`id_unidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_unidades`
--
ALTER TABLE `tb_unidades`
  ADD CONSTRAINT `fk_unidades_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_unidades_fotos`
--
ALTER TABLE `tb_unidades_fotos`
  ADD CONSTRAINT `fk_unidade_fotos_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `tb_unidades` (`id_unidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_userspasswordsrecoveries`
--
ALTER TABLE `tb_userspasswordsrecoveries`
  ADD CONSTRAINT `fk_userspasswordsrecoveries_users` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
