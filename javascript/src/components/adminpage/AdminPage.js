import * as React from "react";
import Settings from '../settings/Settings';

class AdminPage extends React.Component {
    constructor(props, context){
        super(props, context);
    }
    render(){
        console.log("Props", this.props);
        const { query } = this.props.location;
        const { page } = query;
        const component = this.getComponent(page);
        return component;
    }

    getComponent(page){
        switch (page) {
            case "mgwp-pg-1" : return (<Settings/>);
            default: return (<div>Invalid settings page</div>);
        }
    }
}
export default AdminPage;