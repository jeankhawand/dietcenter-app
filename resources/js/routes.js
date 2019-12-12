import Home from "./components/recipe/RecipeList.vue";
import Login from "./components/auth/Login.vue";
import Logout from "./components/auth/Logout.vue";
import Cart from "./components/cart/Cart.vue";
import Dashboard from "./components/Admin/Dashboard.vue";
import Revenue from "./components/Admin/Revenue.vue";
const routes = [{
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/login",
        name: "Login",
        component: Login
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
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard
    },
    {
        path: "/revenue",
        name: "Revenue",
        component: Revenue
    },




];
export default routes;