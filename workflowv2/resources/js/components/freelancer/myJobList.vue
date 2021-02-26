<template>
    <div class="row justify-content-center">
        <div class="col-10 card">
            <table class="table table-striped">
                <thead>
                    <th>Job Title</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(jobs, index) in my_jobs" :key="index" >
                        <td>{{jobs.title}}</td>
                        <td>{{jobs.fname}} {{jobs.lname}}</td>
                        <td> 
                            <span v-if="jobs.emp_stats == 0" class="badge badge-success">Active</span>
                            <span v-if="jobs.emp_stats == 1" class="badge badge-Warning">Done</span>               
                        </td>
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div>
        <div class="row invites_holder p-4 justify-content-center">
            <div v-for="(jobs, index) in my_jobs" :key="index" class="col-3 m-2 card">
                <div class="card-header">
                    <h5>{{jobs.title}}</h5>
                    <small>Owner: {{jobs.fname}} {{jobs.lname}}</small> 
                    <br>
                    <small>{{jobs.invited_date}}</small>
                    <span v-if="jobs.invite_stat == 1" class="badge badge-warning">Waiting for Interview</span>
                </div>
                
                <div class="card-footer p-2">
                    <button  @click="openJob(jobs.id)" class="btn btn-sm btn-invite-primary">Open Job</button>
                    <button  @click="openJob(jobs.id)" class="btn btn-sm btn-warning">Chats</button>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
export default {
    props:['jobs'],
    data(){
        return{
            my_jobs:this.jobs
        }
    }
}
</script>