<h1><?php
    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Utils\Wordpress\Page\WordpressDisplayUtil;
    use MailGunApiForWp\Utils\Wordpress\WordpressUtil;

    _e($this->getTitle(), MailGunApiForWp::PLUGIN_SLUG)?></h1>
<div class="wrap">
    <form method="POST" action="<?php echo WordpressUtil::getFormAction(); ?>">
        <?php
            settings_fields($this->getOptionGroup());
            $savedOptions = $this->getSavedOptions();
            $inputs = $this->getInputs();
            $submitButtonText = $this->getSubmitButtonText();
            $optionName = $this->getOptionName();
            WordpressDisplayUtil::displayFormTable($savedOptions, $inputs, $optionName, $submitButtonText);
        ?>
    </form>
</div>