<?php
namespace MailGunApiForWp\Utils {
    final class WordpressDisplayUtil{
    
    public static function displayFormTable($savedOptions, $inputs, $optionName, $submitButtonText){ ?>
        <table class="form-table">
            <tbody> <?php
                foreach($inputs as $input){
                    $input->value = isset($savedOptions[$input->getName()]) ? $savedOptions[$input->getName()] : '';
                    self::displayField($input, $optionName);
                } ?>
            </tbody>
        </table>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e($submitButtonText, \MailGunApiForWp\MailGunApiForWp::PLUGIN_SLUG); ?>" />
    <?php }

    private static function displayField($input, $optionName){
        if ($input instanceof \MailGunApiForWp\Settings\Pages\Input\RadioButtonGroup){
            self::displayRadioButtonGroup($input, $optionName);
        } else if ($input instanceof \MailGunApiForWp\Settings\Pages\Input\Input){
            self::displayTextInputField($input, $optionName);
        }
    } 

    private static function displayInput($input, $optionName) {
        switch ($input->getType()) {
            case 'text': self::displayTextInputField($input, $optionName); break;            
            case 'textarea': self::displayTextareaInputField($input, $optionName); break;
            default: self::displayGenericInputField($input, $optionName);break;
        }
    }

    private static function displayRadioButtonGroup($radioButtonGroup, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><?php echo $radioButtonGroup->getLabel(); echo $radioButtonGroup->getIsRequired() ? '*' : '';?></th> 
            <td>
                <?php foreach($radioButtonGroup->getRadioButtons() as $radioButton){ ?>
                    <label for="<?php echo $radioButton->getId() ?>"><?php echo $radioButton->getLabel() ?></label>
                    <input type="radio" 
                        name="<?php echo $radioButton->getName();?>" 
                        id="<?php echo $radioButton->getId();?>" 
                        value="<?php echo $radioButton->value;?>" 
                        <?php echo $radioButton->getIsRequired() ? 'required' : ''?> 
                        <?php echo $radioButton->getIsChecked() ? 'checked' : ''?>/>
                <?php }
                ?>
            </td>
        </tr>
    <?php }

    private static function displayTextInputField($input, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><label for="<?php echo $input->getId() ?>"><?php echo $input->getLabel(); echo $input->getIsRequired() ? '*' : ''; ?></label></th> 
            <td>
                <input type="<?php echo $input->getType();?>"
                    class="regular-text"
                    name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                    id="<?php echo $input->getId();?>"
                    value="<?php echo $input->value?>"
                    placeholder="<?php echo $input->getPlaceHolder();?>"
                    <?php echo $input->getIsRequired() ? 'required' : ''?>/>
            </td>
        </tr>
    <?php }

    private static function displayTextareaInputField($input, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><label for="<?php echo $input->getId() ?>"><?php echo $input->getLabel(); echo $input->getIsRequired() ? '*' : ''; ?></label></th>  
            <td>
                <textarea name="<?php echo $optionName . '[' . $input->getName() . ']'?>"<?php echo $input->getIsRequired() ? 'required' : ''?>><?php echo $input->value?></textarea>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }

    private static function displayGenericInputField($input, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><label for="<?php echo $input->getId() ?>"><?php echo $input->getLabel(); echo $input->getIsRequired() ? '*' : ''; ?></label></th> 
            <td>
                <input type="<?php echo $input->getType()?>" name="<?php echo $optionName . '[' . $input->getName() . ']'?>" value="<?php echo $input->value?>" <?php echo $input->getIsRequired() ? 'required' : ''?>/>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }

    }
}
?>