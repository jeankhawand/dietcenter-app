import Home from "./components/recipe/RecipeList.vue";
import Login from "./components/auth/Login.vue";
import Logout from "./components/auth/Logout.vue";
import Cart from "./components/cart/Cart.vue";

const routes = [
    {
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
    }
];
export default routes;
