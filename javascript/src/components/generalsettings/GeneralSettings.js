import AjaxRequest from "../../utils/ajax/AjaxRequest";
import {getWordpressAjaxUrl} from "../../utils/wordpress/WordpressHelper";

export class GeneralSettings{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.ajaxUrl = getWordpressAjaxUrl();
        this.sendTestEmail = this.sendTestEmail.bind(this);
    }

    sendTestEmail1(){
        console.log("ajaxReuest: ", this.ajaxRequest, " ajaxUrl: ", this.ajaxUrl);
        this.ajaxRequest.get(this.ajaxUrl)
            .then(function (data) {
                console.log(data);
            })
            .catch(function (error) {
                console.log("Error:", error);
            });
    }

    sendTestEmail(){
        const data = "action=mgwp_test_configuration";
        this.ajaxRequest.post(this.ajaxUrl, "application/x-www-form-urlencoded", data)
            .then(function (data) {
                console.log(data);
            })
            .catch(function (error) {
                console.log("Error:", error);
            });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const generalSettings = new GeneralSettings();
    document.getElementById('testconfiguration').onclick = generalSettings.sendTestEmail;
});

