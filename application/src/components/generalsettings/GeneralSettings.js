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
        this.settingForm.saveSettings('mgwp_http_settings', 'mgwp_http_settings_spinner', document.getElementsByClassName("widget-body")[0]);
    }

    saveSmtpSettings(){
        this.settingForm.saveSettings('mgwp_smtp_settings', 'mgwp_smtp_settings_spinner', document.getElementsByClassName("widget-body")[1]);
    }

    saveProviderSettings(){
        this.settingForm.saveSettings('mgwp_provider_settings', 'mgwp_provider_settings_spinner', document.getElementsByClassName("widget-body")[2]);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('saveHttpSettings').onclick = generalSettings.saveHttpSettings;
    document.getElementById('saveSmtpSettings').onclick = generalSettings.saveSmtpSettings;
    document.getElementById('saveProviderSettings').onclick = generalSettings.saveProviderSettings;
});

