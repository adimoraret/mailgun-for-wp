<?php
namespace MailGunApiForWp\Utils {
    final class WordpressDisplayUtil{
    
    public static function displayFormTable($savedOptions, $inputs, $submitButtonText){ ?>
        <table class="form-table">
            <tbody> <?php
                foreach($inputs as $input){
                    $input->value = isset($savedOptions[$input->getName()]) ? $savedOptions[$input->getName()] : '';
                    self::displayInputField($input);
                } ?>
            </tbody>
        </table>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e($submitButtonText, \MailGunApiForWp\MailGunApiForWp::PLUGIN_SLUG); ?>" />
    <?php }

    private static function displayInputField($input){
        switch ($input->getType()) {
            case 'textarea': self::displayTextareaInputField($input); break;
            default: self::displayTextInputField($input);break;
        }
    }

    private static function displayTextInputField($input){
    ?>
        <tr valign="top">
            <th scope="row"><?php echo $input->getName(); echo $input->getIsRequired() ? '*' : ''?></th> 
            <td>
                <input type="<?php echo $input->getType()?>" value="<?php echo $input->value?>"/>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }

    private static function displayTextareaInputField($input){
    ?>
        <tr valign="top">
            <th scope="row"><?php echo $input->getName(); echo $input->getIsRequired() ? '*' : ''?></th> 
            <td>
                <textarea><?php echo $input->value?></textarea>
                <p class="description"><?php echo $input->getDescription() ?></p>
            </td>
        </tr>
    <?php }
    }
}
?>