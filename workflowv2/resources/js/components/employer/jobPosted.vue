<template>
    <div class="row justify-content-center">
        <div class="col-10 card">
            <table class="table table-striped">
                <thead class="">
                    <th>ID</th>
                    <th>TItle</th>
                    <th>Owner</th>
                    <th>Appllicants</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-for="(jobs, index) in dataJob" :key="index" class="">
                        <td>{{jobs.id}}</td>
                        <td>{{jobs.title}}</td>
                        <td>{{jobs.fname}} {{jobs.lname}}</td>
                        <td>{{jobs.applicants}}</td>
                        <td><a :href="'/employer/room?id='+jobs.id" class="btn btn-sm btn-primary">View Job</a></td>
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
            dataJob:this.jobs
        }
    }
}
</script>
<style>

</style>