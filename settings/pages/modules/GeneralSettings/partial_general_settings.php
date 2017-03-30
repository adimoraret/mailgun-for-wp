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
                <?php WordpressDisplayUtil::displayForm($form); ?>
            </div>
        </aside>
        <?php } ?>
    </section>
</div>