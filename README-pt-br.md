# FastDbgPHP
Biblioteca para auxiliar na depuração no PHP.
Usuário do PHP a mais de uma decada de forma não profissional nunca gostei de usar no nosso velho conhecido `php var_dump();`, então, resolvemos (Eu, e Mocno) brincar um pouco no PHP e criar essa biblioteca para auxiliar na hora da depuração dos códigos.

### Exemplo:
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
        "midle" => ["de", "Sousa"],
        "last" => "Correa"
    ],
    "age" => 18,
    "from" => "Brazil"
];

dbg($a, $b, $c, $d, $e, $f, $g, $h);
```

![Representation of FastDbgPHP](https://github.com/LePampim/FastDbgPHP/assets/71104962/cc5f35a9-599b-4e41-9bd2-f4308d026aaf)


### Usabilidade:

Temos fazer o FastDbgPHP ser o mais simples possível, mas o mais personalizável também. Para a simplicidade optamos por gerar apenas um único arquivo, sem nem mesmo o .css, e para a personalização adicionamos funções que achamos mais úteis neste momento.

## Utilização:

Para usar a biblioteca no seu projeto é necessário chamar-la `require_once "../fastdDbgPHP.class.php";`, setar a variável `$isDev` do seu projeto através da linha de códiogo `FastDbgPHP::setDevelopmentMode($isDev);`, obviamente definida com `true` e sair utilizando a função `dbg();` para apresentar as variáveis que desejar.

```php
$isDev = true;

require_once "../fastdDbgPHP.class.php";
FastDbgPHP::setDevelopmentMode($isDev);

$a = 1;

dbg($a);
```

Quantas vezes não precisar parar o código para podemos visuaizar o status da variável executando após o `php var_dump();` o comando `exit;`. No FastDbgPHP pode setar em qualquer das variaveis enviadas o termo `##EXIT` que automaticamente ao final a biblioteca executa o comando `exit;` e para a depuração.

## Palavras Chaves

### `##GET` e `##POST`

```php
dbg('##GET', '##POST');
```

Apresenta as variveis que vieram no modo `$_GET;` ou `$_POST;`; 
![image](https://github.com/LePampim/FastDbgPHP/assets/71104962/9146e620-ade6-40cc-b8be-3c0859ffe0e9)

Apresenta as variveis que vieram no modo `$_POST;`

### `##SERVER`,  `##SERVER`, `##SERVER`, `##SERVER`, `##SERVER`, `##SERVER`

```php
dbg('##SERVER', '##FILES', '##COOKIE', '##SESSION', '##REQUEST', '##ENV');
```

Apresenta as variveis do `$_SERVER;`, `$FILES;`, `$COOKIE;`, `$SESSION;`, `$REQUEST;`, `$ENV;` respectivamentes.

### `#TIME`

É possivel apresentar o tempo entre o inicio da pagina e o momento da apresentação do `dbg();` e para isso vc precisa apenas setar uma varível no inicio do seu código PHP.
```php
$start_time = microtime(true);
```
e depois informa-lo ao FastDbgPHP
```php
FastDbgPHP::setStartTime($start_time);
```

![image](https://github.com/LePampim/FastDbgPHP/assets/71104962/dc4afc57-0761-4084-a964-405b343d7732)



