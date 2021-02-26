<template>
    <div id="register">
        <div v-if="registered" class="success_div">
            <div>
                <span> <i class="fas fa-check-circle"></i> </span>
                <h3>You are now registered</h3>
                <a href="/employer" class="btn btn-primary">Login Now</a>
            </div>
        </div>
        <form v-else  @submit.prevent="register">
            <div class="">
                <h6>Personal Information</h6>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Firstnamea</label>
                            <input v-model="form.fname" type="text" class="form-control" name="" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Lastname</label>
                            <input v-model="form.lname" type="text" class="form-control" name="" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Company Name</label>
                            <input v-model="form.company" type="text" class="form-control" name="" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Company Address</label>
                            <input v-model="form.company_address" type="text" class="form-control" name="" value="">
                        </div>
                    </div>
                </div>
                <hr>
                <h6>Contact Information</h6>
                <div class="row">
                    <div class="col-6">
                        <label >Contact Number</label>
                        <div v-for="(contact_dat, index) in form.contact_data.contacts" :key="index" class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                                <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{contact_dat}}</h6>
                                <small>remove</small>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input v-model="form.contact_data.contact_in" type="text" class="form-control">
                            <div class="input-group-append">
                                <button @click="addContact" class="btn btn-outline-primary" type="button">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label >Email Address</label>
                        <div v-for="(email_dat, index) in form.email_data.emails" :key="index" class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start mb-2">
                                <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{email_dat}}</h6>
                                <small>remove</small>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input v-model="form.email_data.email_in" type="text" class="form-control">
                            <div class="input-group-append">
                                <button @click="addEmail" class="btn btn-outline-primary" type="button">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h6>CREDENTIALS</h6>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input v-model="form.username" type="text" class="form-control" name="" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input v-model="form.password" type="text" class="form-control" name="" value="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="text" v-model="form.con_pass" class="form-control" name="" value="">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                fname:null,
                lname:null,
                company:null,
                company_address:null,
                username:null,
                password:null,
                con_pass:null,
                email_data:{
                    email_in:null,
                    emails:[]
                },
                contact_data:{
                    contact_in:null,
                    contacts:[]
                }
            },
            registered:false
        }
    },
    methods:{
        addEmail(){
            this.form.email_data.emails.push(this.form.email_data.email_in)
        },
        addContact(){
            this.form.contact_data.contacts.push(this.form.contact_data.contact_in)
        },
        register(){
            let cons = JSON.stringify(this.form.contact_data.contacts);
            let emails = JSON.stringify(this.form.email_data.emails);
            let formData = new FormData;
            formData.append('fname',this.form.fname);
            formData.append('lname',this.form.lname);
            formData.append('contacts',cons);
            formData.append('emails',emails);
            formData.append('company',this.form.company); 
            formData.append('company_address',this.form.company_address); 
            formData.append('username',this.form.username); 
            formData.append('password',this.form.password); 
            const vm = this;
            axios.post('/handleRegisterEmployer', formData)
                .then(function (response) {
                    console.log(response.data);
                    if(response.data.status){
                        alert("mol");
                        vm.registered = true
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }
}
</script>