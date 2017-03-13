import React from 'react';
import {Route} from 'react-router';
import AdminPage from './components/adminpage/AdminPage';

export default(
    <Route path="/">
        <Route path="**/admin.php" component={AdminPage} />,
    </Route>
);