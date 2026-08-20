<?php
declare(strict_types=1);
namespace SGW\Engine;
final class CombatResolver {
    public function resolve(array $attacker,array $defender,string $action,int $turns,int $seed):array{
        if($turns<1||$turns>15)throw new \InvalidArgumentException('Combat turns must be 1-15');
        $a=(float)($attacker['strike_action']??$attacker['attack_power']??0)*max(1,$turns);
        $d=(float)($defender['defense_action']??$defender['defense_power']??0);
        $ratio=$d>0?$a/$d:999999.0;$win=$a>=$d;
        $casualtyRate=$win?min(.5,.08+abs(log(max($ratio,.0001)))*.04):min(.8,.12+abs(log(max($ratio,.0001)))*.06);
        return ['seed'=>$seed,'action'=>$action,'turns'=>$turns,'winner'=>$win?'attacker':'defender','attacker_power'=>$a,'defender_power'=>$d,'ratio'=>$ratio,'attacker_casualty_rate'=>$casualtyRate,'defender_casualty_rate'=>$win?$casualtyRate*.6:$casualtyRate,'loot_naquadah'=>$win?(int)floor(max(0,(float)($defender['naquadah']??0))*.10):0];
    }
}
