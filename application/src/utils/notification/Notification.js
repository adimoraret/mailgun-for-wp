/**
 * Created by Adrian Moraret on 4/2/2017.
 */
import './scss/notification.scss';
import './scss/notification-bar.scss';

export default class Notification {

    constructor(options) {
        this.options = options;
        this.buildNotificationElement = this.buildNotificationElement.bind(this);
        this.render = this.render.bind(this);
    }

    render() {
        this.notificationElement = Notification.createNotificationParentElement();
        this.buildNotificationElement();
        this.options.container.insertBefore(this.notificationElement, this.options.container.firstChild);
    }

    buildNotificationElement() {
        this.notificationElement.innerHTML = Notification.createNotificationInnerString(this.options.message);
        this.notificationElement.className = Notification.getClassName();
    }

    static getClassName() {
        return "ns-box ns-bar ns-effect-slidetop ns-type-notice ns-show ns-box-success";
    }

    static createNotificationInnerString(message) {
        //let innerString = '<span>';
        let innerString = '<span>' + message + '</span>';
        //innerString += '</span>';
        innerString += '<span class="ns-close"></span></div>';
        return innerString;
    }

    static createNotificationParentElement() {
        return document.createElement('div');
    }
}
