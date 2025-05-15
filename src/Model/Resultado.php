<?php

namespace App\Model;

class Resultado {
    public string $vencedor = '';
    public array $log = [];

    public function adicionarLog(string $mensagem): void {
        $this->log[] = $mensagem;
    }

    public function exibir(): void {
        foreach ($this->log as $linha) {
            echo $linha . PHP_EOL;
            usleep(2000000);
        }
        echo "🧾 Vencedor: {$this->vencedor}" . PHP_EOL;
    }
}
