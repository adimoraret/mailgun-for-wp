/**
 * Created by Adrian Moraret on 4/7/2017.
 */
import AjaxRequest from '../../library/ajax/AjaxRequest';
import Spinner from '../../library/spinner/Spinner';
import Notification from '../../library/notification/Notification';

export default class SettingsForm {
    constructor() {
        this.ajaxRequest = new AjaxRequest();
        this.saveSettings = this.saveSettings.bind(this);
    }

    saveSettings(formId, spinnerId, notificationContainer) {
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        const spinner = new Spinner(spinnerId);
        spinner.showSpinner();
        SettingsForm.removeExistingNotifications(notificationContainer);
        const notificationIcons = new Map([['success', ['dashicons','dashicons-yes']], ['error', ['dashicons','dashicons-no-alt']]]);
        const notificationLabels = new Map([['success', 'Success'], ['error', 'Error']]);
        let notificationOptions = { container: notificationContainer, icons: notificationIcons, labels: notificationLabels };
        this.ajaxRequest.post('options.php', formData)
            .then(function (response) {
                SettingsForm.showNotification(spinner, notificationOptions, 'Settings saved', 'success');
            })
            .catch(function (error) {
                SettingsForm.showNotification(spinner, notificationOptions, 'Error saving Settings', 'error');
            })
    }

    static showNotification(spinner, options, message, status) {
        spinner.hideSpinner();
        options.message = message;
        options.status = status;
        const notification = new Notification(options);
        notification.render();
    }

    static removeExistingNotifications(container) {
        const notifications = container.getElementsByClassName('ns-box');
        for (let notification of notifications) {
            container.removeChild(notification);
        }
    }
}