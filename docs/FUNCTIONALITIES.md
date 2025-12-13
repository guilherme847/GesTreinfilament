# Documentação das Principais Funcionalidades

Este documento descreve as principais funcionalidades do sistema GESTREIN, organizadas por módulos e requisitos funcionais.

## 📚 Índice

- [RF01 - Cadastro de Treinamentos](#rf01---cadastro-de-treinamentos)
- [RF02 - Cadastro de Colaboradores](#rf02---cadastro-de-colaboradores)
- [RF03 - Registro de Participação](#rf03---registro-de-participação)
- [RF04 - Gerenciamento de Certificados](#rf04---gerenciamento-de-certificados)
- [RF05 - Sistema de Notificações](#rf05---sistema-de-notificações)
- [Funcionalidades Auxiliares](#funcionalidades-auxiliares)

---

## RF01 - Cadastro de Treinamentos

### Descrição
Permite o cadastro e gerenciamento de treinamentos corporativos com informações detalhadas sobre carga horária, validade, modalidade e tipo.

### Status: ✅ **Implementado**

### Funcionalidades Implementadas

#### 1. Cadastro de Treinamento
- ✅ Formulário completo com validações
- ✅ Campos disponíveis:
  - Nome do treinamento (obrigatório, máx. 225 caracteres)
  - Descrição (opcional, máx. 3000 caracteres)
  - Carga horária (obrigatório, número positivo)
  - Tipo (obrigatório): obrigatório, opcional, reciclagem, inicial
  - Modalidade (obrigatório): presencial, online, híbrido
  - Validade em meses (obrigatório, número positivo)
  - Requer validação prática (sim/não)
  - Data de criação (automática)
  - Status (ativo, inativo, arquivado)

#### 2. Listagem de Treinamentos
- ✅ Tabela com paginação
- ✅ Busca por nome
- ✅ Filtros por:
  - Tipo de treinamento
  - Modalidade
  - Status
  - Requer validação prática
- ✅ Ordenação por data de criação
- ✅ Badges coloridos para Tipo e Status

#### 3. Visualização de Treinamento
- ✅ Página de detalhes com todas as informações
- ✅ Relacionamentos visíveis (etapas, turmas)

#### 4. Edição de Treinamento
- ✅ Formulário pré-preenchido
- ✅ Validações iguais ao cadastro
- ✅ Histórico de alterações (timestamps)

#### 5. Exclusão de Treinamento
- ✅ Soft delete ou exclusão permanente
- ✅ Validação de dependências (turmas ativas)

### Permissões
- ✅ **Admin**: Acesso total
- ✅ **Técnico de Segurança**: Pode cadastrar e gerenciar treinamentos obrigatórios
- ✅ **RH**: Pode cadastrar treinamentos da área

### Regras de Negócio Implementadas
- ✅ Treinamento arquivado não pode receber novas matrículas
- ✅ Carga horária deve ser maior que zero
- ✅ Validade em meses deve ser maior que zero
- ✅ Status padrão é "ativo"

### Pendências
- ⏳ Validação de treinamento obrigatório com validade obrigatória
- ⏳ Sistema de etapas integrado ao cadastro
- ⏳ Upload de materiais didáticos

---

## RF02 - Cadastro de Colaboradores

### Descrição
Sistema completo para cadastro e gerenciamento de colaboradores, incluindo informações pessoais, profissionais e de acesso ao sistema.

### Status: ✅ **Implementado**

### Funcionalidades Implementadas

#### 1. Cadastro de Colaborador
- ✅ Formulário organizado em seções:
  - **Informações Pessoais**: Nome, E-mail, Tipo de usuário
  - **Informações Profissionais**: Empresa, Setor, Função
  - **Segurança**: Senha com validação, Data de cadastro
  - **Status**: Ativo/Inativo, Data de desligamento
- ✅ Validações:
  - E-mail único no sistema
  - Senha com regras de complexidade
  - Tipo de usuário obrigatório

#### 2. Listagem de Colaboradores
- ✅ Tabela com busca por nome e e-mail
- ✅ Filtros por:
  - Tipo de usuário
  - Empresa
  - Setor
  - Status (Ativo/Inativo)
- ✅ Badges coloridos para tipo de usuário
- ✅ Indicador visual de status (ativo/inativo)

#### 3. Visualização de Colaborador
- ✅ Página de detalhes completa
- ✅ Informações de relacionamentos (treinamentos, certificados)

#### 4. Edição de Colaborador
- ✅ Formulário pré-preenchido
- ✅ Opção de alterar senha (não obrigatória na edição)
- ✅ Validação de e-mail único (ignorando o próprio registro)

#### 5. Gerenciamento de Empresas e Setores
- ✅ Criação rápida de empresa e setor a partir do formulário
- ✅ Seleção com busca e pré-carregamento

### Permissões
- ✅ **Admin**: Acesso total
- ✅ **RH**: Pode cadastrar e editar colaboradores (RN03)

### Regras de Negócio Implementadas
- ✅ E-mail deve ser único
- ✅ Senha deve seguir padrão de segurança
- ✅ Data de desligamento deve ser posterior à data de cadastro
- ✅ Usuário inativo não pode fazer login

### Pendências
- ⏳ Validação de CNPJ da empresa ao vincular colaborador
- ⏳ Sistema de permissões granular por papel
- ⏳ Upload de foto do colaborador
- ⏳ Histórico de alterações de dados

---

## RF03 - Registro de Participação

### Descrição
Sistema para registro de participação de colaboradores em treinamentos, incluindo controle de progresso, etapas e conclusão.

### Status: ✅ **Implementado**

### Funcionalidades Implementadas

#### 1. Matrícula em Treinamento
- ✅ Formulário de matrícula com:
  - Seleção de colaborador (busca e filtro)
  - Seleção de treinamento (busca e filtro)
  - Seleção de instrutor (filtrado por tipo "instrutor")
  - Modalidade (preenchida automaticamente do treinamento)
  - Data de vínculo (padrão: data atual)
  - Data prevista de conclusão

#### 2. Acompanhamento de Progresso
- ✅ Campos de status:
  - Status geral: pendente, em_andamento, concluida, cancelada
  - Status etapa teórica: pendente, em_andamento, concluida, cancelada
  - Data etapa teórica
  - Data etapa prática
  - Data de conclusão
- ✅ Campo de observações

#### 3. Listagem de Participações
- ✅ Tabela com informações principais:
  - Colaborador
  - Treinamento
  - Instrutor
  - Status geral
  - Status etapa teórica
  - Datas relevantes
- ✅ Filtros por:
  - Treinamento
  - Status geral
  - Instrutor
- ✅ Ordenação por data de vínculo

#### 4. Atualização de Status
- ✅ Formulário de edição com todos os campos de progresso
- ✅ Validações de transição de status

### Permissões
- ✅ **Admin**: Acesso total
- ✅ **Técnico de Segurança**: Pode gerenciar participações
- ✅ **RH**: Pode gerenciar participações
- ✅ **Instrutor**: Pode atualizar progresso e status

### Regras de Negócio Implementadas
- ✅ Data de conclusão deve ser posterior à data de vínculo
- ✅ Status geral reflete o progresso geral
- ✅ Modalidade é preenchida automaticamente do treinamento

### Pendências
- ⏳ Validação de duplicidade (colaborador não pode estar matriculado duas vezes no mesmo treinamento ativo)
- ⏳ Sistema de etapas integrado (CronogramaEtapas)
- ⏳ Validação de conclusão de etapas anteriores
- ⏳ Cálculo automático de data prevista baseado na carga horária
- ⏳ Registro de presença por etapa

---

## RF04 - Gerenciamento de Certificados

### Descrição
Sistema para emissão e gerenciamento de certificados de conclusão de treinamentos.

### Status: ⏳ **Parcialmente Implementado**

### Funcionalidades Implementadas
- ✅ Estrutura de banco de dados criada
- ✅ Model e relacionamentos definidos

### Funcionalidades Pendentes
- ⏳ Interface de geração de certificados
- ⏳ Geração automática de código único
- ⏳ Validação de conclusão antes de emitir
- ⏳ Geração de PDF do certificado
- ⏳ Download de certificados
- ⏳ Verificação de certificados por código
- ⏳ Histórico de emissões

### Regras de Negócio a Implementar
- ⏳ Certificado só pode ser emitido se status da turma = "concluida"
- ⏳ Código único deve ser gerado automaticamente
- ⏳ Data de emissão deve ser igual ou posterior à data de conclusão
- ⏳ PDF deve ser gerado antes de salvar o registro

---

## RF05 - Sistema de Notificações

### Descrição
Sistema de notificações para alertar usuários sobre eventos importantes, principalmente vencimentos de treinamentos.

### Status: ⏳ **Parcialmente Implementado**

### Funcionalidades Implementadas
- ✅ Estrutura de banco de dados criada
- ✅ Model e relacionamentos definidos

### Funcionalidades Pendentes
- ⏳ Interface de visualização de notificações
- ⏳ Marcação de notificações como lidas
- ⏳ Badge de contagem de não lidas
- ⏳ Sistema automático de geração de notificações de vencimento
- ⏳ Configuração de dias de antecedência para alertas
- ⏳ Notificações por e-mail (integração futura)
- ⏳ Histórico de notificações

### Regras de Negócio a Implementar
- ⏳ Notificações de vencimento devem ser geradas X dias antes (configurável)
- ⏳ Notificações não lidas devem aparecer no topo
- ⏳ Notificações devem ser marcadas como lidas ao visualizar

---

## Funcionalidades Auxiliares

### Gestão de Empresas

**Status**: ✅ **Implementado**

#### Funcionalidades
- ✅ CRUD completo
- ✅ Validação de CNPJ único
- ✅ Máscaras de entrada (CNPJ, CEP, Telefone)
- ✅ Controle de status (Ativa/Inativa)
- ✅ Contador de colaboradores

### Gestão de Setores

**Status**: ✅ **Implementado**

#### Funcionalidades
- ✅ CRUD completo
- ✅ Validação de nome único
- ✅ Contador de colaboradores por setor

### Sistema de Etapas

**Status**: ⏳ **Estrutura Criada**

#### Pendências
- ⏳ Interface de gerenciamento de etapas
- ⏳ Ordenação de etapas
- ⏳ Validação de sequência

### Calendário de Treinamentos

**Status**: ⏳ **Estrutura Criada**

#### Pendências
- ⏳ Interface de visualização de calendário
- ⏳ Agendamento de treinamentos por período e setor
- ⏳ Visualização mensal/semanal

---

## 📊 Resumo de Implementação

| Módulo | Status | Progresso |
|--------|--------|-----------|
| RF01 - Cadastro de Treinamentos | ✅ Implementado | 100% |
| RF02 - Cadastro de Colaboradores | ✅ Implementado | 100% |
| RF03 - Registro de Participação | ✅ Implementado | 85% |
| RF04 - Gerenciamento de Certificados | ⏳ Pendente | 10% |
| RF05 - Sistema de Notificações | ⏳ Pendente | 10% |
| Gestão de Empresas | ✅ Implementado | 100% |
| Gestão de Setores | ✅ Implementado | 100% |
| Sistema de Etapas | ⏳ Pendente | 30% |
| Calendário | ⏳ Pendente | 20% |

---

**Última atualização**: 30/11/2025

