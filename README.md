# Sistema de Gerenciamento Administrativo.

[![](https://img.shields.io/pypi/status/ok)](https://travis-ci.org/joemccann/dillinger)
## Descrição

- **Sistema de gerenciamento e controle de rotinas administrativas**
    >Projeto desenvolvido para facilitar o gerenciamento e controle das rotinas administrativas da Gestão de Pessoas da Coordenação de Ensino de São Sebastião visto que há uma alta demanda dessas funções, principalmente relacionadas a acertos financeiros.
    >Nesse controle de versão, todos dados disponibilizados são de testes somente utilizaods para demonstração da usabilidade do sistema.
    >Projeto sem vÍnculo com a SEDF, totalmente autoral, para substituir planilhas e automatizar rotinas administrativas, configurado em localhost.

## Tecnologias
- **Desenvolvimento**
    O desenvolvimento do projeto é a partir do **PHP Orientado a Objetos**, com auxílio da estrutura **PDO**, para fornecer uma camada de abstração em relação a conexão com o banco de dados. 
    As rotas são definidas pelo Micro Framework **Slim** em uma arquitetura **Model-View-Controller**.
    Os templates são gerados através da  classe **TPL(Rain TPL)**.
    Essa estrutura delimita o front-end do back-end.
    O sistema gerenciador de banco de dados relacional usado foi o [MySQL Workbench](https://www.mysql.com/products/workbench/) e [phpMyAdmin](https://www.phpmyadmin.net/), com auxílio do software  [DBeaver](https://dbeaver.io)

## Configuração habilitada

- **Tipo de servidor:** MySQL.
- **Apache/2.4.29**
- **Versão do PHP:** 7.2.24

  
 ## Instalações necessárias:

- [Composer](https://github.com/composer/composer)
- [Rain TPL](https://github.com/feulf/raintpl3)
- [Slim](https://www.slimframework.com/)
- [LAMP](https://www.techtudo.com.br/dicas-e-tutoriais/noticia/2012/11/como-instalar-lamp-no-linux.html) ou [WAMP](https://www.techtudo.com.br/tudo-sobre/wampserver.html) ou [XAMPP]() ou [MAMP](https://www.apachefriends.org/pt_br/index.html)
- [PHPMailler](https://github.com/PHPMailer/PHPMailer)

 ## Configurações:

- Recomendável configurar uma **Virtual Host** [LINUX](https://odesenvolvedor.com.br/como-configurar-um-dominio-com-lamp-linux-apache-mysql-php.html) ou [WINDOWS](https://hcode.com.br/blog/como-configurar-apache-virtual-hosts-no-windows)
- **Composer.Json**: configurar esse arquivo e instalar as dependências caso seja necessário.

 ## Acesso ao sistema:
- **Usuário:** http://localhost
- **Administrador:** http://localhost/admin/login
- **Login:** admin
- **Senha:** admin