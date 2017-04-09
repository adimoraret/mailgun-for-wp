import './generalsettings.scss';
import SettingsForm from "../common/SettingsForm";

export class GeneralSettings{

    constructor(){
        this.settingForm = new SettingsForm();
        this.saveHttpSettings = this.saveHttpSettings.bind(this);
        this.saveSmtpSettings = this.saveSmtpSettings.bind(this);
        this.saveProviderSettings = this.saveProviderSettings.bind(this);
    }

    saveHttpSettings(){
        this.settingForm.saveSettings('mgwp-http-settings', 'mgwp-http-settings-spinner', document.getElementsByClassName("widget-body")[0]);
    }

    saveSmtpSettings(){
        this.settingForm.saveSettings('mgwp-smtp-settings', 'mgwp-smtp-settings-spinner', document.getElementsByClassName("widget-body")[1]);
    }

    saveProviderSettings(){
        this.settingForm.saveSettings('mgwp-provider-settings', 'mgwp-provider-settings-spinner', document.getElementsByClassName("widget-body")[2]);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('saveHttpSettings').onclick = generalSettings.saveHttpSettings;
    document.getElementById('saveSmtpSettings').onclick = generalSettings.saveSmtpSettings;
    document.getElementById('saveProviderSettings').onclick = generalSettings.saveProviderSettings;
});

