<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    

                    <nav class="nav nav-pills nav-justified my-5">
                        <router-link class="nav-link" to="/allproperties"> All </router-link>
                        <a class="nav-link" href="#">Popular</a>
                        <a class="nav-link" href="#">Latest</a>
                    </nav>

                </div>
                    <router-view> </router-view>
                    <!-- <component v-bind:is="currentTabComponent"></component> -->
            </div>
        </div>
    </div>
</template>

<script>
// import allproperties from "./AllProperties.vue";
    export default {
        components:{
            // allproperties,
        },
        data(){
            return{
                searchPanel: true,
                cator: '',
                lookingFor: '',
                location: '',
            }
        },
        methods:{
        },
        mounted() {
            
            this.$router.push({ path: '/allproperties' });
            console.log('Component mounted.')
        }
    }
</script>
