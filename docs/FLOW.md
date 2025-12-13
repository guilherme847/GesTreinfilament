# Documentação do Fluxo Principal do Sistema

Este documento descreve os principais fluxos do sistema GESTREIN, desde o cadastro inicial até a emissão de certificados.

## 📋 Índice

- [Fluxo 1: Cadastro de Treinamento](#fluxo-1-cadastro-de-treinamento)
- [Fluxo 2: Cadastro de Colaborador](#fluxo-2-cadastro-de-colaborador)
- [Fluxo 3: Matrícula em Treinamento](#fluxo-3-matrícula-em-treinamento)
- [Fluxo 4: Progresso do Treinamento](#fluxo-4-progresso-do-treinamento)
- [Fluxo 5: Conclusão e Certificado](#fluxo-5-conclusão-e-certificado)
- [Fluxo 6: Notificações e Alertas](#fluxo-6-notificações-e-alertas)

---

## Fluxo 1: Cadastro de Treinamento

### Descrição
Processo de cadastro de um novo treinamento no sistema.

### Participantes
- **Admin**
- **Técnico de Segurança** (para treinamentos obrigatórios)
- **RH** (para treinamentos da área)

### Passos do Fluxo

```
1. Acesso ao Painel Administrativo
   └─> /admin/login

2. Navegação para Treinamentos
   └─> /admin/treinamentos

3. Clicar em "Novo Treinamento"
   └─> /admin/treinamentos/create

4. Preenchimento do Formulário
   ├─> Informações Básicas
   │   ├─> Nome do Treinamento *
   │   └─> Descrição
   │
   ├─> Detalhes do Treinamento
   │   ├─> Tipo * (obrigatorio, opcional, reciclagem, inicial)
   │   ├─> Modalidade * (presencial, online, hibrido)
   │   ├─> Carga Horária * (em horas)
   │   └─> Validade * (em meses)
   │
   └─> Configurações
       ├─> Requer Validação Prática (sim/não)
       ├─> Status * (ativo, inativo, arquivado)
       └─> Data de Criação (automática)

5. Validações
   ├─> Todos os campos obrigatórios preenchidos
   ├─> Carga horária > 0
   ├─> Validade em meses > 0
   └─> Status válido

6. Salvar
   └─> Retorna para lista de treinamentos

7. (Opcional) Criar Etapas
   └─> Configurar etapas do treinamento (futuro)
```

### Regras de Negócio Aplicadas

- ✅ Treinamento obrigatório deve ter validade definida
- ✅ Carga horária deve ser positiva
- ✅ Status padrão é "ativo"
- ⏳ Se requer validação prática, deve ter etapa prática configurada (futuro)

### Resultado

Treinamento cadastrado e disponível para matrículas (se status = "ativo").

---

## Fluxo 2: Cadastro de Colaborador

### Descrição
Processo de cadastro de um novo colaborador no sistema.

### Participantes
- **Admin**
- **RH**

### Passos do Fluxo

```
1. Acesso ao Painel Administrativo
   └─> /admin/login

2. Navegação para Colaboradores
   └─> /admin/users

3. Clicar em "Novo Colaborador"
   └─> /admin/users/create

4. Preenchimento do Formulário
   ├─> Informações Pessoais
   │   ├─> Nome Completo *
   │   ├─> E-mail * (único)
   │   └─> Tipo de Usuário * (colaborador, instrutor, rh, etc.)
   │
   ├─> Informações Profissionais
   │   ├─> Empresa * (seleção ou criação rápida)
   │   ├─> Setor (seleção ou criação rápida)
   │   └─> Função
   │
   ├─> Segurança
   │   ├─> Senha * (com validação)
   │   └─> Data de Cadastro (automática)
   │
   └─> Status
       ├─> Ativo (padrão: sim)
       └─> Data de Desligamento (se inativo)

5. Validações
   ├─> E-mail único no sistema
   ├─> Senha atende requisitos de segurança
   ├─> Empresa existe ou foi criada
   └─> Tipo de usuário válido

6. Salvar
   └─> Retorna para lista de colaboradores
       └─> Colaborador pode fazer login (se ativo)
```

### Regras de Negócio Aplicadas

- ✅ E-mail deve ser único
- ✅ Senha deve seguir padrão de segurança (mínimo 8 caracteres)
- ✅ Data de desligamento deve ser posterior à data de cadastro
- ✅ Usuário inativo não pode fazer login
- ✅ Empresa deve estar ativa para vincular colaborador

### Resultado

Colaborador cadastrado e pronto para ser matriculado em treinamentos.

---

## Fluxo 3: Matrícula em Treinamento

### Descrição
Processo de matricular um colaborador em um treinamento.

### Participantes
- **Admin**
- **Técnico de Segurança**
- **RH**

### Passos do Fluxo

```
1. Acesso ao Painel Administrativo
   └─> /admin/login

2. Navegação para Participações
   └─> /admin/turmas

3. Clicar em "Nova Participação"
   └─> /admin/turmas/create

4. Preenchimento do Formulário
   ├─> Informações da Participação
   │   ├─> Treinamento * (seleção com busca)
   │   ├─> Colaborador/Aluno * (seleção com busca)
   │   ├─> Instrutor (seleção, filtrado por tipo "instrutor")
   │   └─> Forma de Realização (preenchida automaticamente)
   │
   ├─> Datas
   │   ├─> Data de Vínculo * (padrão: hoje)
   │   ├─> Data Prevista de Conclusão
   │   └─> Data de Conclusão (preenchida ao concluir)
   │
   └─> Status do Treinamento
       ├─> Status Geral * (padrão: pendente)
       ├─> Status Etapa Teórica
       ├─> Data Etapa Teórica
       └─> Data Etapa Prática

5. Validações
   ├─> Colaborador existe e está ativo
   ├─> Treinamento existe e está ativo
   ├─> Não há matrícula duplicada (mesmo treinamento ativo)
   └─> Instrutor tem tipo "instrutor" (se informado)

6. Salvar
   └─> Retorna para lista de participações
       └─> Status inicial: "pendente"
```

### Regras de Negócio Aplicadas

- ✅ Colaborador não pode estar matriculado duas vezes no mesmo treinamento ativo
- ✅ Treinamento deve estar ativo para receber matrícula
- ✅ Colaborador deve estar ativo
- ✅ Status inicial é "pendente"
- ⏳ Data prevista deve considerar carga horária e disponibilidade (futuro)

### Resultado

Colaborador matriculado em treinamento. Status inicial: "pendente".

---

## Fluxo 4: Progresso do Treinamento

### Descrição
Processo de acompanhamento e atualização do progresso de um treinamento.

### Participantes
- **Admin**
- **Instrutor** (atualização de progresso)
- **Técnico de Segurança**
- **RH**

### Passos do Fluxo

```
1. Acesso à Participação
   └─> /admin/turmas/{id}
       ou
       /admin/turmas/{id}/edit

2. Atualização de Status

   A. Etapa Teórica
      ├─> Status: pendente → em_andamento
      │   └─> Registrar Data Etapa Teórica
      │
      └─> Status: em_andamento → concluida
          └─> Validar conclusão antes de prosseguir

   B. Etapa Prática (se aplicável)
      ├─> Validar que etapa teórica está concluída
      ├─> Status Geral: em_andamento
      └─> Registrar Data Etapa Prática

   C. Conclusão
      ├─> Validar que todas as etapas estão concluídas
      ├─> Status Geral: concluida
      └─> Registrar Data de Conclusão

3. Observações
   └─> Registrar observações relevantes

4. Salvar Alterações
   └─> Histórico de atualizações mantido
```

### Regras de Negócio Aplicadas

- ✅ Etapa prática só pode ser iniciada após conclusão da teórica
- ✅ Status "concluida" só pode ser aplicado se todas as etapas estiverem concluídas
- ✅ Data de conclusão deve ser posterior à data de vínculo
- ✅ Se treinamento requer validação prática, etapa prática é obrigatória

### Estados do Status Geral

```
pendente → em_andamento → concluida
    ↓
cancelada
```

### Resultado

Progresso do treinamento atualizado. Sistema pronto para emissão de certificado (se concluído).

---

## Fluxo 5: Conclusão e Certificado

### Descrição
Processo de conclusão do treinamento e emissão de certificado.

### Participantes
- **Admin**
- **Técnico de Segurança**
- **RH**

### Status Atual: ⏳ **Parcialmente Implementado**

### Passos do Fluxo (Planejado)

```
1. Validação de Conclusão
   ├─> Status Geral = "concluida"
   ├─> Data de Conclusão registrada
   ├─> Todas as etapas concluídas (se aplicável)
   └─> Etapa prática concluída (se requerida)

2. Emissão de Certificado
   ├─> Gerar Código Único
   │   └─> Formato: GESTREIN-{ANO}-{SEQUENCIAL}
   │
   ├─> Criar Registro de Certificado
   │   ├─> Código Único
   │   ├─> Data de Emissão (hoje)
   │   ├─> Vínculo com Colaborador
   │   └─> Vínculo com Turma/Treinamento
   │
   ├─> Gerar PDF do Certificado
   │   ├─> Template padrão
   │   ├─> Informações do colaborador
   │   ├─> Informações do treinamento
   │   ├─> Código único
   │   └─> Data de emissão
   │
   └─> Salvar PDF no Storage
       └─> Atualizar Caminho no registro

3. Disponibilização
   └─> Certificado disponível para download
       └─> Página de verificação por código único (futuro)
```

### Regras de Negócio a Implementar

- ⏳ Certificado só pode ser emitido se status da turma = "concluida"
- ⏳ Código único deve ser gerado automaticamente e ser único
- ⏳ Data de emissão deve ser igual ou posterior à data de conclusão
- ⏳ PDF deve ser gerado antes de salvar o registro
- ⏳ Certificado deve conter informações válidas e verificáveis

### Pendências de Implementação

- ⏳ Interface de emissão de certificados
- ⏳ Geração de código único
- ⏳ Template de PDF
- ⏳ Geração de PDF
- ⏳ Download de certificados
- ⏳ Verificação de certificados por código

---

## Fluxo 6: Notificações e Alertas

### Descrição
Sistema automático de notificações para alertar sobre eventos importantes, principalmente vencimentos.

### Participantes
- **Sistema** (geração automática)
- **Todos os usuários** (receptores)

### Status Atual: ⏳ **Parcialmente Implementado**

### Passos do Fluxo (Planejado)

```
1. Geração Automática de Notificações

   A. Notificações de Vencimento
      ├─> Cron Job executado diariamente
      ├─> Buscar treinamentos com validade próxima
      │   └─> Dentro de X dias (configurável)
      ├─> Para cada colaborador:
      │   ├─> Verificar treinamentos vencendo
      │   ├─> Criar notificação tipo "vencimento"
      │   └─> Mensagem: "Seu treinamento X vence em Y dias"
      └─> Notificação não lida aparece no topo

   B. Notificações de Conclusão
      ├─> Quando treinamento é concluído
      ├─> Criar notificação tipo "sucesso"
      └─> Mensagem: "Parabéns! Você concluiu o treinamento X"

   C. Notificações de Avisos
      ├─> Novos treinamentos disponíveis
      ├─> Atualizações no sistema
      └─> Outros eventos relevantes

2. Visualização de Notificações
   ├─> Badge com contador de não lidas
   ├─> Lista de notificações (não lidas primeiro)
   ├─> Marcar como lida ao clicar
   └─> Histórico completo

3. (Futuro) Notificações por E-mail
   └─> Envio automático de e-mails para notificações importantes
```

### Regras de Negócio a Implementar

- ⏳ Notificações de vencimento devem ser geradas X dias antes (configurável)
- ⏳ Notificações não lidas devem aparecer no topo
- ⏳ Notificações devem ser marcadas como lidas ao visualizar
- ⏳ Não criar notificação duplicada no mesmo dia

### Pendências de Implementação

- ⏳ Interface de visualização de notificações
- ⏳ Marcação de notificações como lidas
- ⏳ Badge de contagem de não lidas
- ⏳ Cron Job para geração automática
- ⏳ Configuração de dias de antecedência
- ⏳ Integração de e-mail (futuro)

---

## 🔄 Fluxos Auxiliares

### Fluxo: Desligamento de Colaborador

```
1. Marcar colaborador como inativo
2. Definir data de desligamento
3. Cancelar treinamentos pendentes
4. Manter histórico de participações
```

### Fluxo: Arquivamento de Treinamento

```
1. Mudar status do treinamento para "arquivado"
2. Impedir novas matrículas
3. Manter treinamentos em andamento
4. Manter histórico completo
```

---

## 📊 Diagrama de Estados - Participação (Turma)

```
     [PENDENTE]
        │
        ├─> Iniciar Treinamento
        │
        ↓
  [EM_ANDAMENTO]
        │
        ├─> Etapa Teórica Concluída
        │   └─> (Se requer prática) → Etapa Prática
        │
        ├─> Todas Etapas Concluídas
        │
        ↓
    [CONCLUIDA]
        │
        └─> Emitir Certificado
            └─> [CERTIFICADO_EMITIDO]

   Qualquer estado pode ir para:
        ↓
   [CANCELADA]
```

---

## 📝 Observações Importantes

1. **Ordem de Cadastro**: É recomendável cadastrar primeiro Empresas e Setores, depois Treinamentos, e por último Colaboradores.

2. **Validações em Cascata**: Muitas validações dependem de registros relacionados estarem ativos (ex: não matricular em treinamento inativo).

3. **Histórico**: O sistema mantém histórico através de timestamps (`created_at`, `updated_at`).

4. **Permissões**: Cada fluxo respeita as permissões definidas por tipo de usuário.

---

**Última atualização**: 30/11/2025

