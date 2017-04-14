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

    dismiss() {
        this.options.container.removeChild(this.notificationElement);
    }

    buildNotificationElement() {
        const notificationNodes = this.getNotificationElementChildren();
        notificationNodes.map(node => {
            this.notificationElement.appendChild(node)
        });
        this.notificationElement.className = Notification.getClassName(this.options.status);
    }

    getNotificationElementChildren() {
        const message = this.options.message;
        const iconClasses = this.options.icons.get(this.options.status);
        const statusLabel = this.options.labels.get(this.options.status);
        return [Notification.createMessageElement(message, iconClasses, statusLabel), this.closeButton]
    }

    static createMessageElement(message, iconClasses, statusLabel) {
        let messageNode = document.createElement('span');
        const notificationIcon = Notification.createNotificationIcon(iconClasses);
        const label = Notification.createNotificationLabel(statusLabel);
        messageNode.innerHTML = notificationIcon.outerHTML + label.outerHTML + message;
        return messageNode;
    }

    static createNotificationIcon(iconClasses) {
        let icon = document.createElement('i');
        iconClasses.forEach((iconClass) => icon.classList.add(iconClass));
        return icon;
    }

    static createNotificationLabel(statusLabel){
        let label = document.createElement('strong');
        label.innerHTML = statusLabel;
        return label;
    }

    static getClassName(status) {
        const classes = ['ns-box', 'ns-bar', 'ns-effect-slidetop', 'ns-type-notice', 'ns-show', 'ns-box-' + status];
        return classes.join(' ');
    }

    static createCloseButton() {
        let button = document.createElement('span');
        button.classList.add('ns-close');
        return button;
    }

    static createNotificationParentElement() {
        return document.createElement('div');
    }
}