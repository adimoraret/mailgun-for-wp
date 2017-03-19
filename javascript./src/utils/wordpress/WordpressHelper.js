/**
 * Created by Adrian Moraret on 3/18/2017.
 */

export function getWordpressAjaxUrl() {
    return (!!ajaxurl) ? ajaxurl : "admin-ajax.php";
}
