<h1><?php _e($this->getTitle(),\MailGunApiForWp\MailGunApiForWp::PLUGIN_SLUG)?></h1>
<div class="wrap">
    <form method="POST" action="<?php echo MailGunApiForWp\Utils\WordpressUtil::getFormAction(); ?>">
        <?php
            settings_fields($this->getOptionGroup());
            $savedOptions = $this->getSavedOptions();
            $inputs = $this->getInputs();
            $submitButtonText = $this->getSubmitButtonText();
            $optionName = $this->getOptionName();
            \MailGunApiForWp\Utils\WordpressDisplayUtil::displayFormTable($savedOptions, $inputs, $optionName, $submitButtonText);
        ?>
    </form>
</div>