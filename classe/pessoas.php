<?php

class pessoas
{

    public static function servico($servico)
    {
        switch ($servico) {
            case '1':
                return 'Consultas Veterinárias';
            case '2':
                return 'Vacinação e Prevenção';
            case '3':
                return 'Cirurgia';
            case '4':
                return 'Exames Laboratoriais';
            case '5':
                return 'Atendimento de Emergência';
            case '6':
                return 'Raio-X';
            case '7':
                return 'Internação';
            default:
                return 'Sem Serviço';
        }
    }
    // Função para formatar o peso
    public static function formatarPeso($peso)
    {
        return $peso . ' kg';
    }

    // Função para formatar o sexo do pet
    public static function formatarSexop($sexop)
    {
        switch ($sexop) {
            case 'M':
                return 'Macho';
            case 'F':
                return 'Fêmea';
            case 'O':
                return 'Outros';
            default:
                return 'Não Definido';
        }
    }
    // Função para formatar o sexo cliente
    public static function formatarSexo($sexo)
    {
        switch ($sexo) {
            case 'M':
                return 'Masculino';
            case 'F':
                return 'Feminino';
            case 'O':
                return 'Outros';
            default:
                return 'Não Definido';
        }
    }
    // Função para formatar a data para exibir a idade do pet
    public function calcularIdade($data_nascimento)
    {
        $data_nascimento = new DateTime($data_nascimento);
        $data_atual = new DateTime();
        $idade = $data_atual->diff($data_nascimento);
        $anos = $idade->y;
        $meses = $idade->m;
        
        return " {$anos} anos e {$meses} mês ";
    }
}
