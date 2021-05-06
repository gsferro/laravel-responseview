<?php

namespace Gsferro\ResponseView\Traits;

/**
 * @author  Guilherme Ferro
 * @version 1.1
 *
 * Facilitando o compact todos os dados enviados para a view
 *
 */
trait ResponseView
{
    /**
     * @var array
     */
    private $data       = [];
    private $mergeData  = [];
    private $breadcrumb = [];

    /*
    |---------------------------------------------------
    | Metodos para adicionar variaveis
    |---------------------------------------------------
    */

    /**
     * Add os valores a serem enviados para a view
     *
     * @param string $key
     * @param string | array $value
     */
    private function addData($key, $value)
    {
        $this->data[ trim($key) ] = $value;
    }

    /**
     * Add os valores a serem enviados para a view e também guarda na session
     * Ideal para urls com reuso de verbos HTTP
     *
     * @param string $key
     * @param string | array $value
     */
    private function addDataSession($key, $value)
    {
        $this->data[ trim($key) ] = $value;
        session()->put('_view', [
            trim($key) => $value
        ]);
    }

    /**
     * Add os valores padrões a serem enviados para a view
     *
     * @param string $key
     * @param string | array $value
     */
    private function addMergeData($key, $value)
    {
        $this->mergeData[ trim($key) ] = $value;
    }

    /*
    |---------------------------------------------------
    | Metodos para uso de variaveis globais
    |---------------------------------------------------
    */

    /**
     * Adiciona o título na view
     *
     * @param string $titulo
     */
    private function addTitulo($titulo)
    {
        $this->addMergeData('titulo', $titulo);
    }

    /**
     * Adiciona o título na view
     *
     * @param string $subTitulo
     */
    private function addSubTitulo($subTitulo)
    {
        $this->addMergeData('subTitulo', $subTitulo);
    }

    /**
     * Adiciona o breadcrumb em cada view
     *
     * @param string $titulo
     * @param null $href [route() | url()]
     * @param null $icone [fa fa-* | glyphicon glyphicon-*]
     */
    private function addBreadcrumb($titulo, $href = null, $icone = null)
    {
        $this->breadcrumb[] = [
            "titulo"  => $titulo,
            "href"    => $href,
            "icone"   => $icone,
        ];

        $this->addMergeData('breadcrumb', $this->breadcrumb);
    }

    /*
    |---------------------------------------------------
    | Adicionar valores via direto de array
    |---------------------------------------------------
    */

    /**
     * Adiciona um array direto no data
     *
     * @param array $array
     */
    public function addArrayData(array $array)
    {
        $this->data = array_merge($this->data, $array);
    }

    /**
     * Adiciona um array direto no mergeData
     *
     * @param array $array
     */
    public function addArrayMergeData(array $array)
    {
        $this->mergeData = array_merge($this->data, $array);
    }

    /*
    |---------------------------------------------------
    | Retorno da view para renderização
    |---------------------------------------------------
    */

    /**
     * Chamada para devolver a view ja com os arrays data e extra
     *
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function view(string $view)
    {
        return view($view, $this->data, $this->mergeData);
    }

    /*
    |---------------------------------------------------
    | Para exibição dos dados para debug
    |---------------------------------------------------
    */

    /**
     * retorna os valores contidos
     *
     * @param null $key
     * @return array
     */
    private function getData($key = null)
    {
        return (empty($key) ? $this->data : $this->data[ $key ]);
    }

    /**
     * retorna os valores contidos
     *
     * @param null $key
     * @return array
     */
    private function getMergeData($key = null)
    {
        return (empty($key) ? $this->mergeData : $this->mergeData[ $key ]);
    }
}
