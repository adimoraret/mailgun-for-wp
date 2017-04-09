<h1><?php
    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Utils\Wordpress\Page\WordpressDisplayUtil;

    _e($this->getTitle(), MailGunApiForWp::PLUGIN_SLUG)?></h1>
<div id="ctrContent">
    <section>
    <?php $forms = $this->getForms();
        foreach ($this->getForms() as $form) { ?>
        <aside>
            <div class="widget">
                <header>
                    <span class="<?php echo $form->getIconClass();?>"></span>
                    <span><h2><?php echo $form->getName();?></h2></span>
                </header>
                <div class="widget-body">
                    <?php WordpressDisplayUtil::displayForm($form); ?>
                </div>
            </div>
        </aside>
        <?php } ?>
    </section>
</div>