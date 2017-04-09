/**
 * Created by Adrian Moraret on 4/2/2017.
 */
import './notification.scss';
import './notification-bar.scss';

export default class Notification {

    constructor(options) {
        this.options = options;
        this.buildNotificationElement = this.buildNotificationElement.bind(this);
        this.getNotificationElementChildren = this.getNotificationElementChildren.bind(this);
        this.render = this.render.bind(this);
        this.dismiss = this.dismiss.bind(this);
    }

    render() {
        this.notificationElement = Notification.createNotificationParentElement();
        this.closeButton = Notification.createCloseButton();
        this.closeButton.onclick = this.dismiss;
        this.buildNotificationElement();
        this.options.container.insertBefore(this.notificationElement, this.options.container.firstChild);
    }

    dismiss(){
        this.options.container.removeChild(this.notificationElement);
    }

    buildNotificationElement() {
        const notificationNodes = this.getNotificationElementChildren(this.options.message);
        notificationNodes.map(node => {this.notificationElement.appendChild(node)} );
        this.notificationElement.className = Notification.getClassName();
    }

    getNotificationElementChildren(message) {
        return [Notification.createMessageElement(message), this.closeButton]
    }

    static createMessageElement(message){
        let messageNode = document.createElement('span');
        messageNode.innerHTML = message;
        return messageNode;
    }

    static getClassName() {
        return "ns-box ns-bar ns-effect-slidetop ns-type-notice ns-show ns-box-success";
    }

    static createCloseButton(){
        let button = document.createElement('span');
        button.classList.add('ns-close');
        return button;
    }

    static createNotificationParentElement() {
        return document.createElement('div');
    }
}