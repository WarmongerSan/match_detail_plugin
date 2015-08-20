<?php $options = get_option('eg_setting');		

switch($game->queueType){

	

	case "RANKED_SOLO_5x5":

		$game->queueType = "Ranked";

		break;

	case "NORMAL":

		$game->queueType = "Normal";

		break;

	case "NORMAL_3x3":

		$game->queueType = "Normal 3x3";

		break;

	case "CAP_5x5":

		$game->queueType = "Team Builder";

		break;

	case "BOT":

		$game->queueType = "Bot";

		break;

	case "BOT_3x3":

		$game->queueType = "Bot 3x3";

		break;

	case "RANKED_PREMADE_3x3":

		$game->queueType = "Premade 3x3";

		break;

	case "RANKED_PREMADE_5x5":

		$game->queueType = "Premade";

		break;

	case "RANKED_TEAM_3x3":

		$game->queueType = "Teams 3x3";

		break;

	case "RANKED_TEAM_5x5":

		$game->queueType = "Teams";

		break;

	case "ARAM_UNRANKED_5x5":

		$game->queueType = "Aram Unranked";

		break;

	case "ONEFORALL_5x5":

		$game->queueType = "One For All";

		break;

	case "URF":

		$game->queueType = "Ultra Rapid Fire";

		break;

	case "URF_BOT":

		$game->queueType = "Ultra Rapid Fire Bot";

		break;

	case "HEXAKILL":

		$game->queueType = "Hexakill";

		break;

	case "KING_PORO":

		$game->queueType = "King Poro";

		break;

	case "COUNTER_PICK":

		$game->queueType = "Counter Pick";

		break;
		
	default:
		
		break;

}
		?>
		
		<div class="blue-team pull-left">
		<?php
$dmgDealt = array();
$dmgTaken = array();
$maxGold = array();
foreach($game->participants as $participant):

	$dmgDealt[$participant->participantId] = $participant->stats->totalDamageDealt;
	$dmgTaken[$participant->participantId] = $participant->stats->totalDamageTaken;
	$maxGold[$participant->participantId] = $participant->stats->goldEarned;

endforeach;
		
arsort($dmgDealt);
arsort($dmgTaken);
arsort($maxGold);

// var_dump($maxGold);
		
$i = 0;
foreach($game->participants as $participant):
	
		$participant->championName = $champions['keys']->{$participant->championId};

		if (isset($participant->stats->item0)) {
			$participant->item0 = $participant->stats->item0;
		} else { 
			$participant->item0 = '0';
		}

		if (isset($participant->stats->item1)) {
			$participant->item1 = $participant->stats->item1;
		} else {
			$participant->item1 = '0';
		}

		if (isset($participant->stats->item2)) {
			$participant->item2 = $participant->stats->item2;
		} else {
			$participant->item2 = '0';
		}

		if (isset($participant->stats->item3)) {
			$participant->item3 = $participant->stats->item3;
		} else {
			$participant->item3 = '0';
		}

		if (isset($participant->stats->item4)) {
			$participant->item4 = $participant->stats->item4;
		} else {
			$participant->item4 = '0';
		}

		if (isset($participant->stats->item5)) {
			$participant->item5 = $participant->stats->item5;
		} else {
			$participant->item5 = '0';
		}

		if (isset($participant->stats->item6)) {
			$participant->item6 = $participant->stats->item6;
		} else {
			$participant->item6 = '0';
		}

		if (!isset($participant->stats->kills)) {$participant->stats->kills = 0;}

		if (!isset($participant->stats->deaths)) {$participant->stats->deaths = 0;}

		if (!isset($participant->stats->assists)) {$participant->stats->assists = 0;}
		
		if($i == 5){
			echo "
				</div><div class='purple-team pull-right'>
			";			
		}
		?>
		
		<div class="<?php echo ($i < 5) ? 'blue' : 'purple'; ?>-player player<?php echo $i; ?><?php echo ($_GET['participantId'] == $participant->participantId) ? ' searched' : ''; ?>">
			<div class="player-info <?php echo ($participant->stats->winner == "true") ? 'win' : 'lost'; ?>" style="float: <?php echo ($i < 5) ? 'left' : 'right' ; ?>;">
				<div class="player-details">
					<div class="pull-left"><img class="img-circle" src="<?php echo get_match_champion_path_for_id($participant->championId); ?>" /></div>
					<div class="info">
						<span class="name"><?php echo ($game->queueType == "Ranked" || 
													   $game->queueType == "Teams" || 
													   $game->queueType == "Premade 3x3" || 
													   $game->queueType == "Premade" ||
													   $game->queueType == "Teams 3x3") ? $game->participantIdentities[($participant->participantId - 1)]->player->summonerName : $participant->championName; ?></span>
						<span class="kda"><?php echo $participant->stats->kills . " / " . $participant->stats->deaths . " / " . $participant->stats->assists; ?></span><br/>
						<span class="champion"><?php echo $participant->championName; ?> | <?php echo $game->queueType; ?></span><br/>
						<span class="rest">level <?php echo $participant->stats->champLevel; ?> | <?php echo $participant->stats->minionsKilled ?> creep | <?php echo round($participant->stats->goldEarned / 1000, 1) ?>k gold | kda <?php echo round(($participant->stats->kills + $participant->stats->assists) / $participant->stats->deaths, 2); ?></span>
					</div>
				</div>
				<div style="clear:both;">
					<img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item0); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item1); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item2); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item3); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item4); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item5); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item6); ?>" /><img class="img-spell" src="<?php echo get_match_spell_path_for_id($participant->spell1Id); ?>" /><img class="img-spell" src="<?php echo get_match_spell_path_for_id($participant->spell2Id); ?>" />
				</div>
			<div class="progress-info" style="float: <?php echo ($i < 5) ? 'left' : 'right' ; ?>;">
				<div class="progress-bar">
				  <div class="bar red" style="clear: both; width: <?php echo ($dmgDealt[$participant->participantId] / max($dmgDealt) * 100); ?>% !important;">&nbsp;</div>
				  <div class="bar green" style="clear: both; width: <?php echo ($dmgTaken[$participant->participantId] / max($dmgTaken) * 100); ?>% !important;">&nbsp;</div>
				  <div class="bar orange" style="clear: both; width: <?php echo ($maxGold[$participant->participantId] / max($maxGold) * 50); ?>% !important;">&nbsp;</div>
				</div>
			</div>
			</div>
			<div style="clear: both;"></div>
		</div>

		<?php

$i ++; endforeach;
		?>
</div>
