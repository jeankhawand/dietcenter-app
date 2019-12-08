
import ShopLayout from '@/components/Shop-Layout/Shop-Layout'
import Layout from '@/components/Layout/Layout';
import Login from '@/pages/Login/Login';
import ErrorPage from '@/pages/Error/Error';


// Main
import AnalyticsPage from '@/pages/Dashboard/Dashboard';

import AnalyticsPagecli from '@/pages/Dashboard-cli/Dashboard-cli';

import RevenuePage from '@/pages/Revenue/Revenue';

// Shop
import ShopPage from '@/pages/Home';
import Cart from '@/pages/Cart'

//admin
import Index from '@/pages/Admin/Index'
import New from '@/pages/Admin/New'
import Products from '@/pages/Admin/Products'
import Edit from '@/pages/Admin/Edit'
import Logout from "@/pages/Logout";
// Ui
import NotificationsPage from '@/pages/Notifications/Notifications';
const routes = [
        {
            path: '/login',
            name: 'Login',
            component: Login,
            meta: {
                requiresVisitor: true
            }
        },

        {
            path: '/error',
            name: 'Error',
            component: ErrorPage,
        },
        {
            path: '/',
            name: 'Shop-Layout',
            component: ShopLayout,
            children: [{

                path: 'home',
                name: 'ShopPage',
                component: ShopPage,

            },
                {
                    path: 'cart',
                    name: 'Cart',
                    component: Cart
                },
            ],
        },
        {
        path: "logout",
        name: "logout",
        component: Logout,
         },

        {
            path: '/app',
            name: 'Layout',
            component: Layout,
            meta: {
                        requiresAuth: true
            },
            children: [{
                path: 'dashboard',
                name: 'AnalyticsPage',
                component: AnalyticsPage,
            },
                {
                    path: 'dashboard-cli',
                    name: 'AnalyticsPage2',
                    component: AnalyticsPagecli,
                },
                {
                    path: 'revenue',
                    name: 'AnalyticsPage',
                    component: RevenuePage,
                },
                {
                    path: 'home',
                    name: 'ShopPage',
                    component: ShopPage,
                },
                {
                    path: 'cart',
                    name: 'Cart',
                    component: Cart
                },


                {
                    path: 'notifications',
                    name: 'NotificationsPage',
                    component: NotificationsPage,
                },
                {
                    path: 'admin',
                    component: Index,
                    children: [{
                        path: 'new',
                        name: 'New',
                        component: New
                    },
                        {
                            path: '',
                            name: 'Products',
                            component: Products
                        },
                        {
                            path: 'edit/:id',
                            name: 'Edit',
                            component: Edit
                        }
                    ]
                }

            ],
        },
];
export default routes;
