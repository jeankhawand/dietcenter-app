import Home from "./components/recipe/RecipeList.vue";
import Login from "./components/login/Login.vue";
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
    }
];
export default routes;
