import Home from "./components/recipe/RecipeList.vue";
import Login from "./components/auth/Login.vue";
import Logout from "./components/auth/Logout.vue";
import Cart from "./components/cart/Cart.vue";
import Diet_Dashboard from "./components/Admin/Diet_Dashboard.vue";
import Manager_Dashboard from "./components/Admin/Manager_Dashboard.vue";
import Admin from "./components/Admin/Admin.vue";
import Client from "./components/Client/Client.vue";
import Client_Dashboard from "./components/Client/Client_Dashboard.vue";
import Chef from "./components/Chef/Chef.vue";
import Chef_Dashboard from "./components/Chef/Chef_Dashboard.vue";
import NotFound from "./components/Error/Error";
const routes = [{
        path: "/",
        name: "Home",
        component: Home
    },

    {
        path: "*",
        name: "Error",
        component: NotFound
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: {
            requiresVisitors: true
        }

    },
    {
        path: "/cart",
        name: "Cart",
        component: Cart
    },
    {
        path: "/logout",
        name: "Logout",
        component: Logout
    },
    {
        path: "/admin",
        name: "Admin",
        component: Admin,
        meta: {
            requiresAuth: true,
        },
        children: [{

                path: "manager_dashboard",
                name: "Manager_Dashboard",
                component: Manager_Dashboard
            },
            {
                path: "diet_dashboard",
                name: "Diet_Dashboard",
                component: Diet_Dashboard,
            }
        ],
    },
    {
        path: "/client",
        name: "Client",
        component: Client,
        meta: {
            requiresAuth: true,
        },
        children: [{
            path: "client_dashboard",
            name: "CLient_Dashboard",
            component: Client_Dashboard,
        }],
    },

    {
        path: "/chef",
        name: "Chef",
        component: Chef,
        meta: {
            requiresAuth: true,
        },
        children: [{
            path: "chef_dashboard",
            name: "Chef_Dashboard",
            component: Chef_Dashboard,
        }],
    },





];
export default routes;