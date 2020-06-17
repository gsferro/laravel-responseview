# Laravel ResponseView
Um jeito fácil de fazer reuso de variaveis e disponibilizar para a view.

### Instalação
- Faça o download via composer
>``
composer require gsferro/responseview
``
- Adicione no controller a trait
>``
use ResponseView;
``

### Métodos 
- $this->addData($chave, $valor)

> Prepara os dados para ser enviado para a view dentro do scope do metodo

ex:
```php
public function index()
{
    $this->addData("nome", "Meu nome");
    $this->addData("sobrenome", "Sobrenome");
    ...
    
    return $this->view('nome_view');
}
```
 
- $this->addMergeData($chave, $valor)

> Prepara os dados para ser enviado para a view globalmente.
> deve ser usado no construct do Controller

ex:
```php
public function __construct()
{
    $this->addMergeData("sexos", ["M", "F"]);
    $this->addMergeData("situacao", ["Ativo", "Inativo"]);
}
```
 
- $this->addTitulo($valor) / $this->addSubTitulo($valor)

> Coloca um titulo e um subtitulo na pagina

ex:
```php
public function __construct()
{
    $this->addTitulo("Titulo da pagina"); // $titulo
    $this->addSubTitulo("Sub titulo da pagina"); //$subTitulo
}
```
- addBreadcrumb 

> Adiciona o breadcrumb em cada view
>
>@param string $titulo
>
>@param null $href [route() | url()]
>
>@param null $icone [fa fa-* | glyphicon glyphicon-*]

ex
```php
 public function exemplo()
 {
     // Se voce não setar, ele colocará sempre o titulo da página
     $this->addBreadcrumb("Titulo"); // breadcrumb
     // ou informe o titulo e uma rota para click  
     $this->addBreadcrumb("Titulo", route('index')); // breadcrumb
     // colocando icone no link
     $this->addBreadcrumb("Titulo", route('index'), "home"); // breadcrumb
     // colocando icone no nome
     $this->addBreadcrumb("Titulo", null, "home"); // breadcrumb
     
     // se quiser criar uma sequencia migralhas   
     $this->addBreadcrumb("titulo"); // titulo
     $this->addBreadcrumb("titulo 2", route('index')); // titulo > titulo 2
     $this->addBreadcrumb("titulo 3", null, 'file-o'); // titulo > titulo 2 > titulo 3
 }
 ```