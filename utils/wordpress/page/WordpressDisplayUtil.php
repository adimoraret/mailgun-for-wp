<?php
namespace MailGunApiForWp\Utils\Wordpress\Page {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\CheckboxGroup;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\Input;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;
    use MailGunApiForWp\Utils\Wordpress\WordpressUtil;

    final class WordpressDisplayUtil {

        public static function displayForm($form) { ?>
            <form method="POST" autocomplete="off" action="<?php echo WordpressUtil::getFormAction(); ?>" id="<?php echo $form->getSlug();?>">
                <?php
                settings_fields($form->getSlug());
                $savedOptions = $form->getSavedOptions();
                $inputs = $form->getInputs();
                $buttons = $form->getButtons();
                $optionName = $form->getSlug();
                self::displayFormContent($savedOptions, $inputs, $optionName, $buttons);
                self::displaySpan("status");
                $spinnerId = $form->getSlug() . '_spinner';
                self::displaySpinner($spinnerId);
                ?>
            </form>
        <?php }

        private static function displayFormContent($savedOptions, $inputs, $optionName, $buttons) {
            foreach($inputs as $input){
                $dbValue = isset($savedOptions[$input->getName()]) ? $savedOptions[$input->getName()] : '';
                self::displayField($input, $optionName, $dbValue);
            }
            self::displayButtons($buttons);
        }

        private static function displayButtons($buttons){ ?>
            <div class="form-actions">
            <?php foreach ($buttons as $button) {
                self::displayButton($button);
            } ?>
            </div>
        <?php }

        private static function displayButton($button){ ?>
            <input type="<?php echo $button->getType();?>"
                   name="<?php echo $button->getName();?>"
                   id="<?php echo $button->getId();?>"
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

        private static function displayField($input, $optionName, $dbValue) { ?>
            <div class="row">
            <?php if ($input instanceof RadioButtonGroup){
                    self::displayRadioButtonGroup($input, $optionName, $dbValue);
                } else if ($input instanceof CheckboxGroup) {
                    self::displayCheckboxGroup($input, $optionName, $dbValue);
                } else if ($input instanceof Input){
                    self::displayInputField($input, $optionName, $dbValue);
                }?>
            </div>
        <?php }

        private static function displayInputField($input, $optionName, $dbValue) {
            switch ($input->getType()) {
                case 'text': self::displayTextInputField($input, $optionName, $dbValue); break;
                case 'textarea': self::displayTextArea($input, $optionName, $dbValue); break;
                default: self::displayTextInputField($input, $optionName, $dbValue);break;
            }
        }

        private static function displayTextInputField($input, $optionName, $dbValue) {
            self::displayLabelHeader($input->getId(), $input->getLabel()); ?>
                <input type="<?php echo $input->getType();?>"
                    class="text"
                    autocomplete="off"
                    name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                    id="<?php echo $input->getId();?>"
                    value="<?php echo $dbValue;?>"
                    placeholder="<?php echo $input->getPlaceHolder();?>"/>
        <?php }


        private static function displayRadioButtonGroup($radioButtonGroup, $optionName, $dbValue) {
            ?>
                <label><?php echo $radioButtonGroup->getLabel();?></label>
                <div class="radio-buttons-group">
                    <?php foreach($radioButtonGroup->getRadioButtons() as $radioButton){ ?>
                        <label for="<?php echo $radioButton->getId() ?>"><?php echo $radioButton->getLabel() ?></label>
                        <input type="radio"
                               name="<?php echo $optionName . '[' . $radioButton->getName() . ']';?>"
                               id="<?php echo $radioButton->getId();?>"
                               value="<?php echo $radioButton->getValue();?>"
                            <?php echo $dbValue === $radioButton->getValue() ? 'checked' : $radioButton->getIsChecked() ? 'checked' : ''?>/>
                    <?php }
                    ?>
                </div>
        <?php }

        private static function displayCheckboxGroup($checkboxGroup, $optionName, $dbValue) {
            ?>
            <label><?php echo $checkboxGroup->getLabel();?></label>
            <div class="radio-buttons-group">
                <?php foreach($checkboxGroup->getCheckboxes() as $checkbox){ ?>
                    <label for="<?php echo $checkbox->getId() ?>"><?php echo $checkbox->getLabel() ?></label>
                    <input type="checkbox"
                           name="<?php echo $optionName . '[' . $checkbox->getName() . ']';?>"
                           id="<?php echo $checkbox->getId();?>"
                           value="<?php echo $checkbox->getValue();?>"
                        <?php echo $dbValue === $checkbox->getValue() ? 'checked' : $checkbox->getIsChecked() ? 'checked' : ''?>/>
                <?php }
                ?>
            </div>
        <?php }

        private static function displayTextArea($input, $optionName, $dbValue){
            self::displayLabelHeader($input->getId(), $input->getLabel());
            wp_editor($dbValue, $input->getId(), array('textarea_rows' => 30, 'media_buttons' => false));
            ?>
            <!--<textarea
                class="text"
                name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                id="<?php echo $input->getId();?>"
                placeholder="<?php echo $input->getPlaceHolder();?>"
                ><?php echo $dbValue;?></textarea>-->
        <?php }

        private static function displayLabelHeader($inputId, $text) { ?>
            <label for="<?php echo $inputId; ?>"><?php echo $text;?></label>
        <?php }

        public static function displaySpan($labelId) {?>
            <div id="<?php echo $labelId; ?>"></div>
        <?php }

        public static function displaySpinner($spinnerId) { ?>
            <div id="<?php echo $spinnerId; ?>" class="hidden">
                <div class="spinner-container">
                    <section>
                        <div class="sk-rotating-plane"></div>
                    </section>
                </div>
            </div>
        <?php }
    }
}