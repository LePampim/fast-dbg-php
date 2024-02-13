# FastDbgPHP
Biblioteca para depuração de páginas PHP de forma simples e rápida em ambiente HTML. Um dos principais motivos para criação deste projeto é a simplificação no momento da depuração, sem perder a possibilidade da personalização.

```php
$a = "Hello Word";
$b = null;
$c = True;
$d = 42;
$e = 3.14159265359;
$f = [];
$g = ["orange", "banana", "apple"];
$h = [
    "name" => [
        "first" => "Gustavo",
        "middle" => ["de", "Sousa"],
        "last" => "Correa"
    ],
    "age" => 18,
    "from" => "Brazil"
];
$i = new Person("Maria", 19);

fdbg($a, $b, $c, $d, $e, $f, $g, $h, $i);
```

![image](https://github.com/LePampim/FastDbgPHP/assets/71104962/d3ca9e75-a3a8-44a2-bc3e-f581e8c52611)

Assim, com esse repositório, o processo de depuração tornou-se mais fácil, para depurar seu código basta uma chamada da função `fdbg` para criar um painel informativo sobre a variável.
Além disso, com as palavras chaves, explicadas adiante, a depuração do seu ambiente se torna mais rápida e produtiva.
E, ainda, outro ponto fundamental do projeto é a personalização, para tal funções como `FastDbgPHP::setProjectName` e `FastDbgPHP::setStyles` foram criadas.

## Utilização

Para usar a esta biblioteca no seu projeto é necessário apenas a importação e a definição do estado do projeto através da função `FastDbgPHP::setDevelopmentMode`, ou seja, no caso de estar no modo de desenvolvimento defina `True`, se não, `False`. Depois isso, toda configuração basica ja foi realizada, basta depurar as variáveis de interesse, não precisa economizar, coloque quantas quiser, é sempre bom saber o que o código está fazendo.

```php
// Importando a biblioteca FastDbgPHP
require_once "../fastDbgPHP.class.php";

// Defina o modo que da página
// no caso de estar no modo de desenvolvimento defina True, se não, False
FastDbgPHP::setDevelopmentMode($isDev);

// Por fim, simplesmente depure suas variáveis
$value = rand(1, 1000);
$other_value = $value - 10;

fdbg($value, $other_value);
```

Não recomendamos deixar códigos de depuração, no caso `fdbg`, em produção, porém, para maior segurança do seu código, apenas quando seu projeto estiver no modo de desenvolvimento essa função mostrará resultados na página.

Outra função importante são as palavras chave, explicadas a seguir.

### Palavras Chaves

#### Variaveis Globais: `##GET`, `##POST`, `##SERVER`, `##FILES`, `##COOKIE`, `##SESSION`, `##REQUEST` e `##ENV`

As palavras chaves `##GET`, `##POST`, `##SERVER`, `##FILES`, `##COOKIE`, `##SESSION`, `##REQUEST` e `##ENV` mostram as variáveis globais `$_GET`, `$_POST`, `$_SERVER`,  `$_FILES`, `$_COOKIE`, `$_SESSION`, `$_REQUEST` e `$_ENV`, respectivamente, simplificando a depuração e facilitando sua leitura no código.

```php
fdbg('##GET', '##POST', '##SERVER', '##FILES', '##COOKIE', '##SESSION', '##REQUEST', '##ENV');
```

Para maior agilidade para mostrar os dados GET e POST da página html, pode-se simplesmente chamar a função `fdbg`, porém sem nenhum parâmetro, como mostrado a seguir:

```php
// para maior velocidade, use:
fdbg();
// em vez de:
fdbg('##GET', '##POST');
// as duas formas mostram a mesma coisa
```

<!-- Adicionar imagem -->

#### Controle de tempo: `##TIME`

Para verificar o tempo levado em certo código, ou qualquer outra contagem de tempo, use a palavra chave `##TIME`, que mostra o tempo entre o início da página e o momento da chamada do `fdbg`. Para que essa palavra chave funcione, é essencial que seja definido o tempo em unix do início da página usando a função `FastDbgPHP::setInicialTime`, como mostrado no exemplo a seguir:

```php
// Pegue o tempo inicial de referencia do código, sempre deve ser aferido no começo da página
$inicial_time = microtime(true);

// Definindo o tempo inicial de referência
FastDbgPHP::setInicialTime($inicial_time);

/* O corpo do seu código */

// Por fim, mostra o tempo usado pelo código
fdbg('##TIME');
```

### `##TRACE`
Mostra o histórico das linhas de código até a chamada da função `fdbg`, na forma de uma lista. Por exemplo, temos:

```php
function factorial(int $n) {
    if ($n == 0 or $n == 1) {
        fdbg('##TRACE');
        return 1;
    }

    return $n * factorial($n-1);
}

fdbg(factorial(10));
```

<!-- Testar código kk -->
<!-- Adicionar imagem -->

### `##EXIT`
Ao terminar a apresentação da função `fdbg`, a função finalizara a página. Por exemplo:

```php
$zero = 0;
fdbg($zero, `##EXIT`);
// nada a partir daqui será executado

echo 'Hello world';
echo $zero / $zero;
```

<!-- Testar código kk -->

<!--
## Configurações
### setDevelopmentMode 
Muito recomendado

### setProjectName
Apenas para personalização

### setStyles
Apenas para personalização

### setDefaultValues
Pode acrescentar mais agilidade

### setInicialTime
Acrescenta utilidade

-->
