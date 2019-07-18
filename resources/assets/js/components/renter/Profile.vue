
<template>
    <div class="container">
        <div class="row justify-content-center">

            <!-- User profile header -->
            <div class="col-md-12 mt-3">
                    <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">

                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="profile-header-cover">
                        <!-- Cover Photo Refer to profil-header CSS internal CSS -->
                    </div>

                    <div class="widget-user-image">
                        <img v-if="form.user_image!=null" class="img-circle" :src="getProfilePic()" alt="User Avatar">
                    </div>

                    <div class="card-footer">
                        <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">Phone</h5>
                                <span class="description-text">+92 213 12431 2</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                            <h5 class="description-header"> {{form.name}} </h5>
                            <span class="description-text"> {{form.role}} </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                            <h5 class="description-header">Email</h5>
                            <span class="description-text"> {{form.email}} </span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->

            </div>
        </div>


    <!-- User Profile Settings -->
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">

            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active show" href="#myRoute" data-toggle="tab"> Notifications </a></li>
                  <li class="nav-item"><a class="nav-link" href="#preferences" data-toggle="tab">Preferences</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Profile Settings</a></li>
                </ul>
              </div><!-- /.card-header -->

              <div class="card-body">

                <div class="tab-content">

                  <div class="tab-pane active show" id="myRoute">
                    <!-- myRoute -->

                        <h4 class="text-center"> Enter your Notification Preferences </h4>

                            <div class="form-group">
                                <label for="StartingPoint">  point1: </label>
                            </div>

                            <div class="form-group">
                                <label for="EndingPoint">  point2: </label>

                            </div>

                                <button @click.prevent="" type="submit" 
                                class="btn btn-primary my-2"> Show  </button>

                  </div>


                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="preferences">
                    <!-- The preferences -->
                        
                        <form  enctype="multipart/form-data">

                        <h4 class="text-center"> Preferences  </h4>
                        
                            <div class="form-group">
                                <label for="departure_time"> pref1: </label>
                                <input v-model="form" type="time" name="departure_time" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('departure_time') }">
                            </div>

                            <div class="form-group">
                                <label for="arrival_time"> pref2: </label>
                                <input v-model="form" type="time" name="arrival_time" 
                                class="form-control" :class="{ 'is-invalid': form.errors.has('arrival_time') }">
                            </div>
                            
                            
                        <h4 class="text-center"> Other  </h4>

                            <div class="form-group">
                                <select name="v_type" value="Select Vehicle Type" v-model="form"
                                 class="form-control" :class="{ 'is-invalid': form.errors.has('v_type') }">
                                    <option value="car">Car</option>
                                    <option value="van">Van</option>
                                    <option value="bus">Bus</option>
                                </select>
                                <has-error :form="form" field="v_type"></has-error>
                            </div>
                            

                            <button  @click.prevent ="setPreferences" type="submit" class="btn btn-primary"> Set Preferences </button>
                            
                            </form>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                                
                    <form enctype="multipart/form-data" >

                        <div class="modal-body col-10">

                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"
                                    placeholder="Name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="text" name="email"
                                    placeholder="Email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" disabled>
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.phone" type="text" name="phone"
                                    placeholder="Phone"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="text" name="password"
                                    placeholder="Password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>


                            <div class="form-group">
                                <label for="profile pic">Profile Picture</label>
                                <div class="col-sm10">
                                    <input type="file" @change="convertPic" class="file-input" name="profile_pic">
                                    <has-error :form="form" field="profile_pic"></has-error>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer col-10">
                            <button @click.prevent ="updateInfo" type="submit" class="btn btn-primary"> Update </button>
                        </div>

                    </form>
        
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>

        </div>
    </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                baseURL: Vue.prototype.$baseURL,
                form: new Form({
                    name: '',
                    email: '',
                    user_image: '',
                    
                }),
            }
        },
        methods:{
            convertPic(element){
                //element containing profile pic
                let file = element.target.files[0];    //let file == var file
                //file = contains complete information about file size, type, date, name etc
                console.log(file);
                let reader = new FileReader();  //base64 file encoding
                
                //File sizes 2MB=2097152
                if( file['size'] < 2097152  ){
                    //Change file to base65
                    reader.onloadend = (file) => {
                        this.form.user_image = reader.result;
                    }
                    reader.readAsDataURL(file);
                }
                else{
                    Swal.fire({
                        type: 'error',
                        title: 'Oops..',
                        text: 'You are uploading a large file!',
                    })
                }
                
                
            },
            getProfilePic(){
                let pic = (this.form.user_image.length > 200) ? this.form.user_image : this.baseURL+"/images/user/renter/"+ this.form.user_image ;
                return pic;
            },
            updateInfo(){
                this.$Progress.start();
                this.form.post('/update_renter')
                .then( ()=> {
                    this.$Progress.finish();
                    //Show success modal
                    Swal.fire(
                    'Updated!',
                    'Your profile has been updated.',
                    'success'
                    )
                })
                .catch( ()=>{
                    this.$Progress.fail();
                });
            },
        },
        created(){
            //Get current logged in profile data
            this.$Progress.start();
            axios.get("/renter_profile")
            .then( ({ data }) => (this.form.fill(data)) )
            .catch( ()=>{
                this.$Progress.fail();
            });
            this.$Progress.finish();
        },
        mounted() {
            
        },
    } 
</script>