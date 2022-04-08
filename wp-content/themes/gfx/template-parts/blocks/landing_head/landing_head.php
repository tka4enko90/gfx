<?php wp_enqueue_style('landing_head_css', get_template_directory_uri() . '/static/css/template-parts/blocks/landing_head/landing_head.css', '', '', 'all'); ?>
<section class="landing-head-section">
    <div class="container">
        <?php if(!empty($args['section_subtitle'])){ ?><p class="page-subtitle"><?php echo $args['section_subtitle']; ?></p><?php }?>
        <h1 class="page-title"><?php
            if( ! empty( $args['section_title'] ) ){
                echo $args['section_title'];
            } else {
                the_title();
            }
            ?></h1>
        <div class="buttons-wrap">
            <?php if( ! empty($args['button_text'] ) && ! empty($args['button_url'] ) ){ ?>
                <a href="<?php echo $args['button_url']; ?>" class="primary-button"><?php echo $args['button_text']; ?></a>
            <?php }?>
            <?php if(!empty($args['discord_url'])){ ?>
                <a href="<?php echo $args['discord_url']; ?>" class="primary-button discord-button">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="19" viewBox="0 0 25 19" style="&#10;">
                        <image id="Discord_Icon" data-name="Discord Icon" width="25" height="19" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAATCAYAAABlcqYFAAAB7klEQVQ4ja2VzYvOURTHP8ajZrwMmxkWRk9YoMZo2JG8baSQRPaWFlYWaijNipTl/AVsWdhISRqbmYcskJchJnnbMEWaeD66dR89c7q/mYXnW2dxz7n3fLvne+65i1QKWAcMA3uA3cAV4AbQA9SAdOgHUAfGgBngLjAOPAOa7SkjSS9wATgKbGjzvwMmgFXAkpzkG9AH7Grb9x24B4wCjX/eRNJmo3YGT9TeVt52giF1pkMkCZdKJNc7SJDwXl2fcnflqm0HDpY64D8wAJxKurdIDmVRO40TQH8i6c/dVMIv4AXwcx7yKeBTRWwrsDNpsU+dLdR0Wj2m9qkH1Dch/lsdUdeqg+rNCm3GEsn5QqCpngvtfTrsuRPiA+rHQq6HqVybC9f8AzwNvsdh3QjraeBLIVd3V+6CiMXAluAbDusdYV3P+kY00zUbFbX8oB7OmuxX3xZK2tJkk3q7Is9kml2T+Z2UkLrqJbARWF6x5zmwLA/VEhq1XJoqLAW2zROnQtM56MpvIeJrnqQTCyXI+Jy/g/FCrCfd5AxwMb/61gRYkW0k+9KfMgSszrebzaP+VU78GhgEjgeCVOrLrR5P2pxUHwTRroa3kPZ1q7Xg3xvOTeUpvCZO4WQr1SPqLfW+Wg/xKkuk19RH6tk555S/p+0PN6/eA9IAAAAASUVORK5CYII="/>
                    </svg>
                    <?php echo __( 'Join Discord', 'gfx' );?>
                </a><?php }?>
        </div>
    </div>
</section>
<?php
