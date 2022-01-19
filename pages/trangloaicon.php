<?php include 'modules/sl_content/index.php'; ?>
<div class="titleArea news">
  <div class="titleAreaInner">
    <div class="pageTitle news"><?php include_once('blocks/br_3cap_trangloai.php'); ?></div>
  </div>
</div>
<div class="columnWrapper">
  <div class="contArea">
    <div class="contAreaInner">
      <ul class="releaseList">
        <?php while($row_tt = mysql_fetch_assoc($tt)){ ?>
        <li>
            <a href="<?php echo $row_tt['TieuDeKD']; ?>.html">
              <p class="img_cat">
                  <span><img class="athiis" src="<?=$row_tt['UrlHinh']; ?>" alt="<?php echo $row_tb['TieuDe'];?>"></span>
              </p>
              <p class="headline">
                <?=$qly_tin->cutString(strip_tags($row_tt['TieuDe']), 100, '...');?>
              </p>
              <p class="loai_des">
                <?=$qly_tin->cutString(strip_tags($row_tt['TomTat']), 200, '...');?>
              </p>
            </a>
        </li>
        <?php } ?>
        <?php if(mysql_num_rows ($tt) < 1)
        {
            echo '<h2>Danh mục này chưa có bài viết</h2>';
        }
        ?>
        <div class="phantrang">
            <?php if($totalRows > $pageSize) { ?>
            <?php $urlchinh = $TenLoaiConKD;?>
            <?php echo $qly_tin->pagesList1($urlchinh, $totalRows, $pageNum, $pageSize, 2); ?>
            <?php } ?>      
        </div>
      </ul>
      </div>
  </div>
  <section class="contArea subColumn">
    <?php include 'modules/right/index.php';?>
  </section>
</div>

