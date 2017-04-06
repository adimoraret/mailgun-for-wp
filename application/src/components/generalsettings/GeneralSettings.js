import AjaxRequest from "../../utils/ajax/AjaxRequest";
import {getWordpressAjaxUrl} from "../../utils/wordpress/WordpressHelper";
import Spinner from "../../utils/spinner/Spinner";
import Notification from '../../utils/notification/Notification';
import '../../../sass/components/generalsettings/generalsettings.scss';

export class GeneralSettings{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.ajaxUrl = getWordpressAjaxUrl();
        this.httpSettingsSpinner = new Spinner('spinner');
        this.sendTestEmail = this.sendTestEmail.bind(this);
        this.saveHttpSettings = this.saveHttpSettings.bind(this);
    }

    sendTestEmail(){
        let data = new FormData();
        data.append('action','mgwp_test_configuration');
        const spinner = this.httpSettingsSpinner;
        spinner.showSpinner();
        GeneralSettings.removeExistingNotifications();
        this.ajaxRequest.post(this.ajaxUrl, data)
            .then(function (response) {
                spinner.hideSpinner();
                let options = {
                    container: document.getElementsByClassName("widget-body")[0],
                    message: response.data.message
                };
                const notification = new Notification(options);
                notification.render();
            })
            .catch(function (error) {
                spinner.hideSpinner();
                console.log(error);
            });
    }

    saveHttpSettings(){
        const form = document.getElementById('mgwp-http-settings');
        const formData = new FormData(form);
        const spinner = this.httpSettingsSpinner;
        spinner.showSpinner();
        GeneralSettings.removeExistingNotifications();
        this.ajaxRequest.post('options.php', formData)
            .then(function (response) {
                spinner.hideSpinner();
                let options = {
                    container: document.getElementsByClassName("widget-body")[0],
                    message: 'Http settings saved!'
                };
                const notification = new Notification(options);
                notification.render();
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    static removeExistingNotifications(){
        let container = document.getElementsByClassName("widget-body")[0];
        const notifications = document.getElementsByClassName('ns-box');
        for(let notification of notifications){
            container.removeChild(notification);
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('testconfiguration').onclick = generalSettings.sendTestEmail;
    document.getElementById('saveHttpSettings').onclick = generalSettings.saveHttpSettings;
});

