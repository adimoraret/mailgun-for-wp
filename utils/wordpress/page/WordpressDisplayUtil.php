<?php
namespace MailGunApiForWp\Utils\Wordpress\Page {

    use MailGunApiForWp\MailGunApiForWp;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\Input;
    use MailGunApiForWp\Utils\Wordpress\Page\Input\RadioButtonGroup;
    use MailGunApiForWp\Utils\Wordpress\WordpressUtil;

    final class WordpressDisplayUtil {

        public static function displayForm($form) { ?>
            <form method="POST" action="<?php echo WordpressUtil::getFormAction(); ?>" id="<?php echo $form->getId();?>">
                <?php
                settings_fields($form->getOptionGroup());
                $savedOptions = $form->getSavedOptions();
                $inputs = $form->getInputs();
                $buttons = $form->getButtons();
                $optionName = $form->getOptionName();
                self::displayFormContent($savedOptions, $inputs, $optionName, $buttons);
                self::displaySpan("status");
                $spinnerId = $form->getId() . '-spinner';
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
                } else if ($input instanceof Input){
                    self::displayInputField($input, $optionName, $dbValue);
                } ?>
            </div>
        <?php }

        private static function displayInputField($input, $optionName, $dbValue) {
            switch ($input->getType()) {
                case 'text': self::displayTextInputField($input, $optionName, $dbValue); break;
                case 'checkbox': self::displayCheckboxField($input, $optionName, $dbValue); break;
                default: self::displayTextInputField($input, $optionName, $dbValue);break;
            }
        }

        private static function displayTextInputField($input, $optionName, $dbValue) {
            self::displayLabelHeader($input->getId(), $input->getLabel(), $input->getIsRequired()); ?>
                <input type="<?php echo $input->getType();?>"
                    class="text"
                    name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                    id="<?php echo $input->getId();?>"
                    value="<?php echo $dbValue;?>"
                    placeholder="<?php echo $input->getPlaceHolder();?>"
                    <?php echo $input->getIsRequired() ? 'required' : '';?>/>
        <?php }

        private static function displayCheckboxField($input, $optionName, $dbValue) {
            self::displayLabelHeader($input->getId(), $input->getLabel(), $input->getIsRequired()); ?>
                <input type="checkbox"
                   class="text"
                   name="<?php echo $optionName . '[' . $input->getName() . ']';?>"
                   id="<?php echo $input->getId();?>"
                   value="<?php echo $input->getValue();?>"
                   <?php echo $dbValue == $input->getValue() ? 'checked' : ''?>
                />
        <?php
        }

        private static function displayRadioButtonGroup($radioButtonGroup, $optionName, $dbValue) {
            ?>
                <label><?php echo $radioButtonGroup->getLabel(); echo $radioButtonGroup->getIsRequired() ? '*' : '';?></label>
                <div class="radio-buttons-group">
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
                </div>
        <?php }

        private static function displayLabelHeader($inputId, $text, $isRequired) { ?>
            <label for="<?php echo $inputId; ?>"><?php echo $text; echo $isRequired ? '*' : ''; ?></label>
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