<template>
    <div class="body">
        <div class="applicant-div card">
            <div class="img-holder mx-3">
                <img src="/systemAssets/images/avatars/avatar1.jpg" alt="">
            </div>
            <div class="mx-2" >
                <span class="appli-name">Jane Doe</span><br>
                <span class="badge badge-info my-2">ENTRY LEVEL</span><br>
                <button type="button" @click="openModal('showProfile')"  class="btn-view">View Profile</button>
            </div>
        </div>  
        <div class="applicant-div card">
            <div class="img-holder mx-3">
                <img src="/systemAssets/images/avatars/avatar1.jpg" alt="">
            </div>
            <div class="mx-2" >
                <span class="appli-name">Jane Doe</span><br>
                <span class="badge badge-info my-2">ENTRY LEVEL</span><br>
                <button type="button"  class="btn-view">View Profile</button>
            </div>
        </div>   
        <div class="applicant-div card">
            <div class="img-holder mx-3">
                <img src="/systemAssets/images/avatars/avatar1.jpg" alt="">
            </div>
            <div class="mx-2" >
                <span class="appli-name">Jane Doe</span><br>
                <span class="badge badge-info my-2">ENTRY LEVEL</span><br>
                <button type="button" class="btn-view">View Profile</button>
            </div>
        </div>  <div class="applicant-div card">
            <div class="img-holder mx-3">
                <img src="/systemAssets/images/avatars/avatar1.jpg" alt="">
            </div>
            <div class="mx-2" >
                <span class="appli-name">Jane Doe</span><br>
                <span class="badge badge-info my-2">ENTRY LEVEL</span><br>
                <button type="button" class="btn-view">View Profile</button>
            </div>
        </div>  <div class="applicant-div card">
            <div class="img-holder mx-3">
                <img src="/systemAssets/images/avatars/avatar1.jpg" alt="">
            </div>
            <div class="mx-2" >
                <span class="appli-name">Jane Doe</span><br>
                <span class="badge badge-info my-2">ENTRY LEVEL</span><br>
                <button type="button" class="btn-view">View Profile</button>
            </div>
        </div> 


        <b-modal id="showProfile" size="lg">
            <template #modal-header="{ close }">
            <!-- Emulate built in modal header close button action -->
                <div class="profile-holder">
                    <img src="/systemAssets/images/avatars/avatar1.jpg" alt="">
                    <div class="profile-info-1">
                        <span class="profile-name">Jane Doe</span><br>
                        <div class="profile-options">
                            <button @click="changeTab(0)" class="btn btn-info btn-sm">Proposal</button>
                            <button @click="changeTab(1)" class="btn btn-info btn-sm">Personal</button>
                            <button @click="changeTab(2)" class="btn btn-info btn-sm">Work History</button>
                            <button @click="changeTab(3)" class="btn btn-info btn-sm">Employee</button>
                        </div>
                    </div>
                </div>
                <b-button size="sm" variant="outline-danger" @click="close()">
                    Close Modal
                </b-button>
            </template>

            <template>
                <div class="profile-info-2">
                    <div v-if="profTab == 0" class="proposal">
                        <span class="p-r-title">Proposal</span>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores illo porro corrupti ut, esse repellat dolore rem, ipsum obcaecati quasi ullam velit nihil aut consequatur? Accusantium iure eligendi error vitae. Lorem ipsum dolor sit amet consectetur adipisicing elit. At, labore odio? Illum accusantium provident delectus magni, pariatur, ex earum quis, atque animi quaerat quae commodi fugiat eaque exercitationem vero quo.</p>
                    </div>
                    <div v-if="profTab == 1" class="personal">
                        <div class="f-r">
                            <div class="f-col">
                                <span>First Name</span>
                                <p>Jane</p>
                            </div>
                            <div class="f-col">
                                <span>Last Name</span>
                                <p>Doe </p>
                            </div>
                            <div class="f-col">
                                <span>Birthday</span>
                                <p>Jan 31,1998</p>
                            </div>
                            <div class="f-col">
                                <span>Age</span>
                                <p>23 </p>
                            </div>
                        </div>
                        <div class="f-r">
                            <div class="f-col">
                                <span>Country</span>
                                <p>Philippines </p>
                            </div>
                            <div class="f-col">
                                <span>City</span>
                                <p>Cebu </p>
                            </div>
                            <div class="f-col">
                                <span>Zip</span>
                                <p>6000 </p>
                            </div>
                        </div>
                        <div class="f-r">
                            <div class="f-col">
                                <span>Contact Number</span>
                                <p>09956371866 <br> 09201216188</p>
                            </div>
                            <div class="f-col">
                                <span>Email</span>
                                <p>enrickemorales@gmail.com <br> enrickejnu@gmail.com</p>
                            </div>
                        </div>
                        <div class="f-r-2">
                            <div class="f-col">
                                <span class="tit">Educations</span><br>
                                <div class="content">
                                    <span>Univeristy of Cebu Main</span>
                                    <p>Bachelor of Science in Information Technology</p>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div v-if="profTab==2">
                        <div class="rating-holder">
                            <div class="number-rating">
                                <span class="inner-title">Work Completed</span><br>
                                <span class="inner-number">40</span>
                            </div>
                            <div class="number-rating">
                                <span class="inner-title">Total Rating</span><br>
                                <span class="inner-number">8/10</span>
                            </div>
                        </div>

                        <div class="work-lis">
                            <ul class="list-unstyled">
                                <li class="workItem">
                                    <span class="work-title">Php laravel vue</span><br>
                                    <span class="work-rating">Rating 10/10</span>
                                </li>
                                <li class="workItem">
                                    <span class="work-title">Php laravel vue</span><br>
                                    <span class="work-rating">Rating 10/10</span>
                                </li>
                                <li class="workItem">
                                    <span class="work-title">Php laravel vue</span><br>
                                    <span class="work-rating">Rating 10/10</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div v-if="profTab == 3">
                        <div class="employment">
                            <ul>
                                <li>
                                    History 1
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>

            <template #modal-footer="{ ok, cancel, hide }">
                <b>Custom Footer</b>
                <!-- Emulate built in modal footer ok and cancel button actions -->
                <b-button size="sm" variant="success" @click="ok()">
                    OK
                </b-button>
                <b-button size="sm" variant="danger" @click="cancel()">
                    Cancel
                </b-button>
                <!-- Button with custom close trigger value -->
                <b-button size="sm" variant="outline-secondary" @click="hide('forget')">
                    Forget it
            </b-button>
            </template>
        </b-modal>  
    </div>
</template>
<script>
import GlobalFunctions from '../../GlobalFunctions';
import jModal from '../reusable/jModal.vue';

export default {
    components: { jModal },
    data(){
        return {
            profTab:0,
            page:0,
        }
    },
    // mixins:[GlobalFunctions],
    methods: {
        changePage(num){
            this.page = num;
        },
        changeTab(num){
            this.profTab = num;
        },
        openModal(id) {
            this.$bvModal.show(id)
        }    
    }
}
</script>

<style scoped>
.body{
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    width: 100%;
    align-items: center;
    justify-content: center;

}
.applicant-div{
    flex: 0 0 265px;
    background-color: var(--white);
    padding: 10px;
    display: flex;
    flex-direction: row;
    align-items: center;
    border-radius: 15px;
    margin:0.7rem;
}

.img-holder img{
    width: 75px;
    height: 75px;
    border-radius: 100%;
}

.badge{
    font-size: 14px;
    padding: 4px 16px;
}

.appli-name{
    font-size: 1rem;
    font-weight: 600;
}

.btn-view{
    width: 100%;
    padding: 5px;
    font-size: 0.9rem;
    background: var(--accent);
    color: var(--white);
    border: 0;
    border-radius: 15px;
}

/* MOdal */
.profile-holder{
    display: flex;
}
.profile-holder img{
    width: 65px;
    height: 65px;
    border-radius: 100%;
}

.profile-holder .profile-name{
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--accent);
}

.profile-holder .profile-options{
    padding: 5px 0px;
}

.profile-holder .profile-info-1{
    padding: 6px;
    margin-left: 20px;
}

.profile-info-2{
    padding: 1rem;
}

.p-r-title{
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--accent);
}

.personal .f-r{
    display: flex;
}

.personal .f-r .f-col{
    flex: 0 0 20%;
    margin-bottom: 10px;
}

.personal .f-r .f-col span{
    font-size: 14px;
    color: var(--accent);
}

.personal .f-r .f-col p{
    font-size: 18px;
    color: var(--darkgray);
    font-weight: 600;
}
.personal .f-r-2 .f-col .tit{
    font-size: 14px;
    color: var(--accent);
}

.personal .f-r-2 .f-col .content span{
    font-size: 16px;
    color: var(--darkgray);
    font-weight: 600;
}

.personal .f-r-2 .f-col .content p{
    font-size: 16px;
    color: var(--darkgray);
}


.rating-holder{
    display: flex;
    align-items: center;
}

.rating-holder .number-rating{
    flex:0 0 200px;
    margin:15px;
    background-color: var(--dominant);
    padding: 20px;
    border-radius: 10px;
    color: var(--white);
    font-weight: 600;
}

.work-title{
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--accent);
}




</style>