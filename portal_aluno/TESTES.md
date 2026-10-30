# Relatório de testes — Portal do Aluno

Ambiente: PHP 8 (servidor embutido `php -S`), navegação simulada com cookies de sessão.
Sintaxe: `php -l` sem erros em todos os arquivos.

| Nº | Ação de teste | Resultado esperado | Resultado obtido | Status |
| --- | --- | --- | --- | --- |
| 1 | Abrir `index.php` | Título, links e rodapé visíveis | Cabeçalho "Portal do Aluno - Senac", 3 links e rodapé exibidos |  Passou |
| 2 | Enviar nome vazio | Erro de nome obrigatório | "O nome é obrigatório." e e-mail/idade preservados |  Passou |
| 3 | Enviar e-mail `teste` | Erro de e-mail inválido | "Informe um e-mail válido." |  Passou |
| 4 | Enviar idade `0` | Erro de idade inválida | "A idade deve ser um número inteiro maior que zero." |  Passou |
| 5 | Enviar `Ana`, `ana@senac.br`, `22` | Cadastro na página de resultado | Mensagem de sucesso + Nome, E-mail e Idade exibidos |  Passou |
| 6 | Atualizar a página de resultado | Dados continuam, mensagem some | Dados exibidos, sem "Cadastro realizado com sucesso!" |  Passou |
| 7 | Encerrar sessão e acessar resultado | Sem cadastro na sessão | Redireciona para `index.php`; resultado mostra "Nenhum aluno cadastrado nesta sessão." |  Passou |
| 8 | Enviar `<h1>Ana</h1>` como nome | Texto literal, sem título HTML | HTML gerado: `Nome: &lt;h1&gt;Ana&lt;/h1&gt;` |  Passou |
| 9 | Dados inválidos após preencher outros campos | Volta ao formulário com valores preservados | Nome `Ana "Maria"`, e-mail `ana@x` e idade `abc` voltam preenchidos (escapados) |  Passou |

Extra: acessar `processar_cadastro.php` via GET redireciona (302) para `cadastro.php`.

## Bônus
`limparTexto()` implementada em `includes/funcoes.php` (trata `null`, aplica `trim` e reduz espaços repetidos)
e usada em `processar_cadastro.php` para tratar o nome antes da validação.

## Perguntas
- **Por que `require_once` em funções?** Garante que o arquivo seja incluído uma única vez (evita o erro
  "Cannot redeclare function") e interrompe a execução com erro fatal se o arquivo não existir, já que sem as funções o script não funciona.
- **E se esquecer `exit` após `header()`?** O `header` só envia o cabeçalho de redirecionamento; o resto do
  script continua executando. No processamento, um cadastro inválido continuaria e seria salvo na sessão como se fosse válido.
- **`unset($_SESSION["mensagem"])` x `session_destroy()`?** O `unset` remove apenas aquela chave e mantém a sessão
  (e o aluno cadastrado). O `session_destroy()` destrói a sessão inteira no servidor — usado no logout.
