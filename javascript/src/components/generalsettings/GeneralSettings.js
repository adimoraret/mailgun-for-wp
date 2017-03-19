import AjaxRequest from "../../utils/ajax/AjaxRequest";
import {getWordpressAjaxUrl} from "../../utils/wordpress/WordpressHelper";

console.log("In GeneralSettings");
class GeneralSettings{

    constructor(){
        this.ajaxRequest = new AjaxRequest();
        this.ajaxUrl = getWordpressAjaxUrl();
        console.log("ajaxReuest: ", this.ajaxRequest, " ajaxUrl: ", this.ajaxUrl);
    }

    sendTestEmail(){
        this.ajaxRequest.get(this.ajaxUrl)
            .then(function (data) {
                console.log(data.group);
            })
            .catch(function (error) {
                console.log("Error:", error);
            });
    }
}

export default GeneralSettings;