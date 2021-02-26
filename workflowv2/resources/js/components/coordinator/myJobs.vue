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
                        <td class="text-center" v-if="eventJob.length == 0" colspan="100">No Job Invites</td>
                    </tr>
                    <tr v-for="(job, index) in eventJob" :key="index">
                        <td>{{job.title}}</td>
                        <td>{{job.owner}}</td>
                        <td>
                            <a :href="'/coordinator/room?id=' + job.id" class="btn btn-primary">Go to room</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props:['jobs'],
    data(){
        return{
            eventJob:this.jobs
        }
    }
    
}
</script>
<style>

</style>