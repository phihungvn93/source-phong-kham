<style type="text/css">
    .blog-cate-vote{clear:both}.ratingblock{display:inline-block;padding-bottom:8px;margin-bottom:8px}.unit-rating{list-style:none;margin:0;padding:0;height:30px;position:relative;background:url(modules/rating/img/starrating.gif) top left repeat-x}.unit-rating li{text-indent:-90000px;padding:0;margin:0;float:left}.unit-rating li.current-rating{background:url(modules/rating/img/starrating.gif) left bottom;position:absolute;height:30px;display:block;text-indent:-9000px;z-index:1}.unit-rating li a{outline:none;display:inline-block;width:30px;height:30px;text-decoration:none;text-indent:-9000px;z-index:20;position:absolute;padding:0}.unit-rating li a:hover{background:url(modules/rating/img/starrating.gif) left center;z-index:2;left:0;background:url(modules/rating/img/starrating.gif) left center;z-index:2;left:0}.unit-rating a.r1-unit{left:0}.unit-rating a.r1-unit:hover{width:30px}.unit-rating a.r2-unit{left:30px}.unit-rating a.r2-unit:hover{width:60px}.unit-rating a.r3-unit{left:60px}.unit-rating a.r3-unit:hover{width:90px}.unit-rating a.r4-unit{left:90px}.unit-rating a.r4-unit:hover{width:120px}.unit-rating a.r5-unit{left:120px}.unit-rating a.r5-unit:hover{width:150px}.unit-rating a.r6-unit{left:150px}.unit-rating a.r6-unit:hover{width:180px}.unit-rating a.r7-unit{left:180px}.unit-rating a.r7-unit:hover{width:210px}.unit-rating a.r8-unit{left:210px}.unit-rating a.r8-unit:hover{width:240px}.unit-rating a.r9-unit{left:240px}.unit-rating a.r9-unit:hover{width:270px}.unit-rating a.r10-unit{left:270px}.unit-rating a.r10-unit:hover{width:300px}.line-head-post{width:100%;float:left}
</style>
<?php if($idTT > 0){ ?>
                <div class="blog-cate-vote">
                <?php  if($check_ip < 1 ) { ?>
                <div class="ratingblock">
                    <div id="unit_long18">
                        <ul id="unit_ul18" class="unit-rating" style="width: 300px;">
                            <li class="current-rating" style="width: <?php echo $percent; ?>px;">Currently <?php echo round($percent_avg,1); ?>/10</li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=1&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="1 out of 10" class="r1-unit rater seoquake-nofollow" rel="nofollow">1</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=2&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="2 out of 10" class="r2-unit rater seoquake-nofollow" rel="nofollow">2</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=3&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="3 out of 10" class="r3-unit rater seoquake-nofollow" rel="nofollow">3</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=4&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="4 out of 10" class="r4-unit rater seoquake-nofollow" rel="nofollow">4</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=5&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="5 out of 10" class="r5-unit rater seoquake-nofollow" rel="nofollow">5</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=6&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="6 out of 10" class="r6-unit rater seoquake-nofollow" rel="nofollow">6</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=7&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="7 out of 10" class="r7-unit rater seoquake-nofollow" rel="nofollow">7</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=8&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="8 out of 10" class="r8-unit rater seoquake-nofollow" rel="nofollow">8</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=9&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="9 out of 10" class="r9-unit rater seoquake-nofollow" rel="nofollow">9</a></li>
                            <li><a vote-item="/danhgia.php?id=<?php echo $idTT; ?>&j=10&amp;q=18&amp;t=<?php echo $ip_user_current; ?>&amp;c=10&amp;r=1" title="10 out of 10" class="r10-unit rater seoquake-nofollow" rel="nofollow">10</a></li>
                        </ul>
                        <div>
                            <div itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                                Điểm trung bình:
                                <span itemprop="ratingValue" style="font-weight:800;"><?php echo round($percent_avg,1); ?></span> /
                                <span itemprop="bestRating">10</span> (
                                <span itemprop="ratingCount"><?php echo $total_votes; ?></span> lượt đánh giá) </div>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="ratingblock">
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
                </div>
                <?php } ?>
                <span style="margin-left:15px" class="news-view"><?php echo $row['LuotXem']; ?> View</span>
                <span class="time-baiviet"><?php echo $time_post; ?></span>

            </div>
            <div class="clear20"></div>
                <?php } ?>
<script type="text/javascript">
    $( document ).ready(function() {

        $('.unit-rating li a').click(function(){
            var url = $(this).attr('vote-item');
            $.ajax({
                url: './pages'+url,
                type : "get",
                dateType:"text",
                success: function(result){
                    if(result)
                    {
                        $('.ratingblock').html(result);
                    }
                }
            });
        });
     });
    
    
</script>
<script type="text/javascript">
    $(function(){

         $("img.icon").lazyload();

        });
</script>                