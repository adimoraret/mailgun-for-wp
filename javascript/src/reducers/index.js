import {combineReducers} from 'redux';
import settings from './SettingsReducer';

const rootReducer = combineReducers({
    settings: settings
});

export default rootReducer;