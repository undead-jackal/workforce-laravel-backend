<template>
    <div class="row justify-content-center">
        <div class="col-10 card">
            
            <table class="table table-striped">
                <thead>
                    <th>Job Title</th>
                    <th>Owner</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" v-if="m_invites.length == 0" colspan="100">No Job Invites</td>
                    </tr>
                    <tr v-for="(invites, index) in m_invites" :key="index">
                        <td>{{invites.title}}</td>
                        <td>{{invites.fname}} {{invites.lname}}</td>
                        <td>
                            <button @click="accept(invites.job,invites.id,invites.title,invites.owner)"  class="btn btn-primary btn-sm"> Accept Job</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- <b-modal header-class="b-header" id="jobdets" size="lg">
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
        </b-modal> -->
    </div>
</template>
<script>
export default {
    props:['myinvites'],
    data(){
        return{
            m_invites:this.myinvites
        }
    },
    methods:{
        accept(jobs, application,title,user){
            const formdata = new FormData();
            formdata.append('job', jobs);
            formdata.append('application', application);
            formdata.append('title',title);
            formdata.append('user',user);
            formdata.append('type',"solo");

            const vm = this;
                axios.post('/coordinator/acceptInvite', formdata)
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
