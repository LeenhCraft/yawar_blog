<div class="footer-nav">
    <?php
    foreach ($data['componentes']['linksfooter']['content'] as $group) {
    ?>
        <div class="footer-nav-column">
            <small class="text-capitalize"><?php echo $group['gr_name'] ?></small>
            <ul>
                <?php
                foreach ($group['gr_links'] as $link) {
                    $target = "";
                    if ($link['li_target'] == 1) {
                        $target = 'target="_blank"';
                    }
                ?>
                    <li>
                        <a class="text-capitalize" href="<?php echo $link['li_url'] ?>" <?php echo $target; ?>>
                            <?php
                            echo $link['li_icon'];
                            echo $link['li_name'];
                            ?>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    <?php } ?>
</div>