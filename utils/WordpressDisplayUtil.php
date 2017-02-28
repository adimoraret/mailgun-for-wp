<?php
namespace MailGunApiForWp\Utils {
    final class WordpressDisplayUtil{
    
    public static function displayFormTable($savedOptions, $inputs, $optionName, $submitButtonText){ ?>
        <table class="form-table">
            <tbody> <?php
                foreach($inputs as $input){
                    $input->value = isset($savedOptions[$input->getName()]) ? $savedOptions[$input->getName()] : '';
                    self::displayInputField($input, $optionName);
                } ?>
            </tbody>
        </table>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e($submitButtonText, \MailGunApiForWp\MailGunApiForWp::PLUGIN_SLUG); ?>" />
    <?php }

    private static function displayInputField($input, $optionName){ 
        switch ($input->getType()) {
            case 'text': self::displayTextInputField($input, $optionName); break;            
            case 'textarea': self::displayTextareaInputField($input, $optionName); break;
            default: self::displayGenericInputField($input, $optionName);break;
        }
    }

    private static function displayTextInputField($input, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><?php echo $input->getName(); echo $input->getIsRequired() ? '*' : ''?></th> 
            <td>
                <input type="text" name="<?php echo $optionName . '[' . $input->getName() . ']'?>" value="<?php echo $input->value?>" <?php echo $input->getIsRequired() ? 'required' : ''?>/>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }

    private static function displayTextareaInputField($input, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><?php echo $input->getName(); echo $input->getIsRequired() ? '*' : ''?></th> 
            <td>
                <textarea name="<?php echo $optionName . '[' . $input->getName() . ']'?>"<?php echo $input->getIsRequired() ? 'required' : ''?>><?php echo $input->value?></textarea>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }

    private static function displayGenericInputField($input, $optionName){
    ?>
        <tr valign="top">
            <th scope="row"><?php echo $input->getName(); echo $input->getIsRequired() ? '*' : ''?></th> 
            <td>
                <input type="<?php echo $input->getType()?>" name="<?php echo $optionName . '[' . $input->getName() . ']'?>" value="<?php echo $input->value?>" <?php echo $input->getIsRequired() ? 'required' : ''?>/>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }

    }
}
?>