<?php
namespace MailGunApiForWp\Utils\Wordpress\Page {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\Input;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;

    final class WordpressDisplayUtil {
    
        public static function displayFormTable($savedOptions, $inputs, $optionName, $buttons) { ?>
            <table class="form-table">
                <tbody> <?php
                    foreach($inputs as $input){
                        $dbValue = isset($savedOptions[$input->getName()]) ? $savedOptions[$input->getName()] : '';
                        self::displayField($input, $optionName, $dbValue);
                    } ?>
                </tbody>
            </table>
            <?php self::displayButtons($buttons); ?>
        <?php }

        private static function displayButtons($buttons){
            foreach ($buttons as $button) {
                self::displayButton($button);
            }
        }

        private static function displayButton($button){ ?>
            <input type="<?php echo $button->getType();?>"
                   name="<?php echo $button->getName();?>"
                   id="<?php echo $button->getId();?>"
                   class="<?php echo $button->getClassName();?>"
                   value="<?php _e($button->getValue(), MailGunApiForWp::PLUGIN_SLUG);?>"
                    <?php echo self::generateOnClickHtmlAttribute($button); ?>/>
            <?php
        }

        private static function generateOnClickHtmlAttribute($button){
            $onClickValue = $button->getOnClick();
            if ($onClickValue == null){
                return '';
            }
            return 'onclick="' . $button->getOnClick() . '"';
        }

        private static function displayField($input, $optionName, $dbValue) {
            if ($input instanceof RadioButtonGroup){
                self::displayRadioButtonGroup($input, $optionName, $dbValue);
            } else if ($input instanceof Input){
                self::displayInputField($input, $optionName, $dbValue);
            }
        }

        private static function displayInputField($input, $optionName, $dbValue) {
            switch ($input->getType()) {
                case 'text': self::displayTextInputField($input, $optionName, $dbValue); break;
                case 'checkbox': self::displayCheckboxField($input, $optionName, $dbValue); break;
                default: self::displayTextInputField($input, $optionName, $dbValue);break;
            }
        }

        private static function displayTextInputField($input, $optionName, $dbValue) {
        ?>
            <tr valign="top">
                <?php self::displayLabelHeader($input->getId(), $input->getLabel(), $input->getIsRequired()); ?>
                <td>
                    <input type="<?php echo $input->getType();?>"
                        class="regular-text"
                        name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                        id="<?php echo $input->getId();?>"
                        value="<?php echo $dbValue;?>"
                        placeholder="<?php echo $input->getPlaceHolder();?>"
                        <?php echo $input->getIsRequired() ? 'required' : '';?>/>
                </td>
            </tr>
        <?php }

        private static function displayCheckboxField($input, $optionName, $dbValue) {
        ?>
            <tr valign="top">
                <?php self::displayLabelHeader($input->getId(), $input->getLabel(), $input->getIsRequired()); ?>
                <td>
                    <input type="checkbox"
                       class="regular-text"
                       name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                       id="<?php echo $input->getId();?>"
                       value="<?php echo $input->getValue();?>"
                       <?php echo $dbValue == $input->getValue() ? 'checked' : ''?>
                    />
                </td>
            </tr>
        <?php
        }

        private static function displayRadioButtonGroup($radioButtonGroup, $optionName, $dbValue) {
            ?>
            <tr valign="top">
                <th scope="row"><label><?php echo $radioButtonGroup->getLabel(); echo $radioButtonGroup->getIsRequired() ? '*' : '';?></label></th>
                <td>
                    <?php foreach($radioButtonGroup->getRadioButtons() as $radioButton){ ?>
                        <label for="<?php echo $radioButton->getId() ?>"><?php echo $radioButton->getLabel() ?></label>
                        <input type="radio"
                               name="<?php echo $optionName . '[' . $radioButton->getName() . ']';?>"
                               id="<?php echo $radioButton->getId();?>"
                               value="<?php echo $radioButton->getValue();?>"
                            <?php echo $radioButton->getIsRequired() ? 'required' : ''?>
                            <?php echo $dbValue == $radioButton->getValue() ? 'checked' : $radioButton->getIsChecked() ? 'checked' : ''?>/>
                    <?php }
                    ?>
                </td>
            </tr>
        <?php }

        private static function displayLabelHeader($inputId, $text, $isRequired) { ?>
            <th scope="row"><label for="<?php echo $inputId; ?>"><?php echo $text; echo $isRequired ? '*' : ''; ?></label></th>
        <?php }

    }
}
?>