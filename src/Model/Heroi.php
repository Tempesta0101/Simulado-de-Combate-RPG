<?php

namespace App\Model;

class Heroi {
    public string $nome;
    public string $classe;
    public int $nivel;
    public int $vida = 100;
    /** @var Arma[] */
    public array $armas = [];

    public function __construct(string $nome, string $classe, int $nivel) {
        $this->nome = $nome;
        $this->classe = $classe;
        $this->nivel = $nivel;
    }

    public function adicionarArma(Arma $arma): void {
        $this->armas[] = $arma;
    }

    public function atacar(): Arma {
        return $this->armas[array_rand($this->armas)];
    }

    public function receberDano(int $dano): void {
        $this->vida -= $dano;
    }

    public function estaVivo(): bool {
        return $this->vida > 0;
    }
}
