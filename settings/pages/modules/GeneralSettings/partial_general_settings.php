<h1><?php _e($this->getTitle(),\MailGunApiForWp\MailGunApiForWp::PLUGIN_SLUG)?></h1>
<div class="wrap">
    <form method="POST" action="<?php echo MailGunApiForWp\Utils\WordpressUtil::getFormAction(); ?>">
        <?php 
            settings_fields($this->getOptionGroup());
            $savedOptions = $this->getSavedOptions();
            $inputs = $this->getInputs();
            $submitButtonText = $this->getSubmitButtonText();
            do_settings_sections(\MailGunApiForWp\Utils\WordpressDisplayUtil::displayFormTable($savedOptions, $inputs, $submitButtonText));
        ?>
    </form>
</div>