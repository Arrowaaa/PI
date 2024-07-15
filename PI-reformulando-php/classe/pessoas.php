<?php

class pessoas
{
    // Função para formatar o peso
    public static function formatarPeso($peso) {
        return $peso . ' kg';
    }
    
    // Função para formatar o sexo
    public static function formatarSexo($sexo) {
        switch ($sexo) {
            case 'M':
                return 'Macho';
            case 'F':
                return 'Fêmea';
            case 'O':
                return 'Outros';
            default:
                return 'Desconhecido';
        }
    }
}

