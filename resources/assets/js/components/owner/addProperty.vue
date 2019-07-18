<template>
    <div class="container">
                	
        <div class="card my-5">

            <form enctype="multipart/form-data">
            <h5 class="card-header">Step: {{step}}</h5>
            <div class="card-body">

                <div v-show="step === 1" class="row">

                    <h5 class="card-name col-md-12">Property Info:</h5>

                    <div class="form-group col-md-5">
                    <label>Title:</label>
                    <input v-model="form.name" type="text" placeholder="Property name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                    </div>

                    <div class="form-group col-md-5">
                    <label>Address:</label>
                    <input v-model="form.address" type="text" placeholder="Property Address"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                    <has-error :form="form" field="address"></has-error>
                    </div>

                    <div class="form-group col-md-12">
                    <label>Description:</label>
                    <textarea v-model="form.description" type="text" placeholder="Property Description"
                        class="form-control col-md-8" :class="{ 'is-invalid': form.errors.has('description') }">
                    <has-error :form="form" field="description"></has-error> </textarea>
                    </div>


                    <div class="form-group row m-2">
                        <div class="col-md-5">
                            <label for="thumbnail">Thumbnail</label>
                            <b-form-file multiple @change="convertPic"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('thumbnail') }">
                                <has-error :form="form" field="thumbnail"></has-error> -->
                            </b-form-file>
                        </div>
                        <!-- Show uploaded pic -->
                        <div class="col-md-5">
                            <img v-if="form.thumbnail!=''" :src="getUploadedPic()" class="img-thumbnail">
                        </div>
                    </div>
                    <hr>
                    <h5 class="col-md-12 mt-2">Property Features:</h5>

                    <div class="row mx-2 mb-2">
                        <div v-for="feature in features" v-bind:key="feature.id" class="col-sm-3 py-2">
                            <b-form-checkbox
                            v-model="form.features"
                            :value="feature.id"
                            >
                            {{feature.name}}
                            </b-form-checkbox>
                            <!-- <label class = "checkbox-inline p-2">
                                <input type = "checkbox" v-model="form.features" :value="feature.id"> {{feature.name}}
                            </label> -->
                        </div>
                    </div>
                    
                    <hr>
                    <div class="col-md-12">
		                <button  class="btn btn-primary" @click.prevent="next()">Next</button>
                    </div>
                </div>

                <div v-show="step === 2" class="row">
                    <h5 class="card-title col-md-12">Specifications</h5>

                    <div class="form-group col-md-5">
                        <label>Type:</label>
                        <select v-model="form.type" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('type') }">
                                <option value="house">House</option>
                                <option value="apartment">Apartment</option>
                        </select>
                    <has-error :form="form" field="type"></has-error>
                    </div>

                    <!-- <div class="form-group col-md-5">
                        <label>Status:</label>
                        <select v-model="form.status" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('status') }">
                                <option value="rent">Rent</option>
                                <option value="sale">Sale</option>
                        </select>
                    <has-error :form="form" field="status"></has-error>
                    </div> -->
                    
                    <!-- <div class="form-group col-md-5">
                    <input v-model="form.location" type="text" placeholder="Loaction"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('location') }">
                    <has-error :form="form" field="location"></has-error>
                    </div> -->

                    
                    <div class="form-group col-md-5">
                        <label>Bedrooms:</label>
                    <input v-model="form.bedrooms" type="number" placeholder="Bedrooms"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('bedrooms') }">
                    <has-error :form="form" field="bedrooms"></has-error>
                    </div>

                    
                    <div class="form-group col-md-5">
                        <label>Bathrooms:</label>
                    <input v-model="form.bathrooms" type="number" placeholder="Bathrooms"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('bathrooms') }">
                    <has-error :form="form" field="bathrooms"></has-error>
                    </div>

                    
                    <div class="form-group col-md-5">
                        <label>Floors:</label>
                    <input v-model="form.floors" type="number" placeholder="Floors"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('floors') }">
                    <has-error :form="form" field="floors"></has-error>
                    </div>

                    
                    <div class="form-group col-md-5">
                        <label>Garages:</label>
                    <input v-model="form.garages" type="number" placeholder="Garages"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('garages') }">
                    <has-error :form="form" field="garages"></has-error>
                    </div>

                    
                    <div class="form-group col-md-5">
                        <label>Area:</label>
                    <input v-model="form.area" type="number" placeholder="Area"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('area') }">
                    <has-error :form="form" field="area"></has-error>
                    </div>

                    
                    <!-- <div class="form-group col-md-5">
                        <label>Size:</label>
                    <input v-model="form.size" type="number" placeholder="Size"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('size') }">
                    <has-error :form="form" field="size"></has-error>
                    </div> -->

                    <h4 class="col-md-12"> Location: </h4>
                    <div class="form-group col-md-5">
                        <label>Country:</label>
                        <select v-model="form.country" class="form-control" @change="stateOf"
                            :class="{ 'is-invalid': form.errors.has('country') }">
                                <option value="" selected disabled>Choose Country</option>
                                <option v-for="country in countries" v-bind:key="country.id" :value="country.id">
                                    {{country.name}}</option>
                        </select>
                        <has-error :form="form" field="country"></has-error>
                    </div>
                    <div class="form-group col-md-5">
                        <label>State:</label>
                        <select v-model="form.state" class="form-control" @change="cityOf"
                            :class="{ 'is-invalid': form.errors.has('state') }">
                                <option value="" selected disabled>Choose State</option>
                                <option v-for="state in states" v-bind:key="state.id" :value="state.id">{{state.name}}</option>
                        </select>
                        <has-error :form="form" field="state"></has-error>
                    </div>
                    <div class="form-group col-md-5">
                        <label>City:</label>
                        <select v-model="form.city" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('city') }">
                                <option value="" selected disabled>Choose City</option>
                                <option v-for="city in cities" v-bind:key="city.id">{{city.name}}</option>
                        </select>
                        <has-error :form="form" field="city"></has-error>
                    </div>
                    <div class="col-md-12">
                        <button  class="btn btn-primary" @click.prevent="prev()">Previous</button>
                        <button  class="btn btn-primary" @click.prevent="next()">Next</button>
                    </div>
                </div>

                <div v-show="step === 3">

                    <h5 class="card-title">Add Rates On Multiple Occasions:</h5>

                    <div v-for="(occasion, index) in form.multipleOccasions" v-bind:key="index"
                    class="row my-4">

                        <div class="m-4">
                            <h1> {{index+1+':'}} </h1>
                        </div>

                        <div class="form-group col-3">
                            <label>Ocassion Name:</label>
                            <input v-model="occasion.occasion_name" type="text" placeholder="Occasion Name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('multipleOccasions.'+index+'.occasion_name') }">
                        </div>

                        <div class="form-group col-3">
                            <label>Ocassion Availability:</label>                            
                            <date-range-picker v-model="occasion.availability" :options="options" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('multipleOccasions.'+index+'.availability') }"
                             />
                        </div>
                        
                        <div class="form-group col-2">
                        <label>Per night rent:</label>
                        <input v-model="occasion.per_night_rent" type="number" placeholder="Per Night Rent*"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('multipleOccasions.'+index+'.per_night_rent') }">
                        </div>

                        <div class="form-group col-1" v-if="index!=0">
                            <label>.</label>
                            <button class="btn btn-danger" @click.prevent="deleteRow(index)">Delete</button>
                        </div>

                    </div>

                    <div class="my-4">
                        <button class="btn btn-primary" id="newAdd" @click.prevent="addRow">Add New</button>
                    </div>

                    <div class="form-group my-4">
                        <button  class="btn btn-primary" @click.prevent="prev()">Previous</button>
                    <button  class="btn btn-primary" @click.prevent="createProperty()">Create</button>
                    </div>
                </div>

                <div v-show="step === 4">

                    <h5 class="card-title"> Add your property pictures: </h5>
                    
 
                    <div v-for="(picture, index) in form2.pictures" v-bind:key="index"
                    class="row my-4">

                        <div class="m-4">
                            <h1> {{index+1+':'}} </h1>
                        </div>

                        <div class="form-group">
                            <div class="col-12 sm10">
                                <label for="Picture">Picture</label>
                                <!-- @change="convertPic" -->
                                    <input type="file" @change="getPic($event ,index)" name="picture"
                                    class="form-control" :class="{ 'is-invalid': form2.errors.has('pictures.'+index+'.media') }">
                                <has-error :form="form" field="picture"></has-error>
                            </div>

                        </div>

                        <div class="form-group col-1">
                            <label>.</label>
                            <button class="btn btn-danger" @click.prevent="removePic(index)">Delete</button>
                        </div>
                
                            <!-- Show uploaded pic -->
                        <div class="uploaded-pic-box col-6 ml-3">
                            <img v-if="form2.pictures[index].media!=''" :src="getPictures(index)" class="image-thumbnail">
                        </div>

                        <hr>

                    </div>

                    <div class="my-4">
                        <button class="btn btn-primary" id="newAdd" @click.prevent="addPic">Add New Picture</button>
                    </div>

                    <button  class="btn btn-primary" @click.prevent="savePictures()"> Save Changes </button>
                </div>
            </div>

            </form>

        </div> 
    </div>
</template>

<script>
    export default {
        data(){
            
            return{
                countries: [],
                states: [],
                cities: [],
                options: {
                    autoApply: true,
                },
                baseURL: Vue.prototype.$baseURL,
                //Form features
                property_id: '',
                features: {},
                step: 1,
                //Form features
                features: {},
                form: new Form({
                    name: '',
                    // per_night_rent: '',
                    description: '',
                    // availability,
                    address: '',
                    thumbnail: '',

                    type: '',
                    status: '',
                    location: '',
                    bedrooms: '',
                    bathrooms: '',
                    floors: '',
                    garages: '',
                    area: '',
                    size: '',
                    features: [],
                    //occasions
                    multipleOccasions: [],
                    
                    country: '',
                    state: '',
                    city: '',
                }),
                form2: new Form({
                    property_id: '',
                    pictures: [],
                }),
            }
        },
        methods:{
            stateOf(event){
                console.log("Country: "+ event.target.value);
                axios.post('/ajax/get_state_data', {
                    country: event.target.value
                })
                .then( ({ data }) => (this.states=data['success']) );
            },
            cityOf(event){
                console.log("Country: "+ event.target.value);
                axios.post('/ajax/get_city_data', {
                    state: event.target.value
                })
                .then( ({ data }) => (this.cities=data['success']) );
            },
            getPictures(index){
                let pic = (this.form2.pictures[index].media.length > 200) ? this.form2.pictures[index].media : this.baseURL+"/images/property/"+ this.form2.pictures[index].media ;
                return pic;
            },
            getUploadedPic(){
                let pic = (this.form.thumbnail.length > 200) ? this.form.thumbnail : this.baseURL+"/images/property/"+ this.form.thumbnail ;
                return pic;
            },
            prev() {
                this.step--;
            },
            next(){
                this.step++;
            },
            addPic(){
                this.form2.pictures.push({
                    media: '',
                    type: '',
                }); 
            },
            removePic(index){
                this.form2.pictures.splice(index,1);
            },
            addRow() {
                this.form.multipleOccasions.push({
                    occasion_name: '',
                    availability: '',
                    per_night_rent: '',
                });
            },
            deleteRow(index) {
                this.form.multipleOccasions.splice(index,1);
            },
            createProperty(){
                this.form.post('/property')
                .then( ({data})=>{
                    console.log(data);
                    this.property_id= data;

                    toast.fire({
                    type: 'success',
                    title: 'Property created successfully'
                    });        
                    this.step=4;
                    // this.$router.push('/properties');
                })
                .catch( ()=>{
                    if(this.form.errors.has('description') | this.form.errors.has('per_night_rent')
                    | this.form.errors.has('availibility') | this.form.errors.has('thumbnail')
                    | this.form.errors.has('address'))
                    {
                        this.step = 1;
                    }
                    else if(this.form.errors.has('status') | this.form.errors.has('location')
                    | this.form.errors.has('type') | this.form.errors.has('bedrooms')
                    | this.form.errors.has('bathrooms')| this.form.errors.has('floors') 
                    | this.form.errors.has('garages') | this.form.errors.has('area') 
                    | this.form.errors.has('size') | this.form.errors.has('city')
                    | this.form.errors.has('country') | this.form.errors.has('state')
                    )
                    {
                        this.step = 2;
                    }
                    else{
                        console.log('other error');
                    }
                })    
            },
            convertPic(element){
                //element containing profile pic
                let file = element.target.files[0];    //let file == var file
                //file = contains complete information about file size, type, date, name etc
                let reader = new FileReader();  //base64 file encoding
                
                //File sizes 2MB=2097152
                if( file['size'] < 2097152  ){
                    //Change file to base65
                    reader.onloadend = (file) => {
                        this.form.thumbnail = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                else{
                }
                
            },
            getPic(element, index){
                // console.log('Pic: '+ element.target.files[0]+ 'index: '+ index);
                //element containing profile pic
                let file = element.target.files[0];    //let file == var file
                //file = contains complete information about file size, type, date, name etc
                let reader = new FileReader();  //base64 file encoding
                
                //File sizes 2MB=2097152
                if( file['size'] < 2097152  ){
                    //Change file to base65
                    reader.onloadend = (file) => {
                        this.form2.pictures[index].media = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                else{
                }
                
            },
            getProfilePic(){
                let pic = (this.form.thumbnail.length > 200) ? this.form.thumbnail : this.baseURL+"/images/property/"+ this.form.thumbnail ;
                return pic;
            },
            setIndex(index){
                currentIndex = index;
            },
            savePictures(){
                this.form2.property_id = this.property_id;
                this.form2.post('/propertyPictures')
                .then( ()=>{
                    toast.fire({
                    type: 'success',
                    title: 'Property created successfully'
                    });        
                    this.$router.push('/properties');
                })
                .catch( ()=>{
                })    
            }

        },
        mounted() {
            //Getting property features
            axios.get('/property/create')
            .then( ({ data }) => (this.features=data) );
            
            axios.get('/ajax/get_countries_data')
            .then( ({ data }) => (this.countries=data['success']) );

            this.addRow();
            this.addPic();
            //end of prop features
        },
    }

</script>

