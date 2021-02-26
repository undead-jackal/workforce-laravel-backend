<template>
    <div v-if="sucess" class="w-3/5 shadow-lg mx-auto h-3/4 bg-white">
        <div class="text-8xl p-4 text-center text-red-900">
            <h4 class=" mr-auto">REGISTERED !!!</h4>
            <span class="p-2"><i class="fa fa-check-circle"></i></span>
            <br>
            <a href="login" class="px-5 py-2 text-white text-lg font-bold bg-red-900">Login Now</a>
        </div>
    </div>
    <div v-else class="w-3/5 shadow-lg mx-auto h-3/4 bg-white">
        <div class=" p-4 text-center text-red-900">
            <h4 class="text-2xl mr-auto">Register</h4>
            <span class="text-sm p-2">Be a freelancers</span>
        </div>
        <div class="p-4">
            <h5 class="text-red-900">Personal Information</h5>
            <div class="grid grid-cols-3 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Firstname <span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.fname" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Lastname <span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.lname" class="border py-2 px-3 text-grey-darkest" type="text" > 
                </div> 
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Level <span class="text-green-900 text-lg font-bold">*</span></label>
                    <select v-model="form.level" class="border py-2 px-3 text-grey-darkest">
                        <option value="0">No Experience</option>
                        <option value="1">Entry Level</option>
                        <option value="2">Junior Level</option>
                        <option value="3">Senior Level</option>
                    </select>
                </div> 
            </div>
            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Address  <span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.address" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>

            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">Government Id</h5>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >SSS Number</label>
                    <input v-model="form.sss" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Philhealth</label>
                    <input v-model="form.philhealth" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>
            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Pagibig</label>
                    <input v-model="form.pagibig" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Tin</label>
                    <input v-model="form.tin" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>

            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">Contact Information</h5>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Phone Number <span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.contact_in" class="border py-2 px-3 text-grey-darkest" type="text" >
                    <a href="" @click.prevent="addContact" class="text-red-900 m-auto font-semibold">Add</a>
                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Email Address <span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.email_in" class="border py-2 px-3 text-grey-darkest" type="text" >
                    <a href=""  @click.prevent="addEmail" class="text-red-900 m-auto font-semibold">Add</a>
                </div>
            </div>
            <div class="grid grid-cols-2 w-full">
                <div class="flex flex-wrap p-4 mb-4 w-full">
                    <span v-for="(contact,index) in form.contacts" :key="index" class="bg-red-900 mx-1 py-2 px-3 h-8 w-auto text-center rounded-full text-white text-xs">{{contact}} <i class="fas fa-times bg-white-900  rounded-full"></i></span>
                </div>
                <div class="flex flex-wrap p-4 mb-4 w-full">
                    <span v-for="(email,index) in form.emails" :key="index" class="bg-red-900 mx-1 my-1 py-2 px-3 h-8 w-auto text-center rounded-full text-white text-xs">{{email}}<i class="fas fa-times bg-white-900  rounded-full"></i></span>
                </div>
            </div>

            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">Education</h5>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col  border-r-2 border-red-900">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >School Name</label>
                    <input v-model="form.sname" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
                <div class="flex p-4 flex-col ">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Language<span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.lang" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>
            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4 border-r-2 border-red-900">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Course</label>
                    <input v-model="form.course" class="border py-2 px-3 text-grey-darkest" type="text" >
                    <a href="" @click.prevent="addEducation" class="text-red-900 m-auto font-semibold">Add</a>

                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Level<span class="text-green-900 text-lg font-bold">*</span></label>
                    <select v-model="form.lang_level" class="border py-2 px-3 text-grey-darkest">
                        <option value="Fluent">Fluent</option>
                        <option value="Conversational">Conversational</option>
                    </select>
                    <a href="" @click.prevent="addLanguage" class="text-red-900 m-auto font-semibold">Add</a>

                </div>
            </div>
            <div class="grid grid-cols-2 content-center w-full">
                <div class="flex flex-wrap p-4 mb-4 w-full">
                    <span v-for="(ed, index) in form.education" :key="index" class="bg-red-900 mx-1 my-2 py-2 px-4 h-8 w-auto text-center rounded-full text-white text-xs"> {{ed.name}} - {{ed.course}} <i class="fas fa-times bg-white-900  rounded-full"></i></span>
                </div>
                <div class="flex flex-wrap p-4 mb-4 w-full">
                    <span v-for="(language, index) in form.langauge" :key="index" class="bg-red-900 mx-1 my-2 py-2 px-4 h-8 w-auto text-center rounded-full text-white text-xs">{{language.name}}  - {{language.level}} <i class="fas fa-times bg-white-900  rounded-full"></i></span>
                </div>
            </div>
                            
            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">About what you do</h5>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >What job do you do<span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.profession" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>

            <div class="grid grid-cols-1 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Say something about yourself<span class="text-green-900 text-lg font-bold">*</span></label>
                    <vue-editor v-model="form.description" :editorToolbar="customToolbar"></vue-editor>
                </div>
            </div>

            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">Skills</h5>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Skills<span class="text-green-900 text-lg font-bold">*</span></label>
                    <multiselect v-model="form.value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTags"></multiselect>
                </div>
                <div class="flex p-4 flex-wrap mb-4">
                    <div v-for="(skill,index) in form.value" :key="index" class="mx-3">
                        <div class="grid grid-col-2">
                            <div class="">
                                <h6>{{skill.name}}</h6>
                            </div>
                            <div class="">
                                <star-rating @current-rating="setCurrentSelectedRating" @click="saveRating(skill.name)" @rating-selected="saveRating(skill.name)" :star-size="20" active-color="#9c0000"></star-rating>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">Employement History</h5>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Company</label>
                    <input v-model="form.wcom" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Profession</label>
                    <input v-model="form.wpos" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>
            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Duration</label>
                    <input v-model="form.wexp" class="border py-2 px-3 text-grey-darkest" type="text" >
                    <a href="" @click.prevent="addEHistory" class="text-red-900 m-auto font-semibold">Add</a>
                </div>
            </div>
            <div class="grid grid-cols-1 content-center w-full">
                <div class="flex flex-wrap p-4 mb-4 w-full">
                    <span v-for="(emp, index) in form.employement" :key="index" class="bg-red-900 mx-1 py-2 px-4 h-8 w-auto text-center rounded-full text-white text-xs">{{emp.company}} - {{emp.position}} - {{emp.duration}} <i class="fas fa-times bg-white-900  rounded-full"></i></span>
                </div>
            </div>

            <hr class="h-0.5 bg-red-900">
            <h5 class="text-red-900 mt-3">Your Credentials</h5>
                            
            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Username<span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.username" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
            </div>

            <div class="grid grid-cols-2 w-full">
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Password<span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.password" class="border py-2 px-3 text-grey-darkest" type="text" >
                </div>
                <div class="flex p-4 flex-col mb-4">
                    <label class="mb-2 uppercase font-bold text-sm text-red-900" >Confirm Password<span class="text-green-900 text-lg font-bold">*</span></label>
                    <input v-model="form.con_pass" class="border py-2 px-3 text-grey-darkest" type="text" > 
                </div> 
            </div>

            <br>
            <div class="flex flex-col mb-4">
                <button @click="register" class="px-5 py-2 text-white text-lg font-bold bg-red-900">Register</button>                            
            </div>   
        </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect';
import StarRating from 'vue-star-rating';
import { VueEditor } from "vue2-editor";

    export default{
        components: {
            Multiselect,
            StarRating,
            VueEditor
        },
        data(){
            return{
                content: "<h1>Html For Editor</h1>",
                customToolbar: [["bold", "italic", "underline"], [{ list: "ordered" }, { list: "bullet" }], ["image", "code-block"]],
                error_trigger:{
                    fname:false,
                    lname:false,
                    username:false,
                    password:false,
                    level:false,
                    address:false,
                    profession:false,
                    description:false,
                    contacts:false,
                    emails:false,
                    langauge:false,
                    value:false
                },
                form:{
                    fname:'',
                    lname:'',
                    bday:'',
                    username:'',
                    password:'',
                    con_pass:'',
                    level:'',
                    address:'',
                    sss:'',
                    pagibig:'',
                    philhealth:'',
                    tin:'',
                    profession:'',
                    description:'',
                    contacts:[],
                    emails:[],
                    langauge:[],
                    education:[],
                    employement:[],
                    value: [],
                },
                options: [
                    { name: 'Vue.js', code: 'vu' },
                    { name: 'Javascript', code: 'js' },
                    { name: 'Open Source', code: 'os' },
                    { name: 'Laravel', code: 'la' },
                    { name: 'Codeigniter', code: 'co' },
                    { name: 'Ghost Writing', code: 'gh' },
                    { name: 'Horror Writing', code: 'ho' },
                    { name: 'Web Development', code: 'Wwe' }
                ],
                rating:null,
                sucess:false
                
            }
        },
        methods:{
            addTags(newTag) {
                const tag = {
                    name: newTag,
                    code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000)),
                    rating:0
                }
                this.options.push(tag)
                this.form.value.push(tag)
            },
            addLanguage() {
                const lang = {
                    name: this.form.lang,
                    level: this.form.lang_level
                }
                this.form.langauge.push(lang);
                this.$bvModal.hide('languages');
            },
            addEducation(){
                const ed = {
                    name: this.form.sname,
                    course: this.form.course
                }
                this.form.education.push(ed);
                this.$bvModal.hide('educations');
            },
            addEHistory(){
                const ed = {
                    company: this.form.wcom,
                    position: this.form.wpos,
                    duration:this.form.wexp
                }
                this.form.employement.push(ed);
                this.$bvModal.hide('employement');
            },
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
            saveRating(skill){
                for (var i=0; i < this.form.value.length; i++) {
                    if (this.form.value[i].name === skill) {
                        this.form.value[i].rating = this.rating;
                    }
                }
            },
            setCurrentSelectedRating(rating) {
                this.rating = rating;
            },
            
            register(){
                let no_errors = false;
                var msg="";
                for (const key in this.error_trigger) {
                    if(this.form[key].length == 0){
                        no_errors = true;
                        msg= "Fill fields with green asterisk";
                    }
                }

                if (this.form['password'] != this.form['con_pass']) {
                    no_errors = true;
                    msg = "Must match password"
                }

                if(no_errors){
                    alert(msg);
                }else{
                    const vm = this;
                    axios.post('/handleRegisterFreelance', this.form)
                    .then(function (response) {
                        console.log(response.data);
                        vm.sucess = true;
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
                }
                
            }
        }
    }

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
