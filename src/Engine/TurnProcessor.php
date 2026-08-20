<?php
declare(strict_types=1);
namespace SGW\Engine;
final class TurnProcessor {
    public function __construct(private int $intervalSeconds=1800,private int $maxTurns=10000,private int $generationThreshold=4000){}
    public function calculate(array $state,\DateTimeImmutable $now):array{
        $last=new \DateTimeImmutable((string)($state['last_turn_at']??'now'));
        $elapsed=max(0,$now->getTimestamp()-$last->getTimestamp());
        $completed=(int)floor($elapsed/$this->intervalSeconds);
        $currentTurns=max(0,(int)($state['attack_turns']??0));
        $capacity=max(0,(int)($state['turn_max_storage']??$this->maxTurns)-$currentTurns);
        $newTurns=min($completed,$capacity);
        $applyGeneration=((int)($state['untrained_units']??0)<$this->generationThreshold);
        $unitProduction=$applyGeneration?max(0,(int)($state['unit_production']??0)*$completed):0;
        $newUntrained=max(0,(int)($state['untrained_units']??0)+$unitProduction);
        $raceIncome=(float)($state['race_income_multiplier']??1.0);
        $defconIncome=(float)($state['defcon_income_multiplier']??1.0);
        $baseIncome=((int)($state['untrained_units']??0)*20)+(((int)($state['miners']??0)+(int)($state['lifers']??0))*80);
        $income=max(0,(int)floor($baseIncome*$raceIncome*$defconIncome));
        $advanceSeconds=$completed*$this->intervalSeconds;
        $nextLast=$last->modify('+'.$advanceSeconds.' seconds');
        return ['elapsed_seconds'=>$elapsed,'completed_turns'=>$completed,'new_turns'=>$newTurns,'unit_production'=>$unitProduction,'new_untrained_units'=>$newUntrained,'base_income'=>$baseIncome,'income'=>$income,'next_last_turn_at'=>$nextLast->format('Y-m-d H:i:s'),'generation_applied'=>$applyGeneration];
    }
}
