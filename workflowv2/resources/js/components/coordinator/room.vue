<template>
    <div class="row">
        <div class="card col-2 mx-auto">
            <ul class="navbar-nav">
                <li class="p-4 nav-item">
                    <a class="nav-link" @click.prevent="changeTab(0)" href="">Job Details</a>
                </li>
                <li class="p-4 nav-item">
                    <a class="nav-link" @click.prevent="changeTab(1)" href="">Interviews</a>
                </li>
                <li class="p-4 nav-item">
                    <a class="nav-link" @click.prevent="changeTab(2)" href="">Applicants</a>
                </li>
                <li class="p-4 nav-item">
                    <a class="nav-link" @click.prevent="changeTab(3)" href="">Employee</a>
                </li>
            </ul>
        </div>
        <div v-if="tab == 0" class="card col-9 mx-auto p-4">
            <div class="row">
                <div class="col-6">
                    <i class="fas fa-users"></i> &nbsp;{{jobs['vacant']}} Vacant
                    <br>
                    <i class="fas fa-money-bill"></i>&nbsp; {{jobs['salary']}}
                    <br>
                        
                </div>
                <div class="col-6">
                    <i class="fas fa-user"></i> &nbsp; {{jobs['fname']}} {{jobs['lname']}}
                    <br>
                    <i class="fas fa-calendar-alt"></i> &nbsp; {{jobs['created_at']}}
                </div>
            </div>
            <div class="row">
                <div class="col-6 pt-3 ">
                    <h6>Required Level</h6>
                    <span v-if="jobs['level'] == 0" class="badge badge-secondary">No Experience</span>
                    <span v-if="jobs['level'] == 1" class="badge badge-info">Entry Level</span>
                    <span v-if="jobs['level'] == 2" class="badge badge-danger">Junior Level</span>
                    <span v-if="jobs['level'] == 3" class="badge badge-primary">Senior Level</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 p-3">
                    <h6>Description</h6>
                    <p v-html="jobs['description']"></p>
                    <hr>
                    <h6>Requirements</h6>
                    <p v-html="jobs['requirements']" class=""></p>
                </div>
            </div>
            <div class="col-12">
                <h6>Skills Required</h6>
                <span v-for="(modalSkills, index) in JSON.parse(jobs['skills'])" :key="index" class="badge badge-primary">{{modalSkills.name}} - {{modalSkills.rating}}</span>
            </div>
        </div>
        <div v-if="tab == 1" class="card col-9 mx-auto">
            <div class="card-header">
                <h5>Interview</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-striped">
                    <thead>
                        <th>Fullname</th>
                        <th>Schedule</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" v-if="interviews.length == 0" colspan="100">No Interviews</td>
                        </tr>
                        <tr v-for="(int, index) in interviews" :key="index">
                            <td>{{int.fname}} {{int.lname}}</td>
                            <td>{{int.sched}}</td>
                            <td>
                                <button @click="hire(int.applicants,int.job, int.applicant, int.applicant_type,int.title)" v-if="int.status == 5" class="btn btn-sm btn-primary">
                                        Hire
                                </button>
                                <button v-else-if="is_time(int.sched)"  @click="startInterview(int.applicants,int.job,int.title,int.fname +' '+int.lname,int.applicant)" class="btn btn-sm btn-primary">
                                    Start Interview 
                                </button>
                                <button class="btn btn-primary">View Profile</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-if="tab == 2" class="card col-9 mx-auto">
            <div class="card-header">
                <h5>Applicants</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-striped">
                    <thead>
                        <th>Fullname</th>
                        <th>Application Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" v-if="applicants.length == 0" colspan="100">No Applicants</td>
                        </tr>
                        <tr v-for="(applicants,index) in applicants" :key="index">
                            <td>{{applicants.fname}} {{applicants.lname}}</td>
                            <td>
                                <span v-if="applicants.status == 1">Invited</span>
                                <span v-if="applicants.status == 2">Applied</span>
                            </td>
                            <td>
                                <button @click="set_scheds(applicants.app_id, applicants.fname +''+applicants.fname)" class="btn btn-primary">Set Interview</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div v-if="tab == 3" class="card col-9 mx-auto">
            <div class="card-header">
                <h5>Employees</h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-striped">
                    <thead>
                        <th>Fullname</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" v-if="employee.length == 0" colspan="100">No Employee</td>
                        </tr>
                        <tr v-for="(emp,index) in employee" :key="index">
                            <td>{{emp.fname}} {{emp.lname}}</td>
                            <td>
                                <button class="btn btn-primary">End Contract</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <b-modal id="set_sched">
            <template #modal-header="{ close }">
                <h5>Set Interview Schedule</h5>
                <b-button size="sm" variant="outline-danger" @click="close()">
                                &times;
                </b-button>    
            </template>
            <div>

                <VueCtkDateTimePicker :label="'Set Interview'" v-model="interview.sched" />

                <div class="form-group">
                    <label for="">Reminders</label>
                    <textarea  v-model="interview.reminder" class="form-control" cols="30" rows="10"></textarea>
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
    </div>
</template>
<script>
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
export default {
    props:['job_id'],
    components:{
        VueCtkDateTimePicker
    },
    data(){
        return{
            jobId:this.job_id,
            applicants:[],
            freelancers:[],
            interviews:[],
            employee:[],
            jobs:[],
            tab:0,
            interview:{
                sched:null,
                reminder:null,
                name:null,
                id:null,
            },
        }
    },
    created:function(){
        this.changeTab(0);
    },
    methods:{
        set_scheds(id, name){
            this.$bvModal.show('set_sched');
            this.interview.id = id;
            this.interview.name = name;
        },
        setInterview(){
            var self = this;
            axios.post('/coordinator/setInterview',this.interview)
                .then(function (response) {
                        console.log(response.data);
                        alert("interview SET");
                    })
                .catch(function (error) {
                        console.log(error)
                    });
            console.log(this.interview);
        },
        is_time(dated,invite,who,job){
            var date = new Date().toLocaleDateString([],{hour: '2-digit', minute:'2-digit'}).replaceAll('/','-');
            var schedule = new Date(dated).getTime()
            var tdate = new Date(date).getTime()
            console.log(tdate+" "+schedule);
            console.log(date+" "+dated);
            const formdata = new FormData();
            formdata.append('interview_id',invite);
            formdata.append('interview_person',who);
            formdata.append('interview_job',job);

            if (tdate >= schedule) {
                axios.post('/employer/updateInvite',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.jobs = response.data.job
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                return true;       
            }else{
                return false;
            }
        },
        startInterview(app_id,id,job,name,user){
            const formdata = new FormData();
            var self = this;
            formdata.append('application',app_id);
            formdata.append('job',id);
            formdata.append('title',job+" - "+name);
            formdata.append('user',user);
            formdata.append('type',"solo");

            axios.post('/coordinator/updateInterview',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.interviews = response.data.new_interview
                            let group_chat = db.database().ref("workforce/invite_not");
                            const updates = [
                                {
                                    key: response.data.key,
                                },
                            ]
                            group_chat.push(updates)
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
        },
        invite(id){
            const formdata = new FormData();
            var self = this;
            formdata.append('job',this.jobId);
            formdata.append('id',id);
            axios.post('/coordinator/Invite',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.applicants = response.data.applicant
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
        },
        changeTab(tab){
            this.tab = tab;
            const formdata = new FormData();
            var self = this;
            if (self.tab == 0) {
                formdata.append('job',this.jobId);
                axios.post('/coordinator/getJobDetail',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.jobs = response.data.job
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
            if (self.tab == 1) {
                formdata.append('job',this.jobId);
                axios.post('/coordinator/getInterviews',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.interviews = response.data.interviews
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
            if(tab == 2){
                formdata.append('job',this.jobId);
                axios.post('/coordinator/getApplicant',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.applicants = response.data.applicant
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
            if(tab == 3){
                formdata.append('job',this.jobId);
                axios.post('/coordinator/getEmployee',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.employee = response.data.employee
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
            if(tab == 4) {
                // formdata.append('job',this.jobId);
                // axios.post('/coordinator/getFreelancer',formdata)
                //         .then(function (response) {
                //             console.log(response.data);
                //             self.freelancers = response.data.freelancers
                //         })
                //         .catch(function (error) {
                //             console.log(error)
                //         });
            }
        }
    }
}
</script>
<style >

</style>