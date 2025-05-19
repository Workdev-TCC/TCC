<?php 
    function formatarDados($tipo, $valor) {
    $valor = trim($valor);
    $valor = preg_replace('/\s+/', ' ', $valor); // remove espaços múltiplos

    switch (strtolower($tipo)) {
        case 'telefone':
            // Remove tudo que não for número
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) == 11) {
                // Formato com DDD e 9 dígitos (celular)
                return '(' . substr($valor, 0, 2) . ') ' . substr($valor, 2, 5) . '-' . substr($valor, 7);
            } elseif (strlen($valor) == 10) {
                // Fixo com DDD
                return '(' . substr($valor, 0, 2) . ') ' . substr($valor, 2, 4) . '-' . substr($valor, 6);
            } else {
                return 'Telefone inválido';
            }

        case 'cep':
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) == 8) {
                return substr($valor, 0, 5) . '-' . substr($valor, 5);
            } else {
                return 'CEP inválido';
            }

        case 'cpf':
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) == 11) {
                return substr($valor, 0, 3) . '.' . substr($valor, 3, 3) . '.' . substr($valor, 6, 3) . '-' . substr($valor, 9);
            } else {
                return 'CPF inválido';
            }

        case 'inscricao_estadual':
            $valor = preg_replace('/\D/', '', $valor);
            if (strlen($valor) >= 9 && strlen($valor) <= 14) {
                // Exemplo: 123.456.789.000
                return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{0,5})/", "$1.$2.$3.$4", $valor);
            } else {
                return 'IE inválida';
            }

        case 'nome':
            // Deixa apenas letras e espaços
            $valor = mb_strtolower($valor, 'UTF-8'); // tudo minúsculo
            return mb_convert_case($valor, MB_CASE_TITLE, 'UTF-8'); // primeira de cada palavra maiúscula

        default:
            return 'Tipo inválido';
    }
}







?>