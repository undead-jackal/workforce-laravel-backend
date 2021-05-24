<template>
    <div class="j-body-main">
        <div class="title-holder">
            <div class="first-col">
                <span>Web Developer PHP Laravel-Vue</span>
                <p>You can manage this jobs applicants, set interviews and rate&pay your employee after</p>
            </div>
            <div class="second-col">
                <div>
                    <button @click="changeTab(0)" class="btn-post">Job Details</button>
                    <button @click="changeTab(1)" class="btn-post">Applicants</button>
                    <button @click="changeTab(2)" class="btn-post">Interviews</button>
                    <button @click="changeTab(3)" class="btn-post">Employee</button>
                </div>
                
            </div>
        </div>
        <div class="content-holder">
            <manage-jobdetail-vue v-if="tab == 0"></manage-jobdetail-vue>
            <manage-applicants-vue v-if="tab == 1"></manage-applicants-vue>
            <manage-interview v-if="tab == 2"></manage-interview>
            <manage-employee v-if="tab == 3"></manage-employee>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            tab:0
        }
    },
    methods:{
        changeTab(num){
            this.tab = num
        }
    }
    
}
</script>

<style scoped>
.first-col{
    flex: 0 0 35%;
}
.j-body-main .title-holder .first-col span{
    font-size:1.3rem;
    color: var(--accent);
    font-weight: 700;
}

.j-body-main .title-holder .first-col p{
    font-size:1rem;
    color: var(--darkgray);
    font-weight: 400;
}
.j-body-main .title-holder .second-col{
    margin-left: auto;
    display: flex;
    padding: 1rem 0rem;
    flex-direction: row;
    flex: 0 0 65%;
    justify-content: flex-end;
}
.j-body-main .title-holder .second-col button{
    padding: 7px 24px;
    font-size: 1rem;
    border: 0;
    outline: 0px;
    background: var(--accent);
    color: var(--white);
    border-radius: 10px;
    font-weight: 600;
    margin:0px 10px;
}

.j-body-main .title-holder{
    display: flex;
    background-color:var(--white);
    padding: 20px;
    position: sticky;
    top: 103px;
    z-index: 1;
}

.j-body-main .content-holder{
    padding: 2rem;
    display: flex;
    flex-wrap: wrap;
}
</style>