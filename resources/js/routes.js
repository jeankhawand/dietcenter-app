import Home from "./components/recipe/RecipeList.vue";
import Login from "./components/auth/Login.vue";
import Logout from "./components/auth/Logout.vue";

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
        path: "/logout",
        name: "Logout",
        component: Logout
    }
];
export default routes;
