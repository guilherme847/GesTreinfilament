# Documentação de Entidades e Relacionamentos

Este documento descreve todas as entidades do banco de dados, seus relacionamentos e as regras de negócio aplicadas.

## 📊 Diagrama de Relacionamentos

```
Empresa (1) ──< (N) User (Colaborador)
   │                    │
   │                    ├──< (N) Notificacao
   │                    ├──< (N) Certificado
   │                    ├──< (N) Turma (como aluno)
   │                    └──< (N) Turma (como instrutor)
   │
Setor (1) ────< (N) User (Colaborador)
   │
   └──< (N) Calendario

Treinamento (1) ──< (N) Etapa
   │                    │
   │                    └──< (N) CronogramaEtapas ──< (1) Turma
   │
   ├──< (N) Turma
   └──< (N) Calendario ──< (1) Periodo
```

## 🗄️ Entidades

### 1. Empresa

Armazena informações das empresas que utilizam o sistema.

**Tabela**: `empresas`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idEmpresa | foreignId | Referência interna | ✅ |
| Nome | string(255) | Nome da empresa | ✅ |
| Cnpj | string(18) | CNPJ (único) | ✅ |
| Endereco | string(45) | Endereço | ❌ |
| Cidade | string(100) | Cidade | ❌ |
| Estado | char(2) | UF (sigla do estado) | ❌ |
| Cep | string(10) | CEP | ❌ |
| Telefone | string(20) | Telefone de contato | ❌ |
| Email_contato | string(225) | E-mail de contato | ❌ |
| Ativo | tinyInteger | Status (1=Ativo, 0=Inativo) | ✅ (default: 1) |
| Numero_colaboradores | integer | Quantidade de colaboradores | ✅ (default: 0) |
| Data_cadastrado | timestamp | Data de cadastro | ❌ |

**Relacionamentos**:
- `hasMany(User)` - Uma empresa tem muitos colaboradores

**Regras de Negócio**:
- ✅ CNPJ deve ser único no sistema
- ✅ Empresa inativa não pode ter novos colaboradores vinculados
- ✅ `Numero_colaboradores` deve ser atualizado automaticamente ao vincular/desvincular colaboradores

---

### 2. Setor

Representa os setores/departamentos dentro das empresas.

**Tabela**: `setors`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idsetor | foreignId | Referência interna | ✅ |
| Nome_setor | string(45) | Nome do setor | ✅ |

**Relacionamentos**:
- `hasMany(User)` - Um setor tem muitos colaboradores
- `hasMany(Calendario)` - Um setor pode ter vários calendários de treinamentos

**Regras de Negócio**:
- ✅ Nome do setor deve ser único por empresa (não implementado na migração atual)

---

### 3. User (Colaborador)

Usuários do sistema, podem ser colaboradores, instrutores, RH, técnicos de segurança ou administradores.

**Tabela**: `users`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| name | string | Nome completo | ✅ |
| email | string (unique) | E-mail (único) | ✅ |
| email_verified_at | timestamp | Data de verificação do e-mail | ❌ |
| password | string (hashed) | Senha (criptografada) | ✅ |
| tipo | enum | Tipo: admin, tecnico_seguranca, rh, instrutor, colaborador | ✅ (default: colaborador) |
| setor | string(100) | Setor (legado) | ❌ |
| funcao | string(100) | Função/Cargo | ❌ |
| ativo | boolean | Status ativo/inativo | ✅ (default: true) |
| data_cadastro | timestamp | Data de cadastro | ❌ |
| data_desligamento | date | Data de desligamento | ❌ |
| empresa_id | foreignId | Referência à Empresa | ❌ |
| setor_id | foreignId | Referência ao Setor | ❌ |
| remember_token | string(100) | Token para "lembrar-me" | ❌ |
| created_at | timestamp | Data de criação | ✅ |
| updated_at | timestamp | Data de atualização | ✅ |

**Relacionamentos**:
- `belongsTo(Empresa)` - Pertence a uma empresa
- `belongsTo(Setor)` - Pertence a um setor
- `hasMany(Notificacao)` - Tem muitas notificações
- `hasMany(Certificado)` - Tem muitos certificados
- `hasMany(Turma)` como `aluno` - Tem muitas turmas como aluno
- `hasMany(Turma)` como `instrutor` - Tem muitas turmas como instrutor

**Regras de Negócio**:
- ✅ E-mail deve ser único no sistema
- ✅ Senha deve ter no mínimo 8 caracteres (regra de validação)
- ✅ Usuário inativo não pode fazer login
- ✅ Data de desligamento deve ser posterior à data de cadastro
- ✅ Tipo de usuário determina permissões no sistema
- ✅ Ao desativar usuário, deve-se considerar data de desligamento

---

### 4. Treinamento

Representa um treinamento disponível no sistema.

**Tabela**: `treinamentos`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idTreinamento | foreignId | Referência interna | ✅ |
| Nome | string(225) | Nome do treinamento | ✅ |
| Descricao | text(3000) | Descrição detalhada | ❌ |
| Carga_horaria | integer | Carga horária em horas | ✅ |
| Tipo | string | Tipo: obrigatorio, opcional, reciclagem, inicial | ✅ |
| Modalidade | string | Modalidade: presencial, online, hibrido | ✅ |
| Validade_meses | integer | Validade do treinamento em meses | ✅ |
| requer_validacao_pratica | tinyInteger | Requer validação prática (1=Sim, 0=Não) | ✅ (default: 0) |
| Data_da_criacao | timestamp | Data de criação | ❌ |
| Status | string | Status: ativo, inativo, arquivado | ✅ (default: ativo) |

**Relacionamentos**:
- `hasMany(Etapa)` - Um treinamento tem muitas etapas
- `hasMany(Turma)` - Um treinamento tem muitas turmas/participações
- `hasMany(Calendario)` - Um treinamento pode estar em vários calendários

**Regras de Negócio**:
- ✅ Carga horária deve ser maior que zero
- ✅ Validade em meses deve ser maior que zero
- ✅ Treinamento arquivado não pode ter novas matrículas
- ✅ Treinamento obrigatório deve ter validade definida
- ✅ Se `requer_validacao_pratica = 1`, o treinamento deve ter etapa prática

---

### 5. Etapa

Representa uma etapa/fase de um treinamento.

**Tabela**: `etapas`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idetapa | foreignId | Referência interna | ✅ |
| Nome | string(255) | Nome da etapa | ❌ |
| Descricao | text | Descrição da etapa | ❌ |
| Ordem | integer | Ordem de execução | ❌ |
| treinamento_id | foreignId | Referência ao Treinamento | ✅ |

**Relacionamentos**:
- `belongsTo(Treinamento)` - Pertence a um treinamento
- `belongsToMany(Turma)` através de `cronograma_etapas` - Muitas turmas têm muitas etapas

**Regras de Negócio**:
- ✅ Ordem deve ser sequencial e única por treinamento
- ✅ Etapas devem ser concluídas na ordem definida

---

### 6. Turma (Participação)

Representa a participação de um colaborador em um treinamento.

**Tabela**: `turmas`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| aluno_id | foreignId | Referência ao User (aluno) | ✅ |
| instrutor_id | foreignId | Referência ao User (instrutor) | ❌ |
| treinamento_id | foreignId | Referência ao Treinamento | ✅ |
| Data_vinculo | timestamp | Data de vínculo/matrícula | ❌ |
| Data_prevista_conclusao | date | Data prevista para conclusão | ❌ |
| Data_conclusao | date | Data real de conclusão | ❌ |
| Etapa_teorica_status | enum | Status: pendente, em_andamento, concluida, cancelada | ❌ |
| Etapa_teorica_data | date | Data da etapa teórica | ❌ |
| Etapa_pratica_data | timestamp | Data da etapa prática | ❌ |
| Status_geral | enum | Status geral: pendente, em_andamento, concluida, cancelada | ✅ (default: pendente) |
| Forma_realizacao | enum | Forma: presencial, online, hibrido | ❌ |
| Observacao | text(500) | Observações | ❌ |
| created_at | timestamp | Data de criação | ✅ |
| updated_at | timestamp | Data de atualização | ✅ |

**Relacionamentos**:
- `belongsTo(User)` como `aluno` - Pertence a um colaborador (aluno)
- `belongsTo(User)` como `instrutor` - Pertence a um instrutor
- `belongsTo(Treinamento)` - Pertence a um treinamento
- `belongsToMany(Etapa)` através de `cronograma_etapas` - Muitas etapas

**Regras de Negócio**:
- ✅ Colaborador não pode estar matriculado duas vezes no mesmo treinamento ativo
- ✅ Data de conclusão deve ser posterior à data de vínculo
- ✅ Data prevista de conclusão deve considerar a carga horária e disponibilidade
- ✅ Status geral = "concluida" apenas se todas as etapas estiverem concluídas
- ✅ Se treinamento requer validação prática, etapa prática é obrigatória
- ✅ Instrutor deve ter tipo = "instrutor"
- ✅ Aluno deve ter tipo = "colaborador"

---

### 7. CronogramaEtapas

Tabela intermediária que relaciona Turmas e Etapas, registrando o cronograma de execução.

**Tabela**: `cronograma_etapas`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| turma_id | foreignId | Referência à Turma | ✅ |
| etapa_id | foreignId | Referência à Etapa | ✅ |
| data | timestamp | Data agendada/realizada | ❌ |
| observacao | string(255) | Observações | ❌ |
| Status | enum | Status: agendado, realizado, cancelado | ✅ (default: agendado) |
| created_at | timestamp | Data de criação | ✅ |
| updated_at | timestamp | Data de atualização | ✅ |

**Relacionamentos**:
- `belongsTo(Turma)` - Pertence a uma turma
- `belongsTo(Etapa)` - Pertence a uma etapa

**Regras de Negócio**:
- ✅ Etapas devem seguir a ordem definida no treinamento
- ✅ Não é possível marcar etapa como concluída sem concluir etapas anteriores

---

### 8. Certificado

Representa um certificado emitido para um colaborador.

**Tabela**: `certificados`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idCertificado | foreignId | Referência interna | ✅ |
| Codigo_unico | string(45) | Código único do certificado | ✅ (unique) |
| Data_emissao | timestamp | Data de emissão | ❌ |
| Caminho_pdf | string(500) | Caminho do arquivo PDF | ❌ |
| user_id | foreignId | Referência ao User | ✅ |
| turma_id | foreignId | Referência à Turma | ❌ |
| created_at | timestamp | Data de criação | ✅ |
| updated_at | timestamp | Data de atualização | ✅ |

**Relacionamentos**:
- `belongsTo(User)` - Pertence a um colaborador
- `belongsTo(Turma)` - Pode estar relacionado a uma turma

**Regras de Negócio**:
- ✅ Código único deve ser gerado automaticamente e ser único
- ✅ Certificado só pode ser emitido se status da turma = "concluida"
- ✅ Data de emissão deve ser igual ou posterior à data de conclusão da turma
- ✅ PDF deve ser gerado e armazenado antes de salvar o registro

---

### 9. Notificacao

Representa uma notificação enviada a um usuário.

**Tabela**: `notificacaos`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idNotificacao | foreignId | Referência interna | ✅ |
| Mensagem | string(500) | Mensagem da notificação | ✅ |
| Tipo | enum | Tipo: vencimento, alerta, info, sucesso, erro | ✅ |
| Lida | boolean | Indica se foi lida | ✅ (default: false) |
| Data_criacao | timestamp | Data de criação | ❌ |
| user_id | foreignId | Referência ao User | ✅ |
| created_at | timestamp | Data de criação | ✅ |
| updated_at | timestamp | Data de atualização | ✅ |

**Relacionamentos**:
- `belongsTo(User)` - Pertence a um usuário

**Regras de Negócio**:
- ✅ Notificações de vencimento devem ser geradas automaticamente X dias antes do vencimento
- ✅ Notificações devem ser marcadas como lidas quando visualizadas
- ✅ Notificações não lidas devem aparecer no topo

---

### 10. Periodo

Representa um período de tempo para agendamento de treinamentos.

**Tabela**: `periodos`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| idperiodo | foreignId | Referência interna | ✅ |
| Nome | string(100) | Nome do período | ❌ |
| Data_inicio | date | Data de início | ❌ |
| Data_fim | date | Data de fim | ❌ |

**Relacionamentos**:
- `hasMany(Calendario)` - Um período tem muitos calendários

**Regras de Negócio**:
- ✅ Data de fim deve ser posterior à data de início

---

### 11. Calendario

Agenda de treinamentos por período e setor.

**Tabela**: `calendarios`

**Campos**:

| Campo | Tipo | Descrição | Obrigatório |
|-------|------|-----------|-------------|
| id | bigint (PK) | Identificador único | ✅ |
| treinamento_id | foreignId | Referência ao Treinamento | ✅ |
| periodo_id | foreignId | Referência ao Periodo | ✅ |
| setor_id | foreignId | Referência ao Setor | ❌ |
| data_prevista | timestamp | Data prevista para o treinamento | ❌ |
| descricao | string(256) | Descrição/observações | ❌ |

**Relacionamentos**:
- `belongsTo(Treinamento)` - Pertence a um treinamento
- `belongsTo(Periodo)` - Pertence a um período
- `belongsTo(Setor)` - Pode pertencer a um setor

**Regras de Negócio**:
- ✅ Data prevista deve estar dentro do período definido
- ✅ Treinamento no calendário deve ter status = "ativo"

---

## 🔗 Resumo de Relacionamentos

### Relacionamentos N:1 (Many-to-One / belongsTo)

- User → Empresa
- User → Setor
- Etapa → Treinamento
- Turma → User (aluno)
- Turma → User (instrutor)
- Turma → Treinamento
- Certificado → User
- Certificado → Turma
- Notificacao → User
- Calendario → Treinamento
- Calendario → Periodo
- Calendario → Setor

### Relacionamentos 1:N (One-to-Many / hasMany)

- Empresa → Users
- Setor → Users
- Setor → Calendarios
- Treinamento → Etapas
- Treinamento → Turmas
- Treinamento → Calendarios
- User → Notificacoes
- User → Certificados
- User → Turmas (como aluno)
- User → Turmas (como instrutor)
- Periodo → Calendarios

### Relacionamentos N:N (Many-to-Many / belongsToMany)

- Turma ↔ Etapa (através de `cronograma_etapas`)

---

## 📋 Regras de Negócio Globais

### Integridade Referencial

- ✅ Todas as foreign keys devem ter `onDelete` configurado:
  - `cascade`: Apaga registros relacionados quando o principal for deletado
  - `set null`: Define como null quando o principal for deletado
  - `restrict`: Impede exclusão se houver registros relacionados

### Validações Comuns

1. **Datas**: Data de fim sempre posterior à data de início
2. **Status**: Transições de status devem seguir fluxo lógico
3. **Unicidade**: Campos marcados como `unique` devem ser validados
4. **Obrigatoriedade**: Campos obrigatórios não podem ser null

### Soft Deletes

Atualmente nenhuma entidade usa Soft Deletes. Para implementar:

1. Adicionar `use SoftDeletes` no model
2. Adicionar coluna `deleted_at` na migration
3. Registros deletados ficam marcados mas não são removidos

---

**Última atualização**: 30/11/2025

