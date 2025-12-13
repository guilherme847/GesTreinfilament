# Documentação de Rotas e Páginas do Filament

Este documento descreve todas as rotas web e as páginas administrativas (Filament Resources) do sistema GESTREIN.

## 📍 Rotas Web

### Rotas Públicas

| Método | Rota | Descrição | Controller/Action |
|--------|------|-----------|-------------------|
| GET | `/` | Página inicial (Welcome) | Closure |
| GET | `/introducao` | Página de introdução do sistema | `ManualController@__invoke` |

### Rotas de Autenticação (Filament)

Todas as rotas de autenticação são gerenciadas pelo Filament:

- **Login**: `/admin/login`
- **Logout**: `/admin/logout`
- **Recuperação de Senha**: `/admin/password/reset`

## 🎛️ Painel Administrativo (Filament)

**URL Base**: `/admin`

O painel administrativo utiliza o Filament 3 e está configurado no arquivo `app/Providers/Filament/AdminPanelProvider.php`.

### Recursos (Resources)

Os Resources do Filament são descobertos automaticamente através do método `discoverResources()`.

#### 1. TreinamentoResource

**Rota Base**: `/admin/treinamentos`

**Páginas Disponíveis**:

| Página | Rota | Descrição |
|--------|------|-----------|
| Listar | `/admin/treinamentos` | Lista todos os treinamentos cadastrados |
| Criar | `/admin/treinamentos/create` | Formulário para cadastrar novo treinamento |
| Visualizar | `/admin/treinamentos/{id}` | Visualizar detalhes de um treinamento |
| Editar | `/admin/treinamentos/{id}/edit` | Formulário para editar treinamento |

**Funcionalidades**:
- ✅ CRUD completo (Create, Read, Update, Delete)
- ✅ Filtros por Tipo, Modalidade, Status
- ✅ Busca por nome
- ✅ Badges coloridos para Tipo e Status
- ✅ Ordenação por data de criação

**Permissões**: 
- Acesso permitido para: `admin`, `tecnico_seguranca`, `rh`

#### 2. UserResource (Colaboradores)

**Rota Base**: `/admin/users`

**Páginas Disponíveis**:

| Página | Rota | Descrição |
|--------|------|-----------|
| Listar | `/admin/users` | Lista todos os colaboradores |
| Criar | `/admin/users/create` | Formulário para cadastrar novo colaborador |
| Visualizar | `/admin/users/{id}` | Visualizar detalhes do colaborador |
| Editar | `/admin/users/{id}/edit` | Formulário para editar colaborador |

**Funcionalidades**:
- ✅ CRUD completo
- ✅ Gestão de senha (hash automático)
- ✅ Seleção de empresa e setor com criação rápida
- ✅ Filtros por Tipo, Empresa, Setor, Status
- ✅ Badges coloridos para tipo de usuário

**Permissões**: 
- Acesso permitido para: `admin`, `rh`

#### 3. TurmaResource (Participações)

**Rota Base**: `/admin/turmas`

**Páginas Disponíveis**:

| Página | Rota | Descrição |
|--------|------|-----------|
| Listar | `/admin/turmas` | Lista todas as participações em treinamentos |
| Criar | `/admin/turmas/create` | Formulário para matricular colaborador em treinamento |
| Visualizar | `/admin/turmas/{id}` | Visualizar detalhes da participação |
| Editar | `/admin/turmas/{id}/edit` | Atualizar progresso e status |

**Funcionalidades**:
- ✅ CRUD completo
- ✅ Vinculação de colaborador a treinamento
- ✅ Seleção automática de modalidade baseada no treinamento
- ✅ Controle de status (pendente, em andamento, concluída, cancelada)
- ✅ Rastreamento de etapas teórica e prática
- ✅ Filtros por Treinamento, Status, Instrutor

**Permissões**: 
- Acesso permitido para: `admin`, `tecnico_seguranca`, `rh`, `instrutor`

#### 4. EmpresaResource

**Rota Base**: `/admin/empresas`

**Páginas Disponíveis**:

| Página | Rota | Descrição |
|--------|------|-----------|
| Listar | `/admin/empresas` | Lista todas as empresas |
| Criar | `/admin/empresas/create` | Formulário para cadastrar empresa |
| Visualizar | `/admin/empresas/{id}` | Visualizar detalhes da empresa |
| Editar | `/admin/empresas/{id}/edit` | Formulário para editar empresa |

**Funcionalidades**:
- ✅ CRUD completo
- ✅ Máscaras de entrada (CNPJ, CEP, Telefone)
- ✅ Validação de CNPJ único
- ✅ Filtro por status (Ativa/Inativa)

**Permissões**: 
- Acesso permitido para: `admin`, `rh`

#### 5. SetorResource

**Rota Base**: `/admin/setors`

**Páginas Disponíveis**:

| Página | Rota | Descrição |
|--------|------|-----------|
| Listar | `/admin/setors` | Lista todos os setores |
| Criar | `/admin/setors/create` | Formulário para cadastrar setor |
| Visualizar | `/admin/setors/{id}` | Visualizar detalhes do setor |
| Editar | `/admin/setors/{id}/edit` | Formulário para editar setor |

**Funcionalidades**:
- ✅ CRUD completo
- ✅ Contador de colaboradores por setor
- ✅ Validação de nome único

**Permissões**: 
- Acesso permitido para: `admin`, `rh`

### Navegação no Painel

O painel está organizado em grupos de navegação:

#### Grupo: Gestão
- **Treinamentos** (`/admin/treinamentos`)
- **Colaboradores** (`/admin/users`)
- **Participações** (`/admin/turmas`)

#### Grupo: Cadastros
- **Empresas** (`/admin/empresas`)
- **Setors** (`/admin/setors`)

### Dashboard

**Rota**: `/admin`

Página inicial do painel administrativo com widgets padrão:
- Account Widget
- Filament Info Widget

## 🔐 Permissões e Acessos

O sistema utiliza o tipo de usuário (`tipo`) para controlar o acesso aos recursos:

### Tipos de Usuário

1. **admin**
   - ✅ Acesso total a todos os recursos
   - ✅ Pode gerenciar usuários, treinamentos, participações, empresas e setores

2. **tecnico_seguranca**
   - ✅ Pode cadastrar e gerenciar treinamentos obrigatórios
   - ✅ Pode visualizar e gerenciar participações
   - ❌ Não pode gerenciar colaboradores diretamente

3. **rh**
   - ✅ Pode cadastrar e editar colaboradores
   - ✅ Pode cadastrar empresas e setores
   - ✅ Pode criar treinamentos da área de RH
   - ✅ Pode gerenciar participações

4. **instrutor**
   - ✅ Pode visualizar treinamentos atribuídos
   - ✅ Pode atualizar progresso e status das participações
   - ✅ Pode registrar presença e notas
   - ❌ Não pode criar treinamentos ou gerenciar colaboradores

5. **colaborador**
   - ✅ Pode visualizar seus próprios treinamentos
   - ✅ Pode consultar certificados
   - ❌ Não tem acesso ao painel administrativo

### Implementação de Permissões

Atualmente, as permissões são baseadas no tipo de usuário. Para implementar controle mais granular, recomenda-se:

1. Usar Policies do Laravel
2. Implementar Gates
3. Utilizar plugins do Filament para roles/permissions

## 📝 Notas Importantes

### Descoberta Automática

O Filament descobre automaticamente:
- Resources em `app/Filament/Resources`
- Pages em `app/Filament/Pages`
- Widgets em `app/Filament/Widgets`

### Personalização

Para personalizar o painel, edite:
- `app/Providers/Filament/AdminPanelProvider.php` - Configurações do painel
- Resources individuais - Formulários e tabelas

### Cores da Marca

O painel utiliza as cores da marca GESTREIN:
- **Primary**: `#1a1f3a` (Azul marinho)
- **Danger**: `#ff6b35` (Laranja)
- **Info**: `#3b82f6` (Azul claro)

---

**Última atualização**: 30/11/2025

