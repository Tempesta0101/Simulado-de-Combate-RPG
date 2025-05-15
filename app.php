<?php

require 'vendor/autoload.php';

use App\Model\Heroi;
use App\Model\Arma;
use App\Model\Monstro;
use App\Model\Batalha;

$mago = new Heroi("JooaWP", "Mago", 5);
$mago->adicionarArma(new Arma("Bastão Flamejante", 20, "fogo"));
$mago->adicionarArma(new Arma("Orbe de Gelo", 15, "gelo"));
$mago->adicionarArma(new Arma("Tsunami de Água", 38, "Água"));

$guerreiro = new Heroi("Luchoji", "Guerreiro", 7);
$guerreiro->adicionarArma(new Arma("Espada Longa", 25, "corte"));
$guerreiro->adicionarArma(new Arma("Machado de Sombra", 18, "sombra"));
$guerreiro->adicionarArma(new Arma("Machadão de Guerra", 47, "Sangramento"));


$ladino = new Heroi("Ticunas", "Ladino", 6);
$ladino->adicionarArma(new Arma("Adagas Rápidas", 12, "gelo"));
$ladino->adicionarArma(new Arma("Lâmina Sombria", 15, "sombra"));
$ladino->adicionarArma(new Arma("Estocada de Adagas", 42, "físico"));

$orc = new Monstro("Orc da Montanha", 120, "bruto");
$golem = new Monstro("Dragão Supremo", 160, "elemental");
$necromante = new Monstro("Necromante", 140, "mágico");

$batalha = new Batalha([$mago, $guerreiro, $ladino], [$orc, $golem, $necromante]);
$resultado = $batalha->iniciar();

$resultado->exibir();
