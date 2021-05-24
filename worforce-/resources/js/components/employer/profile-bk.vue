<template>
    <div class="col-2nd">
        <div class="header">
            <div class="first-group">
                <span>Profile</span>
                <p>Your profile mes be complete</p>
            </div>
            <div class="second-group">
                <a href="">return</a>
            </div>
        </div>
        <div class="sub-header">
            <button class="btn-post" @click="changeTab(0)">Personal Information</button>
            <button class="btn-post" @click="changeTab(1)">Employment History</button>
            <button class="btn-post" @click="changeTab(2)">Skills</button>
            <button class="btn-post" @click="changeTab(3)">Training & Certficates</button>
            <button class="btn-post" @click="changeTab(4)">Cover Letter</button>
        </div>
        
        <div class="body">
            <div v-if="tab == 0" class="personal">
                <div class="j-row j-align-center">
                    <div class="j-col">
                        <span>First Name</span>
                        <p>Milim</p>
                    </div>
                    <div class="j-col">
                        <span>Last Name</span>
                        <p>Nava</p>
                    </div>
                </div>
                <div class="j-row j-align-center">
                    <div class="j-col-full">
                        <span>Address</span>
                        <p>Tempest Jura Federation</p>
                    </div>
                </div>
                <div>
                    <span>Languges</span>
                    <div class="j-row j-align-center">
                        <div class="language-box">
                            <span>English</span>
                            <p>Fluent</p>
                        </div>
                        <div class="language-box">
                            <span>Spanish</span>
                            <p>Fluent</p>
                        </div>
                    </div>
                </div>

                <div>
                    <span>Education</span>
                    <div class="j-row j-align-center">
                        <div class="education-box">
                            <span>University of Cebu Main</span>
                            <p>Bachelor of Science In Information Technology</p>
                        </div>
                    </div>
                </div>

                <div>
                    <span>Contact Number</span>
                    <div class="j-row j-align-center">
                        <div class="contact-box">
                            <span>Primary</span>
                            <p>09556371866</p>
                        </div>
                        <div class="contact-box">
                            <span>Primary</span>
                            <p>09556371866</p>
                        </div>
                    </div>
                </div>

                <div>
                    <span>Email address</span>
                    <div class="j-row j-align-center">
                        <div class="email-box">
                            <span>Primary</span>
                            <p>enrickejanu@gmail.com</p>
                        </div>
                        <div class="email-box">
                            <span>Primary</span>
                            <p>enrickejanu@gmail.com</p>
                        </div>
                    </div>
                </div>
                
            </div>

            <div v-if="tab == 1" class="employment">
                <div class="j-row">
                    <div class="j-col">
                        <span>Total Experience</span>
                    </div>
                    <div class="j-col text-r">
                        <p>50yrs</p>
                    </div>
                </div>
                <div class="">
                    <span>History</span>
                    <div class="j-row history">
                        <div class="details">
                            <span>Somwhere out of nowhere</span>
                            <p>Programmer</p>
                        </div>
                        <div class="dates">
                            <span>startdate</span><br>
                            <span>enddate</span>
                        </div>
                        <div class="duration">
                            <p>+ 25yrs</p>
                        </div>
                    </div>
                    <div class="j-row history">
                        <div class="details">
                            <span>Somwhere out of nowhere</span>
                            <p>Programmer</p>
                        </div>
                        <div class="dates">
                            <span>startdate</span><br>
                            <span>enddate</span>
                        </div>
                        <div class="duration">
                            <p>+ 25yrs</p>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="tab == 2" class="skills">
                <div class="j-row">
                    <div class="j-col">
                        <span>Total Skills</span>
                    </div>
                    <div class="j-col text-r">
                        <p>2</p>
                    </div>
                </div>
                <div class="">
                    <span>Skills</span>
                    <div class="j-row content">
                        <div class="skill-box">
                            <span>wordpress</span>
                            <p>Rating: 10/10</p>
                        </div>
                        <div class="skill-box">
                            <span>wordpress</span>
                            <p>Rating: 10/10</p>
                        </div>
                        <div class="skill-box">
                            <span>wordpress</span>
                            <p>Rating: 10/10</p>
                        </div>
                        <div class="skill-box">
                            <span>wordpress</span>
                            <p>Rating: 10/10</p>
                        </div>
                        <div class="skill-box">
                            <span>wordpress</span>
                            <p>Rating: 10/10</p>
                        </div>
                        <div class="skill-box">
                            <span>wordpress</span>
                            <p>Rating: 10/10</p>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="tab == 3" class="training">
                
            </div>
            <div v-if="tab == 4" class="cover">
                <span>Cover Letter</span>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel expedita nesciunt doloribus, quis, quo ipsam voluptatum corrupti deserunt excepturi facilis magni laboriosam sequi molestiae aspernatur dolore fuga in pariatur itaque! Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat maxime consequuntur magni quod sequi maiores, expedita iusto delectus dolores omnis ducimus eligendi veritatis, minus mollitia accusantium beatae! Nam, suscipit architecto!</p>
            </div>
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
            this.tab = num;
        }
    }
}
</script>
<style scoped>
    .col-2nd .header .first-group p{
        max-width: 100%!important;
    }

    .personal,
    .employment,
    .skills,
    .cover{
        padding: 45px;
        width: 60%;
        background-color: var(--white);
        border-radius: 10px;
        box-shadow: 0 0 8px 1px #b69191
    }

    .j-col{
        flex:1 0 50%;
    }

    .j-col-full{
        flex:0 0 100%;
    }

    .text-r{
        text-align: right;
    }

    .personal .language-box{
        flex:0 0 20%;
        padding: 10px;
    }

    .personal .education-box{
        width: 70%;
        padding: 15px;
    }

    .personal .contact-box{
        padding:15px;
        flex: 0 0 20%;
    }

    .personal .email-box{
        padding:15px;
        flex: 0 0 20%;
    }
    .employment .history .duration,
    .employment .history .dates,
    .employment .history .details{
        padding: 10px;
    }
    .employment .history .dates{
        margin-left: auto;
    }
    .employment .history .duration{
        align-items: center;
        display: flex;
    }

    .skills .skill-box{
        flex: 0 0 25%;
        padding: 5px;
    }

    .skills .content{
        flex-wrap: wrap!important;;
    }

    p{
        font-size: 16px;
    }
</style>