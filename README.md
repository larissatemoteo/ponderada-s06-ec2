# Sistema de Gerenciamento de Produtos e Fornecedores com AWS

Este repositório contém uma aplicação web completa para gerenciamento de produtos e fornecedores, desenvolvida como parte de uma atividade ponderada. O sistema é hospedado em uma instância EC2 da AWS, utilizando MySQL para armazenamento de dados, PHP para o backend e Apache como servidor web.

## Visão Geral
O sistema permite gerenciar um inventário de produtos e uma lista de fornecedores através de uma interface web intuitiva e moderna. Com esta aplicação, é possível:
- Cadastrar e visualizar produtos (nome, descrição, preço e estoque)
- Cadastrar e visualizar fornecedores (nome, email, telefone, status e avaliação)
- Excluir produtos e fornecedores
- Visualizar dados em tabelas organizadas com formatação visual

## Tecnologias Utilizadas
- **AWS EC2**: Para hospedagem da aplicação web
- **MySQL**: Banco de dados relacional
- **PHP**: Backend e processamento de dados
- **Apache**: Servidor web
- **HTML/CSS**: Interface do usuário
- **JavaScript**: Interatividade da interface

## Estrutura do Banco de Dados
### Tabela PRODUCTS
- **id**: INT (AUTO_INCREMENT, chave primária)
- **name**: VARCHAR(100)
- **description**: TEXT
- **price**: DECIMAL(10,2)
- **stock**: INT
- **created_at**: TIMESTAMP

### Tabela SUPPLIERS
- **id**: INT (AUTO_INCREMENT, chave primária)
- **name**: VARCHAR(100)
- **email**: VARCHAR(100)
- **phone**: VARCHAR(20)
- **active**: BOOLEAN
- **rating**: DECIMAL(3,1)
- **created_at**: TIMESTAMP

## Recursos da Interface
- Design responsivo
- Navegação por abas
- Validação de formulários
- Formatação visual para valores críticos (estoque baixo, status)
- Modal de confirmação para exclusão
- Alertas de feedback para o usuário

## Configuração do Ambiente
### Pré-requisitos
- Conta AWS
- Instância EC2 (recomendado: Amazon Linux 2023)
- Conhecimentos básicos de AWS, PHP, MySQL e Apache

### Passos para Instalação
1. **Configurar Instância EC2**:
   ```bash
   # Atualizar pacotes
   sudo dnf update -y
   
   # Instalar o servidor web Apache
   sudo dnf install -y httpd
   sudo systemctl start httpd
   sudo systemctl enable httpd
   
   # Instalar PHP e MySQL
   sudo dnf install -y php php-mysqlnd mysql mysql-server
   sudo systemctl start mysqld
   sudo systemctl enable mysqld
   ```
2. **Configurar Arquivo de Credenciais**:
   Crie o arquivo `inc/dbinfo.inc` com o seguinte conteúdo:
   ```php
   <?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'web_user');
   define('DB_PASSWORD', 'sua_senha');
   define('DB_DATABASE', 'sistema_gestao');
   ?>
   ```
3. **Implantar o Código**:
   Clone este repositório no diretório `/var/www/html/` da sua instância EC2.

## Uso da Aplicação
1. Acesse a aplicação pelo IP público da sua instância EC2
2. Navegue entre as abas "Produtos" e "Fornecedores"
3. Use os formulários para adicionar novos itens
4. Visualize os dados nas tabelas abaixo dos formulários
5. Use o botão "Excluir" para remover itens (com confirmação)

## Video da Aplicação
 
 [Link para o vídeo explicativo](https://drive.google.com/file/d/13_GxFP3h-0xZsU0mrhU1CmtfY1ZtHK1M/view?usp=sharing)
 

## Segurança
O sistema implementa diversas práticas de segurança:
- Validação de formulários no lado cliente e servidor
- Sanitização de dados com `htmlentities`
- Typecast para IDs e validação de tipos para campos numéricos
- Arquivo de configuração separado para credenciais de banco de dados

## Autor
Larissa Temoteo

## Observações
Este projeto foi desenvolvido seguindo as práticas recomendadas pela AWS para hospedagem de aplicações PHP/MySQL em instâncias EC2, mas com implementação própria e personalizada para atender às necessidades específicas do sistema de gerenciamento.
