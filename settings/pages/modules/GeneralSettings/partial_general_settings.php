<h1>Abc d e f g</h1>
<!-- First: register_setting($settingsGroup, $adminModuleInstance->getSettingKey(), array( $adminModuleInstance, 'validateModuleSettingsFields' ) ); -->
<div class="wrap">
    <?php screen_icon(); ?>
    <form method="POST" action="<?php echo MailGunApiForWp\Utils\WordpressUtil::getFormAction(); ?>">
        <?php 
            settings_fields('mailgun_4_wp_settings');
            $savedOptions = $this->getSavedOptions();
            $inputs = $this->getInputs();
            $submitButtonText = $this->getSubmitButtonText();
            do_settings_sections(displayFormTable($savedOptions, $inputs, $submitButtonText));
        ?>
    </form>
</div>

<?php
function displayFormTable($savedOptions, $inputs, $submitButtonText){ ?>
    <table class="form-table">
        <tbody> <?php
            foreach($inputs as $input){
                $input->value = isset($savedOptions[$input->getName()]) ? $savedOptions[$input->getName()] : '';
                displayInputField($input);
            } ?>
        </tbody>
    </table>
    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e($submitButtonText, \MailGunApiForWp\MailGunApiForWp::PLUGIN_SLUG); ?>" />
<?php }

function displayInputField($input){ ?>
    <tr valign="top">
        <th scope="row"><?php echo $input->getName(); echo $input->getIsRequired() ? '*' : ''?></th> 
        <td>
            <input type="<?php echo $input->getType()?>" value="<?php echo $input->value?>"/>
            <p class="description"><?php echo $input->getDescription() ?></p>
        </td>
    </tr>
<?php }
