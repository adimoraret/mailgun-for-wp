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
        let data = new FormData();
        data.append('action','mgwp_test_configuration');
        const spinner = new Spinner('mgwp-email-sender-spinner');
        spinner.showSpinner();
        const notificationContainer = document.getElementsByClassName("widget-body")[0];
        SettingsForm.removeExistingNotifications(notificationContainer);
        this.ajaxRequest.post(this.ajaxUrl, data)
            .then(function (response) {
                spinner.hideSpinner();
                let options = {
                    container: notificationContainer,
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
}

document.addEventListener('DOMContentLoaded', function () {
    const emailSender = new EmailSender();
    document.getElementById('emailSender').onclick = emailSender.sendEmail;
});

