<?php
declare(strict_types=1);
namespace SGW\Engine;
final class CovertEngine {
    public function recon(array $attacker,array $defender,int $seed):array{$atk=Formulas::covert((int)($attacker['spies']??0),(int)($attacker['spy_level']??1),(float)($attacker['covert_multiplier']??1),(float)($attacker['race_covert_multiplier']??1));$def=Formulas::antiCovert((int)($defender['anti_spies']??0),(int)($defender['anti_spy_level']??1),(float)($defender['anti_covert_multiplier']??1),(float)($defender['race_anti_covert_multiplier']??1));$success=$atk>=$def;$detected=$success&&((($seed%100)+100)%100)<(int)($defender['defcon_percent']??0);return ['seed'=>$seed,'success'=>$success,'detected'=>$detected,'attacker_power'=>$atk,'defender_power'=>$def];}
    public function sabotage(array $attacker,array $defender,int $seed):array{$result=$this->recon($attacker,$defender,$seed);$result['damage_percent']=$result['success']?(5+(abs($seed)%21)):0;return $result;}
}
