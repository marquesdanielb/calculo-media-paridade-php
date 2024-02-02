<?php

function verificarParidade($numero) {
    if ($numero % 2 == 0) {
        return ' é par';
    } else {
        return ' é ímpar';
    }
}

function calcularMediaCSV($arquivo) {
    if (($handle = fopen($arquivo, "r")) !== false) {
        $soma = [];
        $contador = [];
        
        while (($data = fgetcsv($handle, 10, ";")) !== false) {
            foreach ($data as $index => $value) {
                if (is_numeric($value)) {
                    if (!isset($soma[$index])) {
                        $soma[$index] = 0;
                        $contador[$index] = 0;
                    }

                    $soma[$index] += $value;
                    $contador[$index]++;
                }
            }
        }
        fclose($handle);

        $medias = [];
        foreach ($soma as $index => $value) {
            $medias[$index] = $value / $contador[$index];
        }

        return $medias;
    } else {
        return false;
    }
}

function calcularMediaColunas($medias) {
    if ($medias) {
        echo "Média das colunas numéricas: \n";
        foreach ($medias as $index => $media) {
            echo "Coluna $index: " . round($media, 2). "\n";
        }
    
        foreach ($medias as $media) {
            echo "A média ". round($media, 2) . verificarParidade($media) . "\n";
        }
    } else {
        echo "Erro ao ler o arquivo CSV.\n";
    }
}

$arquivoCSV = "data.csv";

$medias = calcularMediaCSV($arquivoCSV);
calcularMediaColunas($medias);
