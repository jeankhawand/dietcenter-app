import Home from "./components/recipe/RecipeList.vue";
import Login from "./components/auth/Login.vue";
import Logout from "./components/auth/Logout.vue";
import Cart from "./components/cart/Cart.vue";
import Dashboard from "./components/Admin/Dashboard.vue";
import Revenue from "./components/Admin/Revenue.vue";
import Admin from "./components/Admin/Admin.vue";
import Client from "./components/Client/Client.vue";
import Client_Dashboard from "./components/Client/Client_Dashboard.vue";

const routes = [{
        path: "/",
        name: "Home",
        component: Home
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

                path: "revenue",
                name: "Revenue",
                component: Revenue
            },
            {
                path: "dashboard",
                name: "Dashboard",
                component: Dashboard,
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


    }


];
export default routes;
