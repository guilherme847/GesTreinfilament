# GESTREIN - Sistema de Gestão de Treinamentos

Sistema de gestão de treinamentos corporativos desenvolvido em Laravel 12 com Filament 3 para administração.

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Comandos Principais](#comandos-principais)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Documentação](#documentação)
- [Checklist de Funcionalidades](#checklist-de-funcionalidades)

## 🎯 Sobre o Projeto

O **GESTREIN** é um sistema completo para gerenciamento de treinamentos corporativos que permite:

- Cadastro e gerenciamento de treinamentos obrigatórios e opcionais
- Controle de colaboradores e seus treinamentos
- Acompanhamento de progresso e participação em treinamentos
- Emissão de certificados
- Sistema de notificações e alertas
- Gestão de empresas e setores

## 📦 Requisitos

### Software Necessário

- **PHP**: >= 8.2
- **Composer**: >= 2.0
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **MySQL**: >= 8.0 ou **MariaDB**: >= 10.5
- **Servidor Web**: Apache ou Nginx (ou usar `php artisan serve`)

### Extensões PHP Necessárias

- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PCRE
- PDO
- PDO_MySQL
- Tokenizer
- XML

## 🚀 Instalação

### 1. Clonar o Repositório

```bash
git clone <url-do-repositorio> GesTreinLaravel
cd GesTreinLaravel
```

### 2. Instalar Dependências do Composer

```bash
composer install
```

### 3. Instalar Dependências do NPM

```bash
npm install
```

### 4. Configurar o Ambiente

Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

### 5. Gerar Chave da Aplicação

```bash
php artisan key:generate
```

### 6. Configurar Banco de Dados

Edite o arquivo `.env` e configure as credenciais do banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestrein
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 7. Criar o Banco de Dados

```sql
CREATE DATABASE gestrein CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 8. Executar Migrations

```bash
php artisan migrate
```

### 9. Popular o Banco com Dados de Teste (Opcional)

```bash
php artisan db:seed
```

### 10. Compilar Assets

Para desenvolvimento:

```bash
npm run dev
```

Para produção:

```bash
npm run build
```

### 11. Iniciar o Servidor

```bash
php artisan serve
```

O sistema estará disponível em: `http://localhost:8000`

## ⚙️ Configuração

### Variáveis de Ambiente Importantes

#### Aplicação

```env
APP_NAME=GESTREIN
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000
```

#### Banco de Dados

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestrein
DB_USERNAME=root
DB_PASSWORD=
```

#### Painel Administrativo (Filament)

O painel administrativo está disponível em: `/admin`

Acesse com as credenciais criadas pelo seeder ou crie um usuário manualmente.

### Configuração de Permissões

O sistema utiliza os seguintes tipos de usuários:

- **admin**: Acesso total ao sistema
- **tecnico_seguranca**: Pode cadastrar treinamentos obrigatórios
- **rh**: Pode cadastrar colaboradores e treinamentos da área
- **instrutor**: Pode registrar presença e notas
- **colaborador**: Apenas consulta seus treinamentos

### Configuração de Storage

Para upload de arquivos (certificados, etc.), certifique-se de criar o link simbólico:

```bash
php artisan storage:link
```

## 📝 Comandos Principais

### Artisan Commands

```bash
# Iniciar servidor de desenvolvimento
php artisan serve

# Executar migrations
php artisan migrate

# Reverter última migration
php artisan migrate:rollback

# Recriar banco de dados (CUIDADO: apaga todos os dados)
php artisan migrate:fresh

# Executar migrations com seeders
php artisan migrate:fresh --seed

# Executar seeders
php artisan db:seed

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Otimizar aplicação (produção)
php artisan optimize

# Criar novo Filament Resource
php artisan make:filament-resource NomeModel --generate

# Listar todas as rotas
php artisan route:list
```

### NPM Commands

```bash
# Desenvolvimento com hot-reload
npm run dev

# Build para produção
npm run build

# Verificar erros
npm run lint
```

### Comandos Compostos

```bash
# Executar servidor + queue + logs + vite (desenvolvimento completo)
composer dev
```

## 📁 Estrutura do Projeto

```
GesTreinLaravel/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # Resources do Filament (CRUDs)
│   │   │   ├── EmpresaResource.php
│   │   │   ├── SetorResource.php
│   │   │   ├── TreinamentoResource.php
│   │   │   ├── UserResource.php
│   │   │   └── TurmaResource.php
│   │   └── Providers/
│   ├── Http/
│   │   └── Controllers/
│   └── Models/                 # Models Eloquent
├── database/
│   ├── migrations/             # Migrations do banco
│   ├── seeders/                # Seeders com dados de teste
│   └── factories/              # Factories para testes
├── resources/
│   ├── css/                    # Estilos CSS/Tailwind
│   ├── js/                     # JavaScript
│   └── views/                  # Views Blade
├── routes/
│   └── web.php                 # Rotas web
├── docs/                       # Documentação detalhada
│   ├── ROUTES.md
│   ├── ENTITIES.md
│   ├── FUNCTIONALITIES.md
│   └── FLOW.md
├── public/                     # Arquivos públicos
└── CHECKLIST.md                # Checklist de funcionalidades
```

## 📚 Documentação

A documentação detalhada está disponível na pasta `docs/`:

- **[Rotas e Páginas do Filament](docs/ROUTES.md)**: Documentação completa de todas as rotas e páginas administrativas
- **[Entidades e Relacionamentos](docs/ENTITIES.md)**: Estrutura do banco de dados, modelos e regras de negócio
- **[Funcionalidades](docs/FUNCTIONALITIES.md)**: Descrição detalhada das principais funcionalidades
- **[Fluxo Principal](docs/FLOW.md)**: Documentação dos fluxos do sistema (cadastro, matrícula, progresso, certificados)

## ✅ Checklist de Funcionalidades

Consulte o arquivo **[CHECKLIST.md](CHECKLIST.md)** para acompanhar o progresso de implementação das funcionalidades.

## 🔐 Primeiro Acesso

Após executar os seeders, você pode acessar o sistema com:

- **URL**: `http://localhost:8000/admin`
- **Usuário**: Verifique os dados no `UserSeeder.php`
- **Senha**: Verifique os dados no `UserSeeder.php`

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 12
- **Admin Panel**: Filament 3
- **Frontend**: Tailwind CSS 4, Alpine.js
- **Database**: MySQL/MariaDB
- **Build Tool**: Vite

## 📄 Licença

Este projeto é de uso interno e acadêmico.

## 👥 Suporte

Para dúvidas ou problemas, consulte a documentação na pasta `docs/` ou entre em contato com a equipe de desenvolvimento.

