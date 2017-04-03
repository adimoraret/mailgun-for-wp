import AjaxRequest from "../../utils/ajax/AjaxRequest";
import {getWordpressAjaxUrl} from "../../utils/wordpress/WordpressHelper";
import Spinner from "../../utils/spinner/Spinner";
import '../../../sass/components/generalsettings/generalsettings.scss';
import Notification from '../../utils/notification/Notification';

export class GeneralSettings{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.ajaxUrl = getWordpressAjaxUrl();
        this.sendTestEmail = this.sendTestEmail.bind(this);
    }

    sendTestEmail(){
        const data = "action=mgwp_test_configuration";
        const spinner = new Spinner('spinner');
        const statusMessageElement = document.getElementById("status");
        statusMessageElement.innerHTML = "";
        spinner.showSpinner();
        this.ajaxRequest.post(this.ajaxUrl, "application/x-www-form-urlencoded", data)
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
                statusMessageElement.innerHTML = "Error";
                console.log(error);
            });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('testconfiguration').onclick = generalSettings.sendTestEmail;
});

