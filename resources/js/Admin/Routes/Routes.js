import Adminlayout from '../Adminlayout';
import Welcome from 'AdminViews/Welcome';

import UserRoutes from './UserRoutes';
import SiteSettingRoutes from './SiteSettingRoutes';
import RoleRoutes from './RoleRoutes';

console.log('admin rout');

export default {
    path: '/dashboard/pages',
    component: Adminlayout,
    name: 'Adminlayout',
    children: [
        { path: '', component: Welcome },
        { path: 'welcome', component: Welcome, name: 'welcome' },

        UserRoutes,
        SiteSettingRoutes,
        RoleRoutes,
    ]

}