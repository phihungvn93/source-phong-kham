<?php 
require_once "../lib/class_ratings.php";
if(isset($qly_rt)==false) $qly_rt = new rating;
$idTT = $_GET['id'];
$value_vote = $_GET['j'];
$ip_user_current = $_GET['t'];
$content_vote = $qly_rt->VotebyId($idTT);
$row_vote = mysql_fetch_assoc($content_vote);
$list_ip_vote = json_decode($row_vote['used_ips']);
$array_ip = $list_ip_vote;
if($array_ip ==  null)
{
	$array_ip = array();
}
array_push($array_ip, $ip_user_current);
$json_ip =  json_encode($array_ip);
$total_votes = $row_vote['total_votes'] + 1;
$total_value = $row_vote['total_value'] + $value_vote;
// $user_vote = $qly_rt->addIP($idTT,$json_ip);
$check_vote = $qly_rt->checkVote($idTT,$ip_user_current);
if(!$check_vote)
{
    $vote = $qly_rt->addVote($idTT,$json_ip,$total_votes,$total_value);
}
else
{
	$vote = $qly_rt->updateVote($idTT,$json_ip,$total_votes,$total_value);
}

if($vote){ 
	$content_vote = $qly_rt->VotebyId($idTT);
    $row_vote = mysql_fetch_assoc($content_vote);
    $percent_avg = ( $row_vote['total_value'] / $row_vote['total_votes'] ) ;
    $percent = round($percent_avg* 30,2);
?>

    <div id="unit_long174">
        <ul id="unit_ul174" class="unit-rating" style="width: 300px;">
            <li class="current-rating" style="width: <?php echo $percent; ?>px;">Currently <?php echo $percent_avg; ?>/10</li>
                    </ul>
        <div itemscope="" itemtype="http://schema.org/Article">
			<div itemprop="name" class="title-vote"><span></span></div>
            <div class="voted" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                Điểm trung bình: 
                <span itemprop="ratingValue" style="font-weight:800;"><?php echo round($percent_avg,1);?></span> /
                <span itemprop="bestRating">10</span> (
                <span itemprop="ratingCount"><?php echo $row_vote['total_votes']; ?></span>  lượt đánh giá)           </div>
       </div>
    </div>

<?php } ?>