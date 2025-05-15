<?php

require 'vendor/autoload.php';

use App\Model\Heroi;
use App\Model\Arma;
use App\Model\Monstro;
use App\Model\Batalha;

$mago = new Heroi("Aldar", "Mago", 5);
$mago->adicionarArma(new Arma("Bastão Flamejante", 20, "fogo"));
$mago->adicionarArma(new Arma("Orbe de Gelo", 15, "gelo"));

$guerreiro = new Heroi("Thorg", "Guerreiro", 7);
$guerreiro->adicionarArma(new Arma("Espada Longa", 25, "corte"));
$guerreiro->adicionarArma(new Arma("Machado de Sombra", 18, "sombra"));
$guerreiro->adicionarArma(new Arma("Machadão de Guerra", 47, "Sangramento"));


$ladino = new Heroi("Nira", "Ladino", 6);
$ladino->adicionarArma(new Arma("Adagas Rápidas", 12, "gelo"));
$ladino->adicionarArma(new Arma("Lâmina Sombria", 15, "sombra"));
$ladino->adicionarArma(new Arma("Estocada de Adagas", 42, "físico"));

$orc = new Monstro("Orc Guerreiro", 120, "bruto");
$golem = new Monstro("Golem de Pedra", 160, "elemental");
$necromante = new Monstro("Necromante", 140, "mágico");

$batalha = new Batalha([$mago, $guerreiro, $ladino], [$orc, $golem, $necromante]);
$resultado = $batalha->iniciar();

$resultado->exibir();
