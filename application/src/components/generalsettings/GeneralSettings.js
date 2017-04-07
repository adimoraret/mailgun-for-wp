import AjaxRequest from "../../utils/ajax/AjaxRequest";
import Spinner from "../../utils/spinner/Spinner";
import Notification from '../../utils/notification/Notification';
import '../../../sass/components/generalsettings/generalsettings.scss';

export class GeneralSettings{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.saveSettings = this.saveSettings.bind(this);
        this.saveHttpSettings = this.saveHttpSettings.bind(this);
        this.saveSmtpSettings = this.saveSmtpSettings.bind(this);
        this.saveProviderSettings = this.saveProviderSettings.bind(this);
    }

    saveHttpSettings(){
        this.saveSettings('mgwp-http-settings', 'mgwp-http-settings-spinner', document.getElementsByClassName("widget-body")[0]);
    }

    saveSmtpSettings(){
        this.saveSettings('mgwp-smtp-settings', 'mgwp-smtp-settings-spinner', document.getElementsByClassName("widget-body")[1]);
    }

    saveProviderSettings(){
        this.saveSettings('mgwp-provider-settings', 'mgwp-provider-settings-spinner', document.getElementsByClassName("widget-body")[2]);
    }

    saveSettings(formId, spinnerId, notificationContainer){
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        const spinner = new Spinner(spinnerId);
        spinner.showSpinner();
        GeneralSettings.removeExistingNotifications(notificationContainer);
        this.ajaxRequest.post('options.php', formData)
            .then(function (response) {
                spinner.hideSpinner();
                let options = {
                    container: notificationContainer,
                    message: 'Settings saved!'
                };
                const notification = new Notification(options);
                notification.render();
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    static removeExistingNotifications(container){
        const notifications = container.getElementsByClassName('ns-box');
        for(let notification of notifications){
            container.removeChild(notification);
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('saveHttpSettings').onclick = generalSettings.saveHttpSettings;
    document.getElementById('saveSmtpSettings').onclick = generalSettings.saveSmtpSettings;
    document.getElementById('saveProviderSettings').onclick = generalSettings.saveProviderSettings;
});

