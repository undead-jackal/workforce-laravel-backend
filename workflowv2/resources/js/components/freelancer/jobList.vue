<template>
    <div class="row">
        <div class="card col-lg-6 mx-4">
            <div class="card-header">
                <h3>Find Job</h3>
            </div>
            <div v-for="(jobs, index) in propJobs" :key="index" class="card-body p-3">
                <div class="job-box p-3 bg-gray-300">
                    <div class="header">
                        <h5>{{jobs.title}}</h5>
                    </div>
                    <div class="body">
                        <p v-html="jobs.description" class="w-full text-justify h-1/6 clamp_work_details"></p>
                        <div class=""><i class="fas fa-users"></i> {{jobs.vacant}} Vacancy</div>
                        <div class=""><i class="fas fa-money-bill"></i> {{jobs.salary}}</div>
                    </div>
                    <div class="footer flex py-4">
                        <div class="text-right">
                            <button @click="openJob(jobs.id,true)" class="btn rounded-full bg-white">View</button>
                            <button v-b-modal.proposal @click="openApply(jobs.id)" class="btn round-lg bg-white">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mx-4">
            <div class="row">
                <div class="card col-12 ">
                    <div class="card-header">
                        <h3>Application</h3>
                    </div>
                    <div class="card-body p-4">
                        <ul id="propos" class="list-unstyled">
                            <li> - Proposal Submitted</li>
                            <li> - Job Invitation Recieve</li>
                            <li> - Interviews</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="card col-12 ">
                    <div class="card-header">
                        <h3>My Jobs</h3>
                    </div>
                    <div class="card-body p-4">
                        <ul id="propos" class="list-unstyled">
                            <li> - Active</li>
                            <li> - Finished</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  

        <b-modal header-class="b-header" id="job_detail" size="lg">
            <template #modal-header="{ close }" class="">
                <h5>{{modalJobDetail['title']}}</h5>
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
                <div class="row" >
                    <div class="col-6">
                        <i class="fas fa-users"></i> &nbsp;{{modalJobDetail['vacant']}} Vacant
                        <br>
                        <i class="fas fa-money-bill"></i>&nbsp; {{modalJobDetail['salary']}}
                        <br>
                        
                    </div>
                    <div class="col-6">
                        <i class="fas fa-user"></i> &nbsp; {{modalJobDetail['fname']}} {{modalJobDetail['lname']}}
                        <br>
                        <i class="fas fa-calendar-alt"></i> &nbsp; {{modalJobDetail['created_at']}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 pt-3 ">
                        <h6>Required Level</h6>
                        <span v-if="modalJobDetail['level'] == 0" class="badge badge-secondary">No Experience</span>
                        <span v-if="modalJobDetail['level'] == 1" class="badge badge-info">Entry Level</span>
                        <span v-if="modalJobDetail['level'] == 2" class="badge badge-danger">Junior Level</span>
                        <span v-if="modalJobDetail['level'] == 3" class="badge badge-primary">Senior Level</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-3">
                        <h6>Description</h6>
                        <p v-html="modalJobDetail['description']"></p>
                        <hr>
                        <h6>Requirements</h6>
                        <p v-html="modalJobDetail['requirements']" class=""></p>
                    </div>
                </div>
                <div class="col-12">
                    <h6>Skills Required</h6>
                    <span v-for="(modalSkills, index) in modalSkills" :key="index" class="badge badge-primary">{{modalSkills.name}} - {{modalSkills.rating}}</span>
                </div>
                <div class="col-12 py-4">
                    <h6>Proposal</h6>
                    <vue-editor v-model="proposal" :editorToolbar="customToolbar"></vue-editor>
                </div>
            </div>
            <template #modal-footer="{cancel}">
                    <span v-if="modalJobDetail['proposal_status'] ==0" class="badge badge-success">Proposal Submitted</span>
                    <span v-else-if="modalJobDetail['invite_status'] == 1" class="badge badge-warning">Waiting for Interview</span>
                    <span v-else-if="modalJobDetail['invite_status'] == 3" class="badge badge-danger">Canceled</span>
                    <b-button @click="openSchedule(modalJobDetail['id'],true)" v-else-if="modalJobDetail['proposal_status'] == 4" size="sm" variant="success" >View Interview Schedule</b-button>

                    <div v-else>
                        <b-button @click="submitProposal"  size="sm" variant="success">
                            SubmitProposal
                        </b-button>
                    </div>
                    <b-button size="sm" variant="danger" @click="cancel()">
                        Cancel
                    </b-button>
            </template>
        </b-modal>

        <b-modal header-class="b-header" id="proposal" size="lg">
            <template #modal-header="{ close }" class="">
                <h5>{{modalJobDetail['title']}}</h5>
                <b-button size="sm" variant="outline-danger" @click="close()">
                        &times;
                </b-button>    
            </template>
            <div class="p-4">
                <h6>Proposal</h6>
                <vue-editor v-model="proposal" :editorToolbar="customToolbar"></vue-editor>
            </div>
            <template #modal-footer="{cancel}">
                    <b-button @click="submitProposal" size="sm" variant="success" >Submit Proposal</b-button>
                    <b-button size="sm" variant="danger" @click="cancel()">
                        Cancel
                    </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating';
import VueContentPlaceholders from 'vue-content-placeholders';
import { VueEditor } from "vue2-editor";


export default {
    props:['jobs'],
    components:{
        StarRating,
        VueEditor
    },
    data(){
        return{
            customToolbar: [["bold", "italic", "underline"], [{ list: "ordered" }, { list: "bullet" }], ["image", "code-block"]],
            modalJobDetail:[],
            propJobs:this.jobs,
            modalSkills:[],
            is_loading:false,
            proposal:null,
            job_proposal_id:null,
            interview:{
                reminder:null,
                date:null,
            },
            modals:{
                jobdetails:false
            },
            showProposal:false
        }
    },
    methods:{
        openJob(id ,action){
            this.$bvModal.show('job_detail');
            this.job_proposal_id= id;
            const formdata = new FormData();
            formdata.append('id', id);
            formdata.append('no_invite', true);
            this.is_loading = true;
            var self = this;
                axios.post('/freelancer/getJobDetails',formdata)
                    .then(function (response) {
                        self.modalJobDetail = response.data.data;
                        self.modalSkills = response.data.skills
                        self.is_loading = false;
                        console.log(self.propJobs);
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            
        },
        submitProposal(){
            const formdata = new FormData();
            formdata.append('proposal', this.proposal);
            formdata.append('job', this.job_proposal_id);
            var self = this;
            axios.post('/freelancer/submitProposal',formdata)
                .then(function (response) {
                    console.log(response.data);
                    self.propJobs = response.data.new_jobs;
                    self.proposal = null;
                    self.$bvModal.hide('job_detail');
                    self.$bvModal.hide('proposal');

                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        openApply(job_id){
            this.job_proposal_id= job_id;
        },
        openSchedule(job_id, will_open){
            this.is_loading = true;
            if (will_open) {
                this.$bvModal.show('sched_modal'); 
                this.$bvModal.hide('job_detail');
                const formdata = new FormData();
                formdata.append('job', job_id);
                var self = this;
                axios.post('/freelancer/getInterviewSched',formdata)
                .then(function (response) {
                    console.log(response.data);
                    self.interview.date = response.data.date;
                    self.interview.reminder = response.data.reminder;
                    self.is_loading = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
            }else{
                this.is_loading = false;
                this.$bvModal.show('job_detail'); 
                this.$bvModal.hide('sched_modal'); 
            }
        }

    }

}
</script>
<style>
.card{
    padding: 0px;
}
.job_list .card-header{
    background: #3259CA;
    color: #fff;
}
.b-header{
    background: #3259CA!important;
    color: #fff!important;
}
</style>