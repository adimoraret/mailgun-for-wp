/**
 * Created by Adrian Moraret on 4/7/2017.
 */
import AjaxRequest from '../../library/ajax/AjaxRequest';
import Spinner from '../../library/spinner/Spinner';
import Notification from '../../library/notification/Notification';

export default class SettingsForm{
    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.saveSettings = this.saveSettings.bind(this);
    }

    saveSettings(formId, spinnerId, notificationContainer){
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        const spinner = new Spinner(spinnerId);
        spinner.showSpinner();
        SettingsForm.removeExistingNotifications(notificationContainer);
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