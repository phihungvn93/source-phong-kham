<?php 
    require_once "lib/class_ratings.php";
    if(isset($qly_rt)==false) $qly_rt = new rating;
    $ip_user_current = $qly_ql->getClientIP();
    $content_vote = $qly_rt->VotebyId($idTT);
    $row_vote = mysql_fetch_assoc($content_vote);
    $_SESSION["idTin_DaXem"] = $idTT;
    $percent_avg = ( $row_vote['total_value'] / $row_vote['total_votes'] ) ;
    $percent = round($percent_avg* 30,2);
    $total_votes = $row_vote['total_votes'];
    $check_vote = $qly_rt->checkVote($idTT,$ip_user_current);
    if(!$check_vote)
    {
        $percent_avg = 0;
        $percent = 0;
        $total_votes  = 0;
    }
    $check_ip = $qly_rt->checkIP($idTT,$ip_user_current);
?>
<?php include 'modules/sl_content/index.php'; ?>
<section class="titleArea rd">
    <div class="titleAreaInner">
      <div id="bc">
        <?php @include "blocks/br_3cap_trangchitiet.php"; ?>
      </div>
      <h2 class="pageTitle rd"><?php echo $row['TieuDe'];?></h2>
    </div>
</section>
<div class="columnWrapper">
  <div class="contArea">
    <div class="contAreaInner">
      <section class="noidungch">
            <?php 
                $TieuDeKD = $_GET['TieuDeKD'];
                $TieuDeKD = $ql_pa->XoaDinhDang($TieuDeKD);
                $idPa = $ql_pa->LayID($TieuDeKD);
                $idTT = $qly_tin->LayID($TieuDeKD);
                $keywords = $qly_tin->LayKeyword($idTT);
                
                $array_kw = explode(',',$keywords);
                $total_kw = count($array_kw);
                $kw_sql = '';
                foreach ($array_kw as $kw) {
                    $total_kw--;
                    $kw = ltrim($kw);
                    if($kw != false && $kw != '')
                    {
                        if($total_kw > 0)
                        {
                            $kw_sql .= "Keyword LIKE '%".$kw."%' or ";
                        }
                        else
                        {
                            $kw_sql .=  "Keyword LIKE '%".$kw."%'";
                        }
                    }
                    
                }
                
                $time_post = sw_get_current_weekday($row['NgayDang']);
                $date_meta = date('d-m-Y', $row['NgayDang']);
            ?>
            <?php include_once('modules/rating/index.php');?>
            <?php echo $row['NoiDung']?>
      </section>
      <section>
      <div class="baivietlienquan">
                  <div class="mainColumnTitle">Tin liên quan</div>
                  <ul class="tin_lienquan">
                    <?php
                        $tinlq = $qly_tin->ListTin_Where($row['idLoai'], $row['idCL'], 0, 3, " and idTT <> {$idTT}", " order by idTT DESC");
                        if(mysql_num_rows($tinlq) > 0) {
                    ?>  
                        <?php while($rowlq = mysql_fetch_assoc($tinlq)){ ?>
                            <li>
                                <a href="<?php echo $rowlq["TieuDeKD"]; ?>.html" title="<?php echo $rowlq["TieuDe"]; ?>">
                                    <img class="img_lq" src="<?php echo str_replace('hinhanh','resize/182x127',$rowlq['UrlHinh'])?>" alt="<?php echo $rowlq["TieuDe"]; ?>" />
                                    <?php echo $rowlq['TieuDe']; ?>
                                </a>
                                <span><?php echo date("d-m-Y",strtotime($rowlq['NgayDang'])); ?></span>
                                <div class="clear"></div>
                            </li>
                        <?php } ?>      
                    <?php } ?>
                  </ul> 
              </div>          
    </section>
    </div>
  </div>
  <section class="contArea subColumn">
    <?php include 'modules/right/index.php';?>
  </section>
</div>




