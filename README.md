# HelpDesk API — Documentação e Contratos Formais

Repositório da aplicação de exemplo para a disciplina de **Desenvolvimento de API Back-End** da **UniEVANGÉLICA**, ministrada pelo **Prof. Me. Luiz Martins**.

Este projeto demonstra a criação de uma API RESTful em **PHP / Laravel** arquitetada em camadas desacopladas (*Form Request*, *Controller*, *Service* e *Repository*), com geração automática de especificação **OpenAPI 3.0** e documentação interativa via **Dedoc Scramble**.

---

## 🛠️ Tecnologias e Ferramental

* **Linguagem:** PHP 8.2+
* **Framework:** Laravel 11+
* **Gerenciador de Dependências:** Composer
* **Documentação & Especificação OpenAPI:** [Dedoc Scramble](https://scramble.dedoc.co/)
* **Padrão de Arquitetura:** Clean Architecture / Camadas (Request $\rightarrow$ Controller $\rightarrow$ Service $\rightarrow$ Repository)

---

## 📋 Pré-requisitos

Antes de iniciar, certifique-se de possuir instalado no ambiente:

* [Git](https://git-scm.com/)
* [PHP 8.2 ou superior](https://www.php.net/) com extensões comuns habilitadas (`pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `curl`)
* [Composer](https://getcomposer.org/)

---

## 🚀 Passo a Passo: Clonar e Rodar Localmente

Siga as instruções sequenciais no terminal:

### 1. Clonar o Repositório
```bash
git clone https://github.com/profluizmartins/dabe_semana09.git
cd dabe_semana09
```

### 2. Instalar as Dependências do Projeto
Baixe as dependências do framework e do Scramble via Composer:
```bash
composer install
```

### 3. Configurar as Variáveis de Ambiente
Copie o arquivo de exemplo de ambiente `.env.example` para `.env`:

* **Linux / macOS / Git Bash:**
  ```bash
  cp .env.example .env
  ```
* **Windows (Prompt / PowerShell):**
  ```powershell
  copy .env.example .env
  ```

> **Atenção:** Como o laboratório utiliza persistência em memória e dispensa banco de dados, certifique-se de que no arquivo `.env` as variáveis de sessão e cache estejam apontando para arquivos:
> ```env
> SESSION_DRIVER=file
> CACHE_STORE=file
> ```

### 4. Gerar a Chave da Aplicação (APP_KEY)
```bash
php artisan key:generate
```

### 5. Iniciar o Servidor de Desenvolvimento
```bash
php artisan serve
```

O terminal exibirá a confirmação de inicialização:
```text
   INFO  Server running on [http://127.0.0.1:8000].
```

---

## 📖 Acessando a Documentação da API

Com o servidor em execução, abra o navegador e utilize as URLs abaixo:

* **Interface Visual Interativa (Swagger/Scalar UI):**
  [http://127.0.0.1:8000/docs/api](http://127.0.0.1:8000/docs/api)
* **Especificação OpenAPI Raw (JSON):**
  [http://127.0.0.1:8000/docs/api.json](http://127.0.0.1:8000/docs/api.json)

---

## 🧪 Roteiro de Teste dos Endpoints

Você pode testar as rotas diretamente pelo botão **"Try it out"** na documentação interativa ou via ferramentas como Postman, Insomnia ou cURL:

### 1. Listar Chamados
* **Método:** `GET`
* **URL:** `http://127.0.0.1:8000/api/v1/chamados`
* **Status Esperado:** `200 OK`

### 2. Abrir Novo Chamado (Sucesso)
* **Método:** `POST`
* **URL:** `http://127.0.0.1:8000/api/v1/chamados`
* **Headers:** `Content-Type: application/json`
* **Payload:**
  ```json
  {
    "titulo": "Falha no switch principal do bloco B",
    "descricao": "Portas 1 a 12 pararam de responder após surto elétrico.",
    "prioridade": "ALTA",
    "categoria_id": 2
  }
  ```
* **Status Esperado:** `201 Created`

### 3. Teste de Violação de Contrato (Erro de Validação)
* **Método:** `POST`
* **URL:** `http://127.0.0.1:8000/api/v1/chamados`
* **Headers:** `Content-Type: application/json`
* **Payload:**
  ```json
  {
    "titulo": "Erro",
    "descricao": "Teste com título curto e prioridade inválida.",
    "prioridade": "URGENTE",
    "categoria_id": 2
  }
  ```
* **Status Esperado:** `422 Unprocessable Entity` (Observe o detalhamento formal dos erros retornado pelo Laravel).

### 4. Consultar Chamado Específico
* **Método:** `GET`
* **URL:** `http://127.0.0.1:8000/api/v1/chamados/1`
* **Status Esperado:** `200 OK`
* *(Caso informe um ID inexistente, como `/999`, o retorno esperado será `404 Not Found`).*

---

## 🏛️ Estrutura Arquitetural do Código

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── ChamadoController.php   # Entrada HTTP, docblocks semânticos e respostas
│   └── Requests/
│       └── CriarChamadoRequest.php # Validação automática e definição do schema OpenAPI
├── Repositories/
│   └── ChamadoRepository.php       # Isolamento da camada de dados / persistência
└── Services/
    └── ChamadoService.php          # Lógica de negócio pura isolada do protocolo HTTP
routes/
└── api.php                         # Mapeamento e versionamento semântico (/v1/...)
```

---

## 👨‍🏫 Docente Responsável

* **Prof. Me. Luiz Martins**
* **Instituição:** Universidade Evangélica de Goiás (UniEVANGÉLICA)
* **Disciplina:** Desenvolvimento de API Back-End