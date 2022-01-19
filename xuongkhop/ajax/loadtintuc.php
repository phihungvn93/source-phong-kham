<?php 
require_once "../lib/class_tintuc.php";
if(isset($qly_tin) == false) $qly_tin = new qly_tin;
$idLoai = $_POST['idLoai'];
ob_start();
?>
    <div class="sj-basic-news">
        <?php 
            $tinlq_2 = $qly_tin->ListTin_Where($idLoai,-1, 0, 5, '', '');
            if(mysql_num_rows($tinlq_2)>0) {
            ?>
            <ul class="bs-items">
                <?php $count_news_index = 1;?>
                    <?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>

                        <li class="bs-item cf <?php if($count_news_index == 1) echo 'first';?>">
                            <div class="bs-image">
                                <a href="/<?=$rowlq['TieuDeKD'];?>.html" title="<?=$rowlq['TieuDe'];?>">
                            <img src="<?=$rowlq['UrlHinh'];?>" alt="<?=$rowlq['TieuDeKD'];?>"> </a>
                            </div>
                            <div class="bs-content">
                                <div class="bs-title">
                                    <a href="<?=$rowlq['TieuDeKD'];?>.html" title="<?=$rowlq['TieuDe'];?>">
                                        <?=$rowlq['TieuDe'];?>
                                    </a>
                                </div>
                                <div class="bs-description">
                                    <?= $qly_tin->cutString(strip_tags($rowlq['TomTat']),80,' ...');?>
                                </div>
                            </div>
                        </li>
                        <?php $count_news_index++; ?>
                            <?php } ?>
            </ul>
            <?php } ?>
    </div>

<?php
$result = ob_get_contents();
ob_clean();
echo $result;
?>