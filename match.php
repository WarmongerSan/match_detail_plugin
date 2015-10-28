<script>
function loadHistory(summonerName, region) {
	window.open("http://www.lolhistoryapp.com/history/?summoner="+summonerName.replace(/\s+/g, '').toLowerCase()+"&region="+region,"_self")
}
</script>

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
$dmgDealt = array();
$dmgTaken = array();
$maxGold = array();
$teamKills = array();
$teamKills[100] = 0;
$teamKills[200] = 0;
$teamAssists = array();
$teamAssists[100] = 0;
$teamAssists[200] = 0;
$teamDeaths = array();
$teamDeaths[100] = 0;
$teamDeaths[200] = 0;

foreach($game->participants as $participant):
	$dmgDealt[$participant->participantId] = $participant->stats->totalDamageDealt;
	$dmgTaken[$participant->participantId] = $participant->stats->totalDamageTaken;
	$maxGold[$participant->participantId] = $participant->stats->goldEarned;
	$teamKills[$participant->teamId] += $participant->stats->kills;
	$teamAssists[$participant->teamId] += $participant->stats->assists;
	$teamDeaths[$participant->teamId] += $participant->stats->deaths;
	$teamGold[$participant->teamId] += $participant->stats->goldEarned;
	$teamTowers[$participant->teamId] += $participant->stats->towerKills;
	$teamWin[$participant->teamId] = $participant->stats->winner;
endforeach;
foreach($game->teams as $team):
	$teamDragons[$team->teamId] = $team->dragonKills;
	$teamBarons[$team->teamId] = $team->baronKills;
	$teamBans[$team->teamId][0] = $team->bans[0]->championId;
	$teamBans[$team->teamId][1] = $team->bans[1]->championId;
	$teamBans[$team->teamId][2] = $team->bans[2]->championId;
endforeach;
arsort($dmgDealt);
arsort($dmgTaken);
arsort($maxGold);
$i = 0;
?>
<table class="match-table">
	<tr class="team-info">
		<td>
			<table>
				<tr>
					<td class="pull-left" style="width: 15%; margin-left: 5%;">
						<?php echo $teamKills[100] . "/" . $teamDeaths[100] . "/" . $teamAssists[100]; ?>
					</td>
					<td class="pull-left" style="width: 15%;">
						<?php echo "Gold <b><span class='blue-text'>" . round($teamGold[100] / 1000, 2) . "K</span></b>"; ?>
					</td>
					<td class="pull-left" style="width: 15%;">
						<?php echo "T <b><span class='blue-text'>" . $teamTowers[100] . "</span></b> D <b><span class='blue-text'>" . $teamDragons[100] . "</span></b> B <b><span class='blue-text'>" . $teamBarons[100] . "</span></b>"; ?>
					</td>
					<td class="pull-left" style="width: 15%;">
						Bans:
						 <img class="img-circle" style="width: 20%; height: auto; margin-left: 5px;" src="<?php echo get_match_champion_path_for_id($teamBans[100][0]); ?>" />
						 <img class="img-circle" style="width: 20%; height: auto; margin-left: 5px;" src="<?php echo get_match_champion_path_for_id($teamBans[100][1]); ?>" />
						 <img class="img-circle" style="width: 20%; height: auto; margin-left: 5px;" src="<?php echo get_match_champion_path_for_id($teamBans[100][2]); ?>" />
					</td>
					<td class="pull-right" style="width: 15%; text-align: right; margin-right: 10px;">
						<?php echo ($teamWin[100] == true) ? 'Victory' : 'Defeat'; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<?php
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
		
		if (!isset($participant->stats->wardsPlaced)) {$participant->stats->wardsPlaced = 0;}
				
		if($i == 5): ?>
		<tr class="team-info">
			<td>
				<table>
					<tr>
						<td class="pull-left" style="width: 15%; margin-left: 5%;">
							<?php echo $teamKills[200] . "/" . $teamDeaths[200] . "/" . $teamAssists[200]; ?>
						</td>
						<td class="pull-left" style="width: 15%;">
							<?php echo "Gold <b><span class='purple-text'>" . round($teamGold[200] / 1000, 2) . "K</span></b>"; ?>
						</td>
						<td class="pull-left" style="width: 15%;">
							<?php echo "T <b><span class='purple-text'>" . $teamTowers[200] . "</span></b> D <b><span class='purple-text'>" . $teamDragons[200] . "</span></b> B <b><span class='purple-text'>" . $teamBarons[200] . "</span></b>"; ?>
						</td>
						<td class="pull-left" style="width: 15%;">
							Bans:
							 <img class="img-circle" style="width: 20%; height: auto; margin-left: 5px;" src="<?php echo get_match_champion_path_for_id($teamBans[200][0]); ?>" />
							 <img class="img-circle" style="width: 20%; height: auto; margin-left: 5px;" src="<?php echo get_match_champion_path_for_id($teamBans[200][1]); ?>" />
							 <img class="img-circle" style="width: 20%; height: auto; margin-left: 5px;" src="<?php echo get_match_champion_path_for_id($teamBans[200][2]); ?>" />
						</td>
						<td class="pull-right" style="width: 15%; text-align: right; margin-right: 10px;">
							<?php echo ($teamWin[200] == true) ? 'Victory' : 'Defeat'; ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<?php endif;
		?>
		<tr class="player-row <?php echo ($i < 5) ? 'blue' : 'purple'; ?>-player player<?php echo $i; ?><?php echo ($_GET['participantId'] == $participant->participantId) ? ' searched' : ''; ?>" onclick="loadHistory('<?php echo $game->participantIdentities[($participant->participantId - 1)]->player->summonerName; ?>', '<?php echo $region; ?>')">
			<td style="width: 100%" class="player-info">
				<table>
					<tr>
						<td class="pull-left" style="width:5%; margin-left: 2%;">
							<img class="img-circle" src="<?php echo get_match_champion_path_for_id($participant->championId); ?>" />
						</td>
						<td class="pull-left" style="width:10%; margin-left: 1%;">
							<span class="name"><?php echo ($game->queueType == "Ranked" ||
														   $game->queueType == "Teams" ||
														   $game->queueType == "Premade 3x3" ||
														   $game->queueType == "Premade" ||
														   $game->queueType == "Teams 3x3")
														   ? $game->participantIdentities[($participant->participantId - 1)]->player->summonerName
														   : $participant->championName; ?>
							</span>
						</td>
						<td class="pull-left" style="width:15%; margin-left: 2%;">
							<span class="kda"><?php echo $participant->stats->kills . " / " . $participant->stats->deaths . " / " . $participant->stats->assists; ?></span>
						</td>
						<td class="pull-left" style="width:30%; margin-left: 3%;">
							<img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item0); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item1); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item2); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item3); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item4); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item5); ?>" /><img class="img-item" src="<?php echo get_match_item_path_for_id($participant->item6); ?>" /> | <img class="img-spell" src="<?php echo get_match_spell_path_for_id($participant->spell1Id); ?>" /><img class="img-spell" src="<?php echo get_match_spell_path_for_id($participant->spell2Id); ?>" />
						</td>
						<td class="pull-left" style="width:5%; margin-left: 2%;">
							<span title="kill participation"><?php echo round(($participant->stats->kills + $participant->stats->assists) / ($teamKills[$participant->teamId] + $teamAssists[$participant->teamId]) * 100); ?>%</span>
						</td>
						<td class="pull-left" style="width:5%;">
							<span title="wards placed"><?php echo $participant->stats->wardsPlaced; ?></span>
						</td>
						<td class="pull-left" style="width:5%;">
							<span title="creeps"><?php echo $participant->stats->minionsKilled; ?></span>
						</td>
						<td class="pull-left" style="width:5%;">
							<span title="creeps per minute"><?php echo round($participant->stats->minionsKilled / ($game->matchDuration / 60), 2); ?></span>
						</td>
						<td class="pull-left" style="width:5%;">
							<span title="gold earned"><?php echo round($participant->stats->goldEarned / 1000, 2); ?>K</span>
						</td>
						<td class="pull-left" style="width:5%;">
							<span title="gold earned per minute"><?php echo round($participant->stats->goldEarned / ($game->matchDuration / 60)); ?></span>
						</td>
					</tr>
				</table>
			</td>
			<td style="clear:both; width: 0; height: 0;"></td>
		</tr>
		<?php $i ++; endforeach; ?>
</table>
<table class="progress-table">
	<tr>
		<td height="50px" colspan="12"><center>
			<div style="display: inline-block; line-height: 50px;"><div class="green" style="width: 25px; height: 25px; margin-top: 12.5px; float: left;"></div><div style="margin-left: 5px; float: left;">Damage taken</div></div>
			<div style="display: inline-block; line-height: 50px; margin-left: 20px;"><div class="red" style="width: 25px; height: 25px; margin-top: 12.5px; float: left;"></div><div style="margin-left: 5px; float: left;">Damage done</div></div>
			<div style="display: inline-block; line-height: 50px; margin-left: 20px;"><div class="yellow" style="width: 25px; height: 25px; margin-top: 12.5px; float: left;"></div><div style="margin-left: 5px; float: left;">Gold earned</div></div>
		</center></td>
	</tr>
	<tr>
		<td height="400px">
			
		</td>
		<?php foreach($game->participants as $participant): ?>
			<td height="400px" style="clear: both; vertical-align: bottom;">
				<div style="display: inline-block; vertical-align: bottom; height: <?php echo ($dmgTaken[$participant->participantId] / max($dmgTaken) * 100);?>% !important; width: 20%; margin-left: 9%;" class="green">&nbsp;</div>
				<div style="display: inline-block; vertical-align: bottom; height: <?php echo ($dmgDealt[$participant->participantId] / max($dmgDealt) * 100);?>% !important; width: 20%; margin-left: 9%;" class="red">&nbsp;</div>
				<div style="display: inline-block; vertical-align: bottom; height: <?php echo ($maxGold[$participant->participantId] / max($maxGold) * 50);?>% !important; width: 20%; margin-left: 9%;" class="yellow">&nbsp;</div>
			</td>
		<?php endforeach; ?>
		<td height="400px"></td>
	</tr>
	<tr>
		
	</tr>
</table>