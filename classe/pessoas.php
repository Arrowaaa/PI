<?php

class pessoas
{
    // Função para formatar o peso
    public static function formatarPeso($peso) {
        return $peso . ' kg';
    }
    
    // Função para formatar o sexo do pet
    public static function formatarSexop($sexo) {
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
    // Função para formatar o sexo cliente
    public static function formatarSexo($sexo) {
        switch ($sexo) {
            case 'M':
                return 'Masculino';
            case 'F':
                return 'Feminino';
            case 'O':
                return 'Outros';
            default:
                return 'Desconhecido';
        }
    }
    // Função para formatar a data para exibir a idade do pet
    public function calcularIdade($data_nascimento) {
        $data_nascimento = new DateTime($data_nascimento);
        $data_atual = new DateTime();
        $idade = $data_atual->diff($data_nascimento);
        return $idade->y; 
    }

   
}

