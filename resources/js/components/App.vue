<template>
  
    <v-app>
        
        <v-content>
            <router-view></router-view>
        </v-content>
        <Layout />
    </v-app>
</template>

<script>
import Layout from "./dashboard-layout/Layout";


export default {
    name: "App",
    components: {
        Layout
       
        
    }
};
</script>
