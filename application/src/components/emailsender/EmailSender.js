import './emailsender.scss';
import Spinner from "../../library/spinner/Spinner";
import SettingsForm from "../common/SettingsForm";
import AjaxRequest from "../../library/ajax/AjaxRequest";
import Notification from '../../library/notification/Notification';
import {getWordpressAjaxUrl} from "../../library/wordpress/WordpressHelper";

export class EmailSender{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.ajaxUrl = getWordpressAjaxUrl();
        this.sendEmail= this.sendEmail.bind(this);
    }

    sendEmail(){
        tinyMCE.triggerSave();
        const form = document.getElementById('mgwp_email_sender_settings');
        let data = new FormData(form);
        data.append('action','mgwp_test_configuration');
        const spinner = new Spinner('mgwp_email_sender_settings_spinner');
        spinner.showSpinner();
        const notificationContainer = document.getElementsByClassName("widget-body")[0];
        SettingsForm.removeExistingNotifications(notificationContainer);
        const notificationIcons = new Map([['success', ['dashicons','dashicons-yes']], ['error', ['dashicons','dashicons-no-alt']]]);
        const notificationLabels = new Map([['success', 'Success'], ['error', 'Error']]);
        let notificationOptions = { container: notificationContainer, icons: notificationIcons, labels: notificationLabels };
        this.ajaxRequest.post(this.ajaxUrl, data)
            .then(function (response) {
                if (response.success) {
                    EmailSender.showNotification(spinner, notificationOptions, response.data.message, 'success');
                }
                else {
                    EmailSender.showNotification(spinner, notificationOptions, response.data.message, 'error');
                }
            })
            .catch(function (error) {
                EmailSender.showNotification(spinner, notificationOptions, error.data.message, 'error');
            });
    }

    static showNotification(spinner, options, message, status){
        spinner.hideSpinner();
        options.message = message;
        options.status = status;
        const notification = new Notification(options);
        notification.render();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const emailSender = new EmailSender();
    document.getElementById('emailSender').onclick = emailSender.sendEmail;
});

