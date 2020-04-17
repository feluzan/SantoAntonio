<?php

namespace App\Services;

use Carbon\Carbon;

class ViewsHelperService
{
    use DateFormatService;

    /**
     * Recupera a informação da classe utilizando encadeamento
     *
     * @param $entity
     * @param $field
     *
     * @return string
     */
    public function get_dot_notation($entity, $field)
    {
        $paths = explode('.', $field);

        //Caso seja um atributo da entidade, retorna direto
        if (count($paths) == 1) {
            return $entity->{$paths[0]};
        }

        $result = $entity;
        foreach ($paths as $path) {
            $result = $result->{$path};
            if (!$result) {
                return '';
            }
        }

        return $result;
    }



    /**
     * Formata CNPJ, CPF e CEP para exibição
     *
     * @param        $string
     * @param string $tipo
     *
     * @return mixed|string
     */
    public function formatCnpjCpfCep($string, $tipo = "")
    {
        $string = preg_replace("[^0-9]", "", $string);
        if (!$tipo) {
            switch (strlen($string)) {
                case 8:
                    $tipo = 'cep';
                    break;
                case 11:
                    $tipo = 'cpf';
                    break;
                case 14:
                    $tipo = 'cnpj';
                    break;
            }
        }
        switch ($tipo) {

            case 'cep':
                $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
                break;
            case 'cpf':
                $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
                break;
            case 'cnpj':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . '.' . substr($string, 5, 3) . '/' . substr(
                    $string,
                    8,
                    4
                ) . '-' . substr($string, 12, 2);
                break;
        }

        return $string;
    }
}
