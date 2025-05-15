<?php

namespace App\Model;

class Batalha {
    /** @var Heroi[] */
    private array $herois;
    /** @var Monstro[] */
    private array $monstros;
    private Resultado $resultado;
    private int $turno = 1;

    public function __construct(array $herois, array $monstros) {
        $this->herois = $herois;
        $this->monstros = $monstros;
        $this->resultado = new Resultado();
    }

    public function iniciar(): Resultado {
        $this->resultado->adicionarLog("🔥 A batalha começa com " . count($this->herois) . " heróis e " . count($this->monstros) . " monstros!");

        while ($this->temHeroisVivos() && $this->temMonstrosVivos()) {
            $this->resultado->adicionarLog("🌀 Turno {$this->turno}:");

            foreach ($this->herois as $heroi) {
                if (!$heroi->estaVivo() || empty($this->monstrosVivos())) continue;

                $alvo = $this->monstrosVivos()[array_rand($this->monstrosVivos())];
                $arma = $heroi->atacar();
                $dano = $arma->dano;

                $alvo->receberDano($dano);
                $this->resultado->adicionarLog("🗡️ {$heroi->nome} ({$heroi->classe}) ataca {$alvo->nome} com {$arma->nome}, causando {$dano} de dano.");

                // Efeitos especiais das armas
                switch ($arma->tipo) {
                    case 'fogo':
                        $alvo->aplicarStatus("🔥 queimando");
                        $this->resultado->adicionarLog("🔥 {$alvo->nome} está queimando!");
                        break;
                    case 'gelo':
                        $alvo->aplicarStatus("❄️ congelado");
                        $this->resultado->adicionarLog("❄️ {$alvo->nome} foi congelado e perderá o próximo turno!");
                        break;
                    case 'sombra':
                        $alvo->aplicarStatus("🌑 enfraquecido");
                        $this->resultado->adicionarLog("🌑 {$alvo->nome} foi envolto em sombras e teve sua força reduzida!");
                        break;
                    case 'Sangramento':
                        $alvo->aplicarStatus("sangrando");
                        $this->resultado->adicionarLog(" {$alvo->nome} sofreu um corte profundo e está sangrando!");
                        break;
                        
                }

                if (!$alvo->estaVivo()) {
                    $this->resultado->adicionarLog("💥 {$alvo->nome} foi derrotado!");
                }
            }

            foreach ($this->monstros as $monstro) {
                if (!$monstro->estaVivo() || empty($this->heroisVivos())) continue;

                if (in_array("❄️ congelado", $monstro->status)) {
                    $this->resultado->adicionarLog("❄️ {$monstro->nome} está congelado e perde o turno!");
                    $monstro->status = array_diff($monstro->status, ["❄️ congelado"]);
                    continue;
                }

                $alvo = $this->heroisVivos()[array_rand($this->heroisVivos())];
                $dano = in_array("🌑 enfraquecido", $monstro->status) ? rand(5, 12) : rand(10, 25);

                $alvo->receberDano($dano);
                $this->resultado->adicionarLog("👹 {$monstro->nome} ataca {$alvo->nome} e causa {$dano} de dano!");
                
                if (!$alvo->estaVivo()) {
                    $this->resultado->adicionarLog("☠️ {$alvo->nome} foi abatido!");
                }
            }

            $this->turno++;
        }

        if ($this->temHeroisVivos()) {
            $this->resultado->vencedor = "Heróis";
            $this->resultado->adicionarLog("🏆 Os heróis venceram a batalha!");
        } else {
            $this->resultado->vencedor = "Monstros";
            $this->resultado->adicionarLog("💀 Os monstros venceram!");
        }

        return $this->resultado;
    }

    private function temHeroisVivos(): bool {
        foreach ($this->herois as $h) {
            if ($h->estaVivo()) return true;
        }
        return false;
    }

    private function temMonstrosVivos(): bool {
        foreach ($this->monstros as $m) {
            if ($m->estaVivo()) return true;
        }
        return false;
    }

    private function monstrosVivos(): array {
        return array_filter($this->monstros, fn($m) => $m->estaVivo());
    }

    private function heroisVivos(): array {
        return array_filter($this->herois, fn($h) => $h->estaVivo());
    }
}
