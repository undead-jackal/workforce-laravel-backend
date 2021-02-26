<template>
    <div>
        <b-modal id="set_sched">
            <template #modal-header="{ close }">
                <h5>Set Interview Schedule</h5>
                <b-button size="sm" variant="outline-danger" @click="close()">
                        &times;
                </b-button>    
            </template>
            <div>

                <VueCtkDateTimePicker :label="'Set Interview for ' + interview.name" v-model="interview.sched" />

                <div class="form-group">
                    <label for="">Reminders</label>
                    <textarea  v-model="interview.reminder" class="form-control" name="" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <template #modal-footer="{}">
                    <b-button  size="sm" variant="warning">
                        Interview Now
                    </b-button>
                    <b-button @click="setInterview"  size="sm" variant="success">
                        Set Interview
                    </b-button>
                    <b-button size="sm" variant="danger"  >
                        Cancel
                    </b-button>
            </template>
        </b-modal>
        <div class="row justify-content-center jobSingle">
            <div class="col-7 m-2 card">
                <div class="card-header">
                    <h5>{{dataJob.title}}</h5>
                    <a :href="'/employer/room?id='+dataJob.id" class="btn btn-sm btn-primary float-right">Go to Room</a>
                </div>
                <div class="card-body">
                    <h5>Description</h5>
                    <p>
                        {{dataJob.description}}
                    </p>
                    <h5>Requirements</h5>
                    <p>
                        {{dataJob.requirements}}
                    </p>
                    <h5>Skills</h5>
                        <div v-for="(skills,index) in JSON.parse(dataJob.skills)" :key="index">
                            <span class="badge badge-success">{{skills.name}}</span>
                            <span>Rating {{skills.rating}}</span>
                        </div>
                    
                </div>
            </div>
            <div class="col-4 m-2 card">
                <div class="card-header">
                    Applicants
                </div>
                <div class="card-body">
                    <div v-for="(appI) in dataApplicantsInvites" :key="appI.id">
                        <strong>{{appI.fname}} {{appI.lname}}</strong>
                        <button @click="setSched(appI.fname+' '+appI.lname, appI.invitee_id,appI.job,appI.id,'invite')" class="btn btn-sm btn-primary float-right">Set Interview</button>
                        <br>
                        <span class="badge badge-success">Freelancer</span>
                        <span class="badge badge-info">Invitation</span>
                        <hr>
                    </div>
                    <div v-for="(appPr,index) in dataApplicantsProposal" :key="index">
                        <strong>{{appPr.fname}} {{appPr.lname}}</strong>
                        <button @click="setSched(appPr.fname+' '+appPr.lname, appPr.freelancer,appPr.job,appPr.id,'proposal')" class="btn btn-sm btn-primary float-right">Set Interview</button>
                        <br>
                        <span v-if="appPr.status == 4" class="badge badge-info float-right">On Interview</span>
                        <br>
                        <span class="badge badge-success">Freelancer</span>
                        <span class="badge badge-warning">Applied</span>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
export default {
    props:['job','applicants_invite','applicants_proposal'],
    components:{
        VueCtkDateTimePicker
    },
    data(){
        return{
            dataJob:this.job,
            dataApplicantsInvites:this.applicants_invite,
            dataApplicantsProposal:this.applicants_proposal,
            interview:{
                sched:null,
                reminder:null,
                name:null,
                id:null,
                job:null,
                in_id:null,
                from:null
            }
        }
    },
    methods:{
        setSched(name, id, job, in_id,from){
            this.$bvModal.show('set_sched'); 
            this.interview.name = name;
            this.interview.id=id;
            this.interview.job=job;
            this.interview.in_id=in_id;
            this.interview.from=from
        },
        setInterview(){
            var self = this;
            axios.post('/employer/setInterview',this.interview)
                .then(function (response) {
                        console.log(response.data);
                        alert("interview SET");
                    })
                .catch(function (error) {
                        console.log(error)
                    });
        }
    }
}
</script>