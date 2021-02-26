<template>
    <div v-if="success" class="card">
        <div class="card-header">
            <h5>Registered</h5>
        </div>
        <div class="card-body">
            <div>
                SUCCESS
            </div>
            <button class="btn-success btn">Login</button>
        </div>
    </div>
    <div v-else id="register" class="">

        <div class="floating-btn">
            <button @click="register" class="btn btn-danger">Register</button>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="card shadow col-11 profile-register">
                <div class="card-body">
                    <div class="row first_row">
                        <div class="col-8">
                            <div class="image-holder">
                                <div class="image"> 
                                    <button class="edit-btn btn">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                                <div class="title-holder">
                                    <h4 v-if="form.fname == null && form.lname == null">Enter Fullname</h4>
                                    <h4 v-else>{{form.fname}} {{form.lname}}</h4>

                                    <span v-if="form.address == null" >Enter Address <span class="require">*</span> </span>
                                    <span>{{form.address}}</span>
                                    <br>
                                </div>
                                <button v-b-modal.personal-info class="edit-btn btn">
                                    <i  class="fas fa-pencil-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <button v-b-modal.gov-id class="edit-btn btn gov-btn">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <div class="gov-ids">
                                <div>
                                    <h6>SSS number &nbsp;:&nbsp;</h6>
                                    <span v-if="form.sss == null">N/A</span>
                                    <span v-else>{{form.sss}}</span>
                                </div>
                                <div>
                                    <h6>PAGIBIG number &nbsp;:&nbsp;</h6>
                                    <span v-if="form.pagibig == null">N/A</span>
                                    <span v-else>{{form.pagibig}}</span>
                                </div>
                                <div>
                                    <h6>TIN number &nbsp;:&nbsp;</h6>
                                    <span v-if="form.tin == null">N/A</span>
                                    <span>{{form.tin}}</span>
                                </div>
                                <div>
                                    <h6>PhilHealth number &nbsp;:&nbsp;</h6>
                                    <span v-if="form.philhealth == null">N/A</span>
                                    <span v-else>{{form.philhealth}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row second_row">
                        <div class="col-4 side-info">
                            <div class="p-3">
                                <h6>Contact Number</h6>
                                <button v-b-modal.contacts class="edit-btn btn pos-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <span v-if="form.contacts.length == 0">Enter Contact Number</span>
                                <ul v-else class="list-unstyled">
                                    <li v-for="(contact,index) in form.contacts" :key="index">{{contact}}</li>
                                </ul>
                            </div>

                            <div class="p-3">
                                <h6>Emails</h6>
                                <button v-b-modal.emails class="edit-btn btn pos-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <span v-if="form.emails.length == 0">Enter Email Address</span>
                                <ul v-else class="list-unstyled">
                                    <li v-for="(emails,index) in form.emails" :key="index">{{emails}}</li>
                                </ul>
                            </div>

                            <div class="p-3">
                                <h6>Languages</h6>
                                <button v-b-modal.languages class="edit-btn btn pos-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <span v-if="form.langauge.length == 0">Enter Languages</span>
                                <ul v-else class="list-unstyled">
                                    <li v-for="(language, index) in form.langauge" :key="index"> <strong>{{language.name}}</strong> : {{language.level}} </li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-8">
                            <div class="p-4 details">
                                <button v-b-modal.description class="edit-btn btn pos-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <h4 v-if="form.description == null">Share somethin about yourself</h4>
                                <p v-else v-html="form.description" class="pt-4">
                                </p>
                            </div>
                            <div class="p-4 work-history">
                                <h6>Work History</h6>
                                <button class="edit-btn btn pos-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <span>No work done yet</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <b-modal id="personal-info">
            <div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Firstname</label>
                        <input v-model="form.fname" type="text" class="form-control">
                    </div>
                    <div class="form-group col-6">
                        <label for="">Lastname</label>
                        <input v-model="form.lname" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input v-model="form.address" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select v-model="form.level" class="form-control" name="" id="">
                        <option value="0">No Experience</option>
                        <option value="1">Entry Level</option>
                        <option value="2">Junior Level</option>
                        <option value="3">Senior Level</option>
                    </select>
                </div>
                
                <hr>

                <div class="form-group">
                    <label for="">Username</label>
                    <input v-model="form.username" type="text" class="form-control">
                </div>

                <div class="row">
                    <div class="col-6 form-group">
                        <label for="">Password</label>
                        <input v-model="form.password" type="text" class="form-control" name="" id="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Confirm Password</label>
                        <input v-model="form.conpass" type="text" class="form-control" name="" id="">
                    </div>
                </div>
                
            </div>
            <template #modal-footer="{cancel}">
                    <b-button @click="cancel()"  size="sm" variant="success">
                        Add Info
                    </b-button>
            </template>
        </b-modal>

        <b-modal id="gov-id">
            <div class="form-group">
                <label for="">SSS Number</label>
                <input type="text" v-model="form.sss" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Pagibig Number</label>
                <input type="text" v-model="form.pagibig" class="form-control">
            </div>
            <div class="form-group">
                <label for="">TIN Number</label>
                <input type="text" v-model="form.tin" class="form-control">
            </div>
            <div class="form-group">
                <label for="">PhilHealth Number</label>
                <input type="text" v-model="form.philhealth" class="form-control">
            </div>
            <template #modal-footer="{cancel}">
                    <b-button @click="cancel()"  size="sm" variant="success">
                        Add Info
                    </b-button>
            </template>
        </b-modal>

        <b-modal id="contacts">
            <div class="form-group">
                <label for="">Contact</label>
                <input v-model="form.contact_in" type="text" class="form-control">
            </div>
            
            <template #modal-footer="{}">
                    <b-button @click="addContact()"  size="sm" variant="success">
                        Add Info
                    </b-button>
            </template>
        </b-modal>

        <b-modal id="emails">
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" v-model="form.email_in" class="form-control">
            </div>
            
            <template #modal-footer="{}">
                    <b-button @click="addEmail()"  size="sm" variant="success">
                        Add Info
                    </b-button>
            </template>
        </b-modal>

        <b-modal id="languages">
            <div class="row">
                <div class="form-group col-6">
                    <label for="">Language</label>
                    <input v-model="form.lang" type="text" class="form-control">
                </div>
                <div class="form-group col-6">
                    <label for="">Level</label>
                    <select v-model="form.lang_level" class="form-control">
                        <option value="good">Good</option>
                        <option value="fluent">Fluent</option>
                    </select>
                </div>
            </div>
            
            <template #modal-footer="{}">
                    <b-button @click="addLanguage()"  size="sm" variant="success">
                        Add Info
                    </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
export default {
    data(){
        return{
            form:{
                    fname:null,
                    lname:null,
                    bday:null,
                    username:null,
                    password:null,
                    level:null,
                    address:null,
                    sss:null,
                    pagibig:null,
                    philhealth:null,
                    tin:null,
                    description:null,
                    contacts:[],
                    emails:[],
                    langauge:[],
                    education:[],
                },
            success:false
        }
    },
    methods:{
            addContact(){
                this.form.contacts.push(this.form.contact_in)
                this.form.contact_in = "";
                this.$bvModal.hide('contacts');
            },
            addEmail(){
                this.form.emails.push(this.form.email_in);
                this.form.email_in = "";
                this.$bvModal.hide('emails');
            },
            addLanguage() {
                const lang = {
                    name: this.form.lang,
                    level: this.form.lang_level
                }
                this.form.langauge.push(lang);
                this.$bvModal.hide('languages');
            },
            register(){
                const vm = this;
                axios.post('/handleRegisterCoordinator', this.form)
                .then(function (response) {
                    console.log(response.data);
                })
                .catch(function (error) {
                    console.log(error)
                });
            }
    }
    
}
</script>
<style>

</style>