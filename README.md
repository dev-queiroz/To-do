# To-Do List Completa em PHP com SQLite: Organize suas Tarefas com Estilo!

Cansado de listas de tarefas desorganizadas e sem graça? Apresento a solução perfeita: uma to-do list completa em PHP com banco de dados SQLite para você gerenciar suas tarefas com estilo e eficiência!

## Funcionalidades Incríveis:

- **Cadastro e autenticação de usuários**: Mantenha seus dados seguros e personalize sua experiência.
- **Gerenciamento de tarefas**: Crie, visualize, edite e exclua tarefas com facilidade.
- **Marcação de tarefas como concluídas**: Acompanhe seu progresso e elimine o estresse.
- **Banco de dados SQLite**: Armazenamento seguro e confiável de suas tarefas.
- **CSS personalizável**: Torne sua lista de tarefas única e atraente com o seu estilo.

## Comece Agora:

1. **Clone este repositório:**

```bash
git clone https://github.com/<SEU_NOME_USUARIO>/<NOME_DO_REPOSITÓRIO>.git
```

2. **Instale o SQLite:** Siga as [instruções de download](https://sqlite.org/download.html) para sua plataforma.

3. **Crie o banco de dados:**

Execute o script `banco_de_dados.sql` no seu banco de dados SQLite.

4. **Inicie o servidor web:**

Utilize um servidor web local como o Apache ou o Nginx.

5. **Acesse sua lista de tarefas:**

Abra o navegador e acesse `http://localhost/index.php` (ou ajuste o caminho conforme seu servidor).

## Configuração Detalhada:

- **Arquivo `index.php`:**
- Interface para cadastro e autenticação de usuários.
- Permite a visualização e adição de novas tarefas.

- **Arquivo `tarefas.php`:**
- Lista as tarefas do usuário logado.
- Permite marcação de tarefas como concluídas, edição e remoção de tarefas.

- **Arquivo `style.css`:**
- Contém estilos CSS básicos para a interface.
- Personalize para combinar com seu estilo preferido.

- **Arquivo `banco_de_dados.sql`:**
- Cria as tabelas `usuarios` e `tarefas` no banco de dados SQLite.

## Segurança:

- **Armazenamento de senhas:**
- As senhas dos usuários são armazenadas criptografadas no banco de dados para segurança.

- **Prevenção contra injeção de SQL:**
- Use prepared statements no PHP para evitar ataques de injeção de SQL.

## Aprimoramentos Possíveis:

- **Integração com calendário:** Agende tarefas para datas e horários específicos.
- **Notificações por email:** Receba lembretes de tarefas por email.
- **Gerenciamento de projetos:** Organize suas tarefas em projetos e subprojetos.
- **Tema escuro:** Adicione um tema escuro para uma experiência mais relaxante.
- **Colaboração:** Permita que outras pessoas colaborem em suas listas de tarefas.

## Explore e Personalize:

Este projeto é um ponto de partida para criar a to-do list dos seus sonhos. Use sua criatividade e conhecimentos em PHP e SQLite para torná-la ainda mais completa e funcional.

## Compartilhe e Contribua:

Sinta-se à vontade para compartilhar este projeto com seus amigos e colegas desenvolvedores. Se desejar contribuir com melhorias ou novas funcionalidades, envie um pull request no GitHub.

Juntos, podemos tornar essa to-do list ainda mais incrível!

## Criação de Tabelas SQLite:

Este projeto utiliza um banco de dados SQLite para armazenar as tarefas. O arquivo `banco_de_dados.sql` contém as instruções para criar as tabelas necessárias.

**Pré-requisitos:**
- Ter o SQLite instalado em seu sistema. Se ainda não o tiver, siga as instruções de download em [sqlite.org](https://sqlite.org/download.html).
- Uma ferramenta de banco de dados SQLite, como o SQLite CLI ou o DB Browser for SQLite.

**Criação do Banco de Dados:**

1. Crie um banco de dados vazio com o nome `to-do-list.db`.

2. Execute o seguinte comando para executar o script `banco_de_dados.sql` e criar as tabelas:

```bash
sqlite3 to-do-list.db < banco_de_dados.sql
```

Aproveite sua nova e organizada to-do list em PHP com SQLite!
