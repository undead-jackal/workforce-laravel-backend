<template>
    <div class="row justify-content-center">
        <div class="col-10 card">
            <table class="table table-striped">
                <thead>
                    <th>Job Title</th>
                    <th>Owner</th>
                    <th>Application Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(invites, index) in invite" :key="index">
                        <td>{{invites.title}}</td>
                        <td>{{invites.fname}} {{invites.lname}}</td>
                        <td>                
                            <span v-if="invites.type == 0" class="badge badge-info mx-2">Invited</span>
                            <span v-else class="badge badge-info mx-2">Applied</span>
                        </td>
                        <td>
                            <span class="badge badge-primary" v-if="invites.application_stat == 0">Pending</span>
                            <span class="badge badge-success" v-if="invites.application_stat == 2">Proposal submitted</span>
                            <span class="badge badge-success" v-if="invites.application_stat == 1">Invite Accepted</span>
                            <span class="badge badge-info" v-if="invites.application_stat == 3">Interview is Set</span>
                            <span class="badge badge-warning" v-if="invites.application_stat == 4">Interview is Today</span>
                            <span class="badge badge-info" v-if="invites.application_stat == 5">On interview</span>
                            <span class="badge badge-danger" v-if="invites.application_stat == 6">Interview Canceled</span>
                            <span class="badge badge-danger" v-if="invites.application_stat == 9">Proposal Canceled</span>
                        </td>
                        <td>
                            <button @click="openJob(invites.job_id,invites.application_id,true)"  class="btn btn-primary btn-sm"> 
                                <span v-if="invites.type == 0">View Invitation</span>
                                <span v-else>View Job details</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <b-modal header-class="b-header" id="jobdets" size="lg">
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
            </div>
            <template #modal-footer="{cancel}">
                <span class="badge badge-success" v-if="modalJobDetail['status'] == 2">Proposal submitted</span>
                <span class="badge badge-success" v-if="modalJobDetail['status'] == 1">Invite Accepted</span>
                <span class="badge badge-info" v-if="modalJobDetail['status'] == 3">Interview is Set</span>
                <span class="badge badge-warning" v-if="modalJobDetail['status'] == 4">Interview is Today</span>
                <span class="badge badge-info" v-if="modalJobDetail['status'] == 5">On interview</span>
                <span class="badge badge-danger" v-if="modalJobDetail['status'] == 6">Interview Canceled</span>
                <span class="badge badge-danger" v-if="modalJobDetail['status'] == 9">Proposal Canceled</span>
                <div v-if="modalJobDetail['type'] == 1">
                    <b-button @click="cancelInterview(currentInvite)"  size="sm" variant="warning">
                            Cancel Proposal
                    </b-button> 
                </div>
                <div v-if="modalJobDetail['type'] == 0">
                    <b-button v-if="modalJobDetail['status'] == 0" @click="acceptJob(modalJobDetail['app_id'])"  size="sm" variant="success">
                            Accept
                    </b-button>
                    <b-button  size="sm" variant="warning">
                            Decline
                    </b-button> 
                </div>
                <b-button size="sm" variant="danger" @click="cancel()">
                        Cancel
                </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating';
import VueContentPlaceholders from 'vue-content-placeholders'

export default {
    props:['invites','user'],
    components: {
            StarRating
    },
    data(){
        return{
            modalJobDetail:[],
            modalSkills:[],
            currentInvite:null,
            invite:this.invites,
            is_loading:false,
            modals:{
                jobdetails:false
            },
        }
    },
    methods:{
        openJob(id,invite_id,action){
                this.currentInvite = invite_id;
                this.$bvModal.show('jobdets');
                const formdata = new FormData();
                formdata.append('id', id);
                formdata.append('from', "invite");
                this.is_loading = true;
                var self = this;
                axios.post('/freelancer/getJobDetails',formdata)
                    .then(function (response) {
                        self.modalJobDetail = response.data.data;
                        console.log(self.modalJobDetail);
                        self.modalSkills = response.data.skills;
                        self.is_loading = false;
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
        },
        acceptJob(id){
            const formdata = new FormData();
            formdata.append('job_id', id);
            formdata.append('user_id', this.user);
            formdata.append('invite_id', this.currentInvite);
            var self =this;
            axios.post('/freelancer/acceptInvite',formdata)
                .then(function (response) {
                    console.log(response.data);
                    self.invite = response.data.new_invite;
                    self.openJob(null,null,false); 
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        cancelInterview(invite_id){
            alert(invite_id)
            const formdata = new FormData();
            formdata.append('id', invite_id);
            var self =this;
            axios.post('/freelancer/cancelInvite',formdata)
                .then(function (response) {
                    console.log(response.data);
                    self.invite = response.data.new_invite;
                    self.openJob(null,null,false); 
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }
    
}
</script>