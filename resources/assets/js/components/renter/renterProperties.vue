<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">

        <!-- Search bar -->
        <div v-if="searchPanel" class="searchPanel">
            <form class="row shadow my-3 mx-3 pt-3">

                    <div class="form-group col-3">
                        <input v-model="form.lookingFor" type="text" placeholder="What are you looking for?"
                            class="form-control">
                    </div>

                    <div class="form-group col-3">
                        <input v-model="form.location" type="text" placeholder="Where"
                            class="form-control">
                    </div>

                    <div class="col-3">
                        <select v-model="form.cator" class="custom-select">
                            <option value="all">All Categories</option>	
                            <option value="apartment">Apartment</option>
                            <option value="house">House</option>
                        </select>
                    </div>

                    <div class="form-group col-3">
                        <button @click.prevent="showRelevantProperties" type="submit" 
                            class="btn btn-primary"> Search </button>
                    </div>

            </form>
        </div>
        <!-- Search bar -->

        <div class="showProperties shadow bg-light rounded">
            <div v-for="(property, index) in properties" v-bind:key="property.id">
                <div class="card my-5">

                    <div class="card-header text-center">
                        <b> {{property.name }} </b>
                    </div>

                <div class="row">
                    <div class="col-4">
                        <img :src="getThumb(index)" class="img-fluid" alt="">
                    </div>

                    <div class="col-8 card-body">
                        <b> <h3> {{property.name }} </h3> </b> <br>
                        <b>Location:  {{property.address }} </b> <br>
                        <b>Per night rent: {{property.per_night_rent }} </b> <br>
                        <b> Description: </b>  {{property.description }} <br><br>

                        <!-- <router-link :to="{ path: '/propertyView/'+property.id }"> -->
                                <button class="btn btn-primary" @click="previewProperty(property.id)"> Preview </button>
                        <!-- </router-link> -->
                                    
                    </div>

                </div>

                <div class="card-footer text-muted text-center">
                    <b>Created At: </b> {{property.created_at}} |
                    <b>  Updated:  </b> {{property.updated_at }}
                        
                </div>

                </div>
            </div>
        </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                baseURL: Vue.prototype.$baseURL,
                searchPanel: true,
                properties:{},
                form: new Form({
                })
            }
        },
        methods: {
            previewProperty(id){
                console.log(id);
                this.$router.push({ path: '/propertyView/'+id});
            },
            showRelevantProperties(){
                this.$Progress.start();
                this.form.post("/getRelevantProperties").then(({ data }) => (this.properties = data))
                .catch( ()=>{
                    this.$Progress.fail();
                });
                this.$Progress.finish();
            },
            getThumb(index){
                let pic = (this.properties[index].thumbnail.length > 200) ? this.properties[index].thumbnail : this.baseURL+"/images/property/"+ this.properties[index].thumbnail ;
                return pic;
            },
        },
        mounted() {
            console.log('Test Component mounted.')
            this.$Progress.start();
            axios.get("/getPropertiesView").then(({ data }) => (this.properties = data.data))
            .catch( ()=>{
                this.$Progress.fail();
            });
            this.$Progress.finish();
        }
    }
</script>
