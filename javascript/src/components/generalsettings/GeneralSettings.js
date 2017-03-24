import AjaxRequest from "../../utils/ajax/AjaxRequest";
import {getWordpressAjaxUrl} from "../../utils/wordpress/WordpressHelper";

export class GeneralSettings{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.ajaxUrl = getWordpressAjaxUrl();
        this.sendTestEmail = this.sendTestEmail.bind(this);
    }

    sendTestEmail(){
        const data = "action=mgwp_test_configuration";
        this.ajaxRequest.post(this.ajaxUrl, "application/x-www-form-urlencoded", data)
            .then(function (response) {
                document.getElementById("status").innerHTML = response.data.message;
            })
            .catch(function (error) {
                document.getElementById("status").innerHTML = "Error";
                console.log(error);
            });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('testconfiguration').onclick = generalSettings.sendTestEmail;
});

