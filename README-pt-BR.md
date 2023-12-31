# FastDbgPHP
Biblioteca para auxiliar na depuração no PHP.
Usuário do PHP a mais de uma decada de forma não profissional nunca gostei de usar no nosso velho conhecido `var_dump`, então, resolvemos (Eu e Mocno) brincar um pouco no PHP e criar essa biblioteca para auxiliar na hora da depuração dos códigos.

### Exemplo
```php
$a = "Hello Word";
$d = 42;
$e = 3.14159265359;
$c = True;
$b = null;
$g = ["orange", "banana", "apple"];
$h = [
    "name" => [
        "first" => "Gustavo",
        "midle" => ["de", "Sousa"],
        "last" => "Correa"
    ],
    "age" => 18,
    "from" => "Brazil"
];
$f = [];

fdbg($a, $b, $c, $d, $e, $f, $g, $h);
```

<!-- Adicionar imagem -->

### Usabilidade

Um dos principais motivos para criação do projeto FastDbgPHP é simplificação no seu uso. Assim, para depurar seu código basta uma chamada da função `dbg` para criar um painel informativo sobre a variável, além disso, com as palavras chaves explicadas adiante, a depuração do seu ambiente se torna mais fácil. Por outro lado, outro ponto fundamental do projeto é a personalização, para tal as funções como `FastDbgPHP::setProjectName` e `FastDbgPHP::setStyles` foram criadas.

## Utilização

Para usar a esta biblioteca no seu projeto é necessário apenas a importação e a defição do estado do projeto através da função `FastDbgPHP::setDevelopmentMode`, ou seja, no caso de estar no modo de desenvolvimento defina `True`, se não, `False`. Depois isso, toda configuração basica ja foi realizada, basta depurar as variáveis de interresse, não precisa economisar, coloque quantas quiser, é sempre bom saber o que o código está fazendo.

```php
// Importando a biblioteca FastDbgPHP
require_once "../fastDbgPHP.class.php";

// Defina o modo que da página
// no caso de estar no modo de desenvolvimento defina True, se não, False
FastDbgPHP::setDevelopmentMode($isDev);

// Por fim, simplismente depure suas variáveis
$value = rand(1, 1000);
$other_value = $value - 10;

dbg($value, $other_value);
```

Não recomendamos deixar esse códigos de depuração em produção, porém, para maior segurança do seu código, apenas quando seu projeto estiver no modo de desenvolvimento a função `dbg` mostrará resultados na página.

Outra função importante são as palavras chave, explicadas a seguir.

### Palavras Chaves

#### Variaveis Globais: `##GET`, `##POST`, `##SERVER`,  `##FILES`, `##COOKIE`, `##SESSION`, `##REQUEST` e `##ENV`

Essas palavras chaves mostram as váriaves globais `$_GET`, `$_POST`, `$_SERVER`,  `$_FILES`, `$_COOKIE`, `$_SESSION`, `$_REQUEST` e `$_ENV`, respectivamente. Simplificando a depuração e facilitando sua leitura.

```php
dbg('##GET', '##POST', '##SERVER', '##FILES', '##COOKIE', '##SESSION', '##REQUEST', '##ENV');
```

Para maior agilidade para mostrar os dados GET e POST da página html, podesse simplimente chamar a função `dbg`, po´rem sem nenhum parâmetro, como mostrado a seguir:
```php
dbg();
```

<!-- Adicionar imagem -->

#### `##TIME`

Para verificar o tempo levado em certo código, ou qualquer outra contagem de tempo, use a palavra chave `##TIME`, que mostra o tempo entre o início da página e o momento da apresentação do `dbg('##TIME')`. Para que essa palavra chave funcione, é exencial que seja definido o tempo em unix do início da página usando a função `FastDbgPHP::setStartTime`, como mostrado no exemplo a seguir:

```php
// Pegue o tempo inicial de referencia do código, sempre deve ser aferido no começo da página
$inicial_time = microtime(true);

// Definindo o tempo inicial de referencia
FastDbgPHP::setStartTime($inicial_time);

/* O corpo do seu código */

// Mostrar o tempo usado pelo código
dbg('##TIME');
```
<!-- Adicionar imagem -->

<!-- setDevelopmentMode, setProjectName, setStyles, setDefaltValues, setStartTime, setClassList -->

<!-- * ##TRACE - Show traceback
* ##EXIT - Finish the code 
* 
* fdbg
* setStartTime -> setInicialTime
-->
