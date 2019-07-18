<template>
    <div class="container-fluid card">

        <div class="p-4">
            <h2> {{property.title}} </h2>
            <h4 class="text-primary my-4"> <i class="fa fa-map-marker"></i> {{property.address}} </h4>
        </div>


        <b-carousel
            id="carousel-1"
            :interval="3000"
            controls
            indicators
            background="#ababab"
            img-width="1024"
            img-height="480"
            style="text-shadow: 1px 1px 2px #333;">
            
            <span v-for="(image, index) in property.pictures" :key="index">
                <b-carousel-slide
                    :img-src="getPicture(index)"
                ></b-carousel-slide>
            </span>
        </b-carousel>

        <div class="card-body py-5">

            <hr>

            <h3 class="card-title mt-3"> <b> About this property: </b> </h3>
            <p> {{property.description}} </p>

            <h3 class="card-title my-5"> <b> Rates On Multiple Occasions: </b> </h3>

            <table class="table table-hover mb-5">

                <tbody>
                <tr>
                <th>Occasion Name: </th>
                <th>Occasion Availability: </th>
                <th>Per night rent: </th>
                </tr>
                <!-- Insert dynamic data in table -->

                <tr v-for="occasion in property.multipleOccasions" :key="occasion.id">
                <td>{{occasion.occasion_name}}</td>
                <td>{{occasion.availability[0]}} - {{occasion.availability[1]}}</td>
                <td>{{occasion.per_night_rent}}</td>
                </tr>

            </tbody></table>
            
            <div class=" text-center">
                <button @click="bookNow()" class="btn btn-outline-success btn-lg"> Book Now </button>
            </div>

            <h3 class="card-title mt-5"> <b> Property Features: </b> </h3>
                <div class="row">
                    <div v-for="(feature, index) in property.features" :key="index" class="col-sm-4">
                            <h5> <i class="fa fa-check my-2"></i> {{feature['feature'].name }} </h5> 
                    </div>
                </div>

            <h3 class="card-title mt-5"> <b> Property Details: </b> </h3>

                <div class="row mt-3">
                    
                    <div class="col-6">
                        <table class="table table-reflow">
                        <tbody>
                            <tr>
                            <th>Type: </th>
                            <td>{{property.type}}</td>
                            </tr>
                            <tr>
                            <th>Bathrooms</th>
                            <td>{{property.bathrooms}}</td>
                            </tr>
                            <tr>
                            <th>Bedrooms</th>
                            <td>{{property.bedrooms}}</td>
                            </tr>
                            <tr>
                            <th>Available for</th>
                            <td>{{property.status}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>   

                    <div class="col-6">
                        <table class="table table-reflow">
                        <tbody>
                            <tr>
                            <th>Area </th>
                            <td>{{property.area}}</td>
                            </tr>
                            <tr>
                            <th>Garages</th>
                            <td>{{property.garages}}</td>
                            </tr>
                            <tr>
                            <th>Floors</th>
                            <td>{{property.floors}}</td>
                            </tr>
                        </tbody>
                        </table>
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
                property:{},
                form: new Form({
                })
            }
        },
        methods: {
            bookNow(){
                // console.log('me: '+ +', my Friend: '+ this.property.user_id);
                // this.$get.myId = 0;
                // this.$get.friendId = this.property.user_id;
                // console.log(this.$get.myId+' to '+ this.$get.friendId);
                // this.$router.push({ path: '/chat/'+this.me.id+'/'+this.property.user_id });
                // this.$router.push({ name: 'chat', params: {myId: '0', friendId: this.property.user_id }});
                // this.$router.push({ path: '/renterDash'});
                window.location.href = this.baseURL+'/renterDash';
            },
            getPicture(index){
                let pic = (this.property.pictures[index].media.length > 200) ? this.property.pictures[index].media : this.baseURL+"/images/property/"+ this.property.pictures[index].media ;
                return pic;
            },
        },
        mounted() {
            // console.log('Test Component mounted.'+ this.$get.myId);
            // console.log(m);
            //Load data
            let id = this.$route.params.id;
            this.$Progress.start();
            axios.get('/propertyView/'+id).then(({ data }) => (this.property = data))
            .catch( ()=>{
                this.$Progress.fail();
            });
            this.$Progress.finish();
            this.friendId = this.property.user_id;
        }
    }
</script>
