<template>
    <div class="row justify-content-center">
        <div class="col-10 card p-4">
            <div class="row">
                <div class="col-5 mb-4 form-group">
                    <label >Job Title</label>
                    <input class="form-control" v-model="form.title" type="text" >
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label>Job Description</label>
                    <vue-editor v-model="form.description" :editorToolbar="customToolbar"></vue-editor>
                </div>
            </div>
            <div class="row">
                <div class="col-3 form-group">
                    <label>Vacancy</label>
                    <input v-model="form.vacancy" class="form-control" type="text" >
                </div>
                <div class="col-3 form-group">
                    <label>Salary</label>
                    <input v-model="form.salary" class="form-control" type="text" >
                </div>
            </div>
    
            <hr class="">
            <h5 class="">About the project</h5>
    
            <div class="row mt-4">
                <div class="col">
                    <label >Job Requirements</label>
                    <vue-editor v-model="form.req" :editorToolbar="customToolbar"></vue-editor>
                </div>
            </div>

            <div class="row">
                <div class="col-3 form-group">
                    <label class="mb-2" >Level</label>
                    <select class="form-control" v-model="form.level">
                        <option value="0">No Experience</option>
                        <option value="1">Entry Level</option>
                        <option value="2">Junior Level</option>
                        <option value="3">Senior Level</option>
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label>Skills</label>
                    <multiselect v-model="form.value" tag-placeholder="Add this as new tag" placeholder="Search or add a tag" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                </div> 
                <div class="col-3 form-group">
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

            <hr class="">
            <h5 class="">Employement</h5>

            <div class="flex p-5">
                <button @click="getTableData('freelancer')" class="btn btn-primary">Invite Freelancer</button> 
                <span class="text-red-900 font-bold">- or -</span> 
                <button @click="getTableData('coordinator')" class="btn btn-primary">Hire a Coordinator</button>  
            </div>
            <div class="flex">
                <table v-if="is_freelance" class="mx-auto">
                    <thead>
                        <th class="p-4">ID</th>
                        <th class="p-4">Fullname</th>
                        <th class="p-4">Level</th>
                        <th class="p-4">Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(freelancer, index) in freelancer.table" :key="index">
                            <td class="p-4">{{freelancer.id}}</td>
                            <td class="p-4">{{freelancer.fname}} {{freelancer.lname}}</td>
                            <td class="p-4">
                                <span v-if="freelancer.level == 0" class="px-2 py-2 text-sm bg-green-300">No Experience</span>
                                <span v-if="freelancer.level == 1" class="px-2 py-2 text-sm bg-red-300">Entry Level</span>
                                <span v-if="freelancer.level == 2" class="px-2 py-2 text-sm bg-yellow-300"> Junior Level</span>
                                <span v-if="freelancer.level == 3" class="px-2 py-2 text-sm bg-yellow-300"> Senior Level</span>
                            </td>
                            <td class="p-4">
                                <button @click="showModal(freelancer.credential,'freelancer',true)" class="p-2 text-base text-white bg-red-900">View Profile</button>
                                <span v-if="hired.freelancer.includes(freelancer.credential)" class="py-2 px-2 text-sm bg-green-900 text-white">Invited</span>
                                <button @click="dontHire(freelancer.credential, 'freelancer')" v-if="hired.freelancer.includes(freelancer.credential)" class="p-2 text-base text-white bg-gray-900">Cancel Invitation</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table v-else class="mx-auto">
                    <thead>
                        <th class="p-4">ID</th>
                        <th class="p-4">Fullname</th>
                        <th class="p-4">Action</th>
                    </thead>
                    <tbody>
                        <tr v-for="(coordinator, index) in coordinator.table" :key="index">
                            <td class="p-4">{{coordinator.id}}</td>
                            <td class="p-4">{{coordinator.fname}} {{coordinator.lname}}</td>
                            <td class="p-4">
                                <button @click="showModal(coordinator.credential,'coordinator',true)" class="btn btn-primary">View Profile</button>
                                <span v-if="hired.coordinator.includes(coordinator.credential)" class="py-2 px-2 text-sm bg-green-900 text-white">Invited</span>
                                <button @click="dontHire(coordinator.credential, 'coordinator')" v-if="hired.coordinator.includes(coordinator.credential)" class="p-2 text-base text-white bg-gray-900">Cancel Invitation</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col mb-4">
                <button @click="CreateJob" class="btn btn-primary w-100">Create Job</button>                            
            </div>  
        </div>

        <div v-if="modal.freelancer" class="fixed z-20 right-0 top-0 w-full h-screen bg-red-900 bg-opacity-25">
            <div class="w-2/3 ml-auto h-screen bg-white overflow-auto">
                <div class="w-full h-auto px-5 pt-5 flex">
                    <h3 class="text-3xl mb-2 text-red-900 font-semibold">{{freelancer.modalData['fname']}} {{freelancer.modalData['lname']}}</h3>
                    <a href="" @click.prevent="showModal(null,'freelancer',false)" class="text-red-900 text-sm ml-auto">close</a>
                </div>
                <div class="px-3">
                    <span v-if="freelancer.modalData['level'] == 0" class="px-5 py-1 bg-red-900 rounded-full text-xs font-semibold text-white mx-2">No Experience</span>
                    <span v-if="freelancer.modalData['level'] == 1" class="px-5 py-1 bg-red-900 rounded-full text-xs font-semibold text-white mx-2">Entry Level</span>
                    <span v-if="freelancer.modalData['level'] == 2" class="px-5 py-1 bg-red-900 rounded-full text-xs font-semibold text-white mx-2">Junior Level</span>
                    <span v-if="freelancer.modalData['level'] == 3" class="px-5 py-1 bg-red-900 rounded-full text-xs font-semibold text-white mx-2">Senior Level</span>
                </div>                    
                <div class=" p-8">
                    <h6 class="text-xl font-semibold">About Freelancer</h6>
                    <p v-html="freelancer.modalData['description']" class="w-full text-justify py-4">
                            
                    </p>
                    <h6 class="text-xl font-semibold pt-3">Skills</h6>
                    <div class="w-full py-4 flex">
                        <span v-for="(skill,index) in JSON.parse(freelancer.modalData['skills'])" :key="index" class="px-5 py-1 bg-red-900 rounded-full font-semibold text-white mx-2">{{skill.name}} - {{skill.rating}}</span>
                    </div>
                    <h6 class="text-xl font-semibold pt-3">Phone Number</h6>
                    <div class="w-full py-4 flex">
                        <span v-for="(cont,index) in JSON.parse(freelancer.modalData['contacts'])" :key="index" class="text-base mx-2 text-red-900">{{cont}}</span>
                    </div>
                    <h6 class="text-xl font-semibold pt-3">Email Address</h6>
                    <div class="w-full py-4 flex">
                        <span v-for="(em,index) in JSON.parse(freelancer.modalData['emails'])" :key="index"  class="text-base mx-2 text-red-900">{{em}}</span>
                    </div>
                    <h6 class="text-xl font-semibold pt-3">Languages</h6>
                    <div class="w-full py-4 flex flex-col ">
                        <span class="text-base text-red-900 my-1">English- BSIT</span>
                        <span class="text-base text-red-900">English- BSIT</span>
                    </div>
                    <h6 class="text-xl font-semibold pt-3">Education</h6>
                    <div class="w-full py-4 flex">
                        <span v-if="JSON.parse(freelancer.modalData['education']).length == 0" class="text-base text-red-900">No data</span>
                        <span v-else class="text-base text-red-900">University of cebu Main Campus - BSIT</span>
                    </div>

                    <h6 class="text-xl font-semibold pt-3">Employement History</h6>
                    <div class="w-full py-4 flex">
                        <span v-if="JSON.parse(freelancer.modalData['employement']).length == 0" class="text-base text-red-900">No data</span>
                        <span v-else class="text-base text-red-900">University of cebu Main Campus - BSIT</span>
                    </div>
                    <div class="flex">
                        <button  @click="hire(freelancer.modalData['credential'],'freelancer')" class="px-5 py-2 rounded-lg ml-auto text-white text-lg font-bold bg-red-900">Invite</button>
                        <span v-if="hired.freelancer.includes(freelancer.modalData['credential'])" class="py-2 px-2 text-sm bg-green-900 text-white">Invited</span>
                        <button @click="dontHire(freelancer.modalData['credential'], 'freelancer')" v-if="hired.freelancer.includes(freelancer.modalData['credential'])" class="p-2 text-base text-white bg-gray-900">Cancel Invitation</button>
                    </div>
                </div>
            </div>
        </div>

        <b-modal header-class="b-header" id="coordinatorModal" size="lg">
            <template #modal-header="{ close }" class="">
                <h5>{{coordinator.modalData['fname']}} {{coordinator.modalData['lname']}}</h5>
                <b-button size="sm" variant="outline-danger" @click="close()">
                        &times;
                </b-button>    
            </template>
            <div v-if="is_loading">
                <div class="row">
                    <div class="col-6">
                        <content-placeholders class="p-4">
                            <content-placeholders-heading :img="true"/>
                            <content-placeholders-text :lines="3" />
                        </content-placeholders>
                    </div>
                    <div class="col-6">
                        <content-placeholders class="p-4">
                            <content-placeholders-heading :img="true"/>
                            <content-placeholders-text :lines="3" />
                        </content-placeholders>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <content-placeholders class="p-4">
                            <content-placeholders-heading :img="true"/>
                            <content-placeholders-text :lines="5" />
                        </content-placeholders>
                    </div>
                </div>
            </div>
            <div v-else class="p-3">
                <pre>
                    {{coordinator.modalData}}
                </pre>
            </div>
            <template #modal-footer="{cancel}">
                    <button @click="hire(coordinator.modalData['credential'],'coordinator')" class="btn btn-primary ">Invite</button>
                    <b-button size="sm" variant="danger" @click="cancel()">
                        Cancel
                    </b-button>
            </template>
        </b-modal>
    </div>

</template>

<script>
import Multiselect from 'vue-multiselect';
import StarRating from 'vue-star-rating';
import { VueEditor } from "vue2-editor";
import GlobalMix from "../../GlobalMix";
import VueContentPlaceholders from 'vue-content-placeholders';

    export default{
        components: {
            Multiselect,
            StarRating,
            VueEditor,
        },
        mixins:[GlobalMix],
        data(){
            return{
                customToolbar: [["bold", "italic", "underline"], [{ list: "ordered" }, { list: "bullet" }], ["image", "code-block"]],
                form:{
                    level:'',
                    title:'',
                    description:'',
                    vacant:'',
                    salary:'',
                    req:'',
                    value: [],
                },
                modal:{
                    freelancer:false
                },
                // form_error:{
                //     level:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     },
                //     title:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     },
                //     description:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     },
                //     vacant:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     },
                //     salary:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     },
                //     req:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     },
                //     value:{
                //         msg:"Must not be empty",
                //         has_error:false
                //     }
                // },
                freelancer:{
                    table:null,
                    modalData:[],
                    modalId:null,
                    modalLevel:null,
                },
                coordinator:{
                    table:null,
                    modalData:[],                    
                    modalId:null,
                },
                is_freelance:null,
                hired:{
                    freelancer:[],
                    coordinator:[]
                },
                is_loading:false
            }
        },
        mounted:function(){
            // this.test();
            // alert(this.testdata);
        },
        methods:{
            hire(id,who){
                if(who === 'freelancer'){
                    console.log(id);
                    this.hired.freelancer.push(id);
                    this.showModal(null,'freelancer',false);
                }else if(who === 'coordinator'){
                    console.log(id);
                    this.hired.coordinator.push(id);
                    this.$bvModal.hide('coordinatorModal')
                }
            },
            dontHire(id,who){
                if (who === 'freelancer') {
                    if (this.hired.freelancer.includes(id)) {
                        let index = this.hired.freelancer.indexOf(id);
                        this.hired.freelancer.splice(index, 1);
                    }else {
                        console.log("");
                    }
                }else if (who === 'coordinator') {
                    if (this.hired.coordinator.includes(id)) {
                        let index = this.hired.coordinator.indexOf(id);
                        this.hired.coordinator.splice(index, 1);
                    }else {
                        console.log("");
                    }
                }
            },
            addTag(newTag) {
                const tag = {
                    name: newTag,
                    code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000)),
                    rating:0
                }
                this.options.push(tag)
                this.form.value.push(tag)
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
            getTableData(tables){
                const formdata = new FormData;
                formdata.append('level',this.form.level);
                formdata.append('skill_needed',JSON.stringify(this.form.value));
                let self = this;
                if (tables == "freelancer") {
                    alert('freelancer');
                    this.is_freelance =true;
                    this.hired.coordinator = [];
                    axios.post('/employer/getAllFreelancers',formdata)
                        .then(function (response) {
                            self.freelancer.table = response.data.user;
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }else {
                    this.is_freelance =false;
                    this.hired.freelancer = [];
                    axios.post('/employer/getCoordinators',formdata)
                        .then(function (response) {
                            self.coordinator.table = response.data.user;
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }
            },
            CreateJob(){
                const formdata = new FormData;
                formdata.append('form',JSON.stringify(this.form));
                formdata.append('skill',JSON.stringify(this.form.value));
                if (this.is_freelance) {
                    alert("saved as freelancer");
                    formdata.append('is_freelancer',true);
                    formdata.append('freelancer',JSON.stringify(this.hired.freelancer));
                }else{
                    alert("saved as coordinator");
                    formdata.append('is_freelancer',false);
                    formdata.append('coordinator',JSON.stringify(this.hired.coordinator));
                }

                var to_validate={
                    level:{
                        msg:"",
                        require:true,
                    }
                }

                axios.post('/employer/createJob',formdata)
                        .then(function (response) {
                            console.log(response.data.user);
                            
                            if (response.data.status) {
                                Vue.$toast.success('Job Posted.', {
                                    position:'top-right',
                                    onDismiss:function(){
                                        window.location.href = "/employer/jobPosts"
                                    }
                                })
                            }else{
                                alert("error");
                            }
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            },
            showModal(id, modalName, action){
                if (modalName === 'freelancer') {
                    if (action) {
                        document.getElementById('body-main').classList.add("modal-open");
                        this.modal.freelancer = true;
                        alert(this.modal.freelancer);
                        var self = this;
                        const formdata = new FormData;
                        formdata.append('id',id);
                        axios.post('/employer/getDataFreelancer',formdata)
                            .then(function (response) {
                                self.freelancer.modalData = response.data.user;
                                self.freelancer.modalLevel = response.data.user.level;
                                self.freelancer.modalId = response.data.user.credential;
                            })
                            .catch(function (error) {
                                console.log(error)
                            });
                    }else{
                        document.getElementById('body-main').classList.remove("modal-open");
                        this.modal.freelancer = false;
                    }
                    
                }else if (modalName === 'coordinator'){
                    this.$bvModal.show('coordinatorModal'); 
                    var self = this;
                    const formdata = new FormData;
                    formdata.append('id',id);
                    axios.post('/employer/getDataCoordinator',formdata)
                        .then(function (response) {
                            self.coordinator.modalData = response.data.user;
                            self.coordinator.modalLevel = response.data.user.level;
                            self.coordinator.modalId = response.data.user.credential;
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }

            },
        },
    }
</script>
