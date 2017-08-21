# OLX Desafio Tecnológico

## O Desafio

Escrever um formulário de cadastro, simples, 10 campos para persistência, 12 campos no total com a confirmação de email e senha, SEM UTILIZAR NENHUM FRAMEWORK DE MERCADO.
Nunca me vi nessa situação, sempre busco ferramentas que irão deixar meu trabalho mais rápido. Realmente percebi como ficamos perdidos e sem referências quando temos que recriar todo o nosso ambiente de trabalho do zero.

## O Ambiente

Todo o sistema foi desenvolvido utilizando *PHP v7.1*, *MariaDB v10.2.7*, *Twitter bootstrap v3.3.7*, e *docker* rodando os serviços de *banco de dados, webserver (Ngix) e o php-fpm*.
Perdi algum tempo preparando o ambiente, mas sei que ele irá me servir para outros estudos, consegui com este desafio um ambiente de desenvolvimento pra não só o uso do PHP, MariaDB e Nginx, mas um ambiente que pode ser replicado em qualquerl lugar desde que o docker e o docker-compose estejam instalados, e de preferência numa máquina que esteja com um sistema operacional ***NIX-like, como Linux, MacOSX, FreeBSD, etc**.

## O Desenvolvimento

Após os serviços estarem rodando e funcionando, foi a vez de preparar as ferramentas, ou seja, nosso código com um pouco do que conhecemos de framework.
Procurei utilizar as normas **[PSR](http://www.php-fig.org/psr/)** e boas práticas de desenvolvimento utilizando *design patterns*.
Um orgulho nesse projeto foi consegui no pouco tempo que pude me dedicar a este desafio foi o uso de **PSR-4** para o autoload das *classes e namespaces* por todo o sistema e o uso de **strategy e singleton** na classe de conexão ao banco, onde posso escrever outras classes para outros SGBDs e a criação de uma classe *singleton* para a guarda das variáveis importantes para o funcionamento do projeto como um todo.

## O algoritmo para a força da senha

A senha deve ter no mínimo 6 caracteres, pelo menos 1 letra e um número.
Essa é a regra para o mínimo de viabilidade da senha para se cadastrar.

Cada letra é um ponto e cada número é outro. Para o usuário de cadastrar a senha deve ter o minimo de 6 pontos.
Cada letra maiúscula é mais um ponto e caracteres especiais como / e _ são 2 pontos.
Se a senha dor menor que 8 pontos (e maior que 6) ela é fraca. Acima disso considero uma senha forte.

## Como instalar o ambiente

Todo o sistema foi feito com o uso de serviços Docker.
Eu desenvolvi utilizando MacOSX, portanto, para os usuários de Linux não terão problemas.
Caso tenha, fiquem à vontade para tirar dúvidas ou qq outra informação necessária.

Bom, como dito antes, o mínimos necessário:

 - **Git** instalado;
 - **Docker** e **Docker compose** instalados;

Primeiramente, baixe o repositório como indicado:
``git clone git@github.com:lgmontenegro/form_subscription.git``
O Git irá gravar os arquivos em uma pasta chamada form_subscription, dentro da pasta onde você pediu para baixar o repositório.

Após baixar o repositório, entre na pasta ``form_subscription`` que o Git criou e verifique se o arquivo **docker-compose.yml** está na pasta inicial.
Se você instalou o **docker compose**, rode o seguinte comando:
``docker-compose up -d``
Esse comando irá levantar todos os serviços necessários para o funcionamento do sistema.
Após levantar os serviços, espere algo em torno de 1 minuto para executar o seguinte comando:
``docker exec -i database_container mysql -h localhost -u root -ppassword < sql_dump/create_database_table.sql``

Se vc receber um dos seguinte erro: 
``ERROR 2002 (HY000): Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)``
ou
``ERROR 1045 (28000): Access denied for user 'root'@'localhost' (using password: YES)``

Espere um momento e tente novamente. Provavelmente os serviços ainda não terminaram de levantar por completo.

Após esses processos é só acessar o endereço 127.0.0.1 no seu navegador.

# Obrigado pela oportunidade!