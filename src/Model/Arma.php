<?php

namespace App\Model;

class Arma {
    public string $nome;
    public int $dano;
    public string $tipo;

    public function __construct(string $nome, int $dano, string $tipo) {
        $this->nome = $nome;
        $this->dano = $dano;
        $this->tipo = $tipo; 
    }
}
