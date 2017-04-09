import expect from 'expect';
import * as sut from './SettingsForm';
import jsdom from 'jsdom';
/**
 * Created by Adrian Moraret on 4/7/2017.
 */
describe('Settings Form', () => {

    it('Should remove existing notifications elements', () => {
        jsdom.env(
            '<div><div class="ns-box">abc</div><div class="abc"></div><div class="ns-box">abc</div></div>',
            function (errors, window) {
                sut.SettingsForm.removeExistingNotifications(window.document.firstChild);
                const notificationElements = window.document.getElementsByClassName('ns-box');
                expect(notificationElements.length).toEqual(0);
            }
        )
    });

    it('Should save settings', () => {
        jsdom.env(
            '<form id="myForm"><input type="text" name="mySetting" /></form><div class="ns-box">abc</div>',
            function (errors, window) {
                new sut.SettingsForm().saveSettings('myForm','spinnerId',window.document.firstChild);
            }
        )
    });
});