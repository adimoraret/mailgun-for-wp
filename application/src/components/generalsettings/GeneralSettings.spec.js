/**
 * Created by Adrian Moraret on 4/7/2017.
 */
import * as sut from './GeneralSettings';
import {beforeEach, it, describe} from "mocha";
import {jsdom} from "jsdom/lib/jsdom";

describe('General Settings', () => {

    let generalSettings = null;

    beforeEach(function () {
        generalSettings = new sut.GeneralSettings();
    });

    it('Should save http settings', () => {
        jsdom.env(
            '<form id="myForm"><input type="text" name="mySetting" /></form><div class="ns-box">abc</div>',
            function (errors, window) {
                generalSettings.saveHttpSettings('myForm', 'spinnerId', window.document.firstChild);
            }
        )
    });
});