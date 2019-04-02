<?php if($this->uri->segment(1) == 'post'){ ?>

<div style="height: 10px"></div>

<?php } ?>

<?php if($this->uri->segment(1) == 'calendar'){ ?>

    <div style="height: 10px"></div>

<?php } ?>

<section id="mk-footer" class="">
    <div class="footer-wrapper mk-grid">
        <div class="mk-padding-wrapper">
            <div class="col-md-4 col-sm-12">
                <section id="text-5" class="widget widget_text">
                    <div class="textwidget">
                        <p>© 2019 IGplan</p>
                    </div>
                </section>
            </div>
            <div class="col-md-4 col-sm-12">
                <section id="nav_menu-5" class="widget widget_nav_menu">
                    <div class="menu-log-container" style="text-align: center;">
                        <ul id="menu-log" class="menu">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="https://www.igplan.com/" target="_blank">Home</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="https://www.igplan.com/about/" target="_blank">about</a></li>
                            <?php if(session('uid')){ ?>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="<?=url("payments")?>">prices</a></li>
                            <?php }else{ ?>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="https://www.igplan.com/prices/" target="_blank">prices</a></li>
                            <?php } ?>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="https://www.igplan.com/blog/" target="_blank">blog</a></li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="https://www.igplan.com/support/" target="_blank">support</a></li>
                        </ul>
                    </div>
                </section>
            </div>
            <div class="col-md-4 col-sm-12">
                <section id="text-4" class="widget widget_text">
                    <div class="textwidget">
                        <p class="termcenter">
                            <a href="https://www.igplan.com/terms/" target="_blank" rel="noopener" style="margin-right: 10px;">Terms</a>
                            <a href="https://www.igplan.com/privacy/" target="_blank" rel="noopener">Privacy</a></p>
                        <p class="termtext"><a href="mailto:support@igplan.com" style="color: #000;">support@igplan.com</a></p>
                    </div>
                </section>
            </div>

        </div>
    </div>
</section>