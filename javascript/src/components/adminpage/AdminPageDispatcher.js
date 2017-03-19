/**
 * Created by Adrian Moraret on 3/16/2017.
 */
import * as urlHelper from '../../utils/url/UrlHelper';
import Settings from '../settings/Settings';

class AdminPage {
    isAdminPluginPage(){
        return window.location.href.indexOf("/admin.php?page=") > 0;
    }

    runComponent(pageName){
        switch (pageName){
            case "mgwp-pg-1" : new Settings();
        }
    }

    render(){
        if (!this.isAdminPluginPage()) {
            return;
        }
        const queryParams = urlHelper.getQueryParameters();
        const pageSlug = queryParams["page"];
        this.runComponent(pageSlug);
    }
}

export default AdminPage;