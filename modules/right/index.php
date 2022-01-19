<nav class="localNav">
  <div class="subColumnTitle"><a href=""><span>Danh mục bệnh</span></a></div>
  <ul>
    <li>
        <a href="benh-xa-hoi/">Bệnh xã hội</a>
        <ul>
          <?php
                $cap2_bt = $qly_loai->ListLoai(1, 1, 72,-1);
                while($row_bt = mysql_fetch_assoc($cap2_bt)){
          ?>
          <li><a href="<?php echo $row_bt['TieuDeKD'].'/'; ?>" title="<?php echo $row_bt['TieuDe']; ?>"><?php echo $row_bt['TieuDe']; ?></a></li>
          <?php } ?>
        </ul>
    </li>
  </ul>
</nav>