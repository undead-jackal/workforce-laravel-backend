<template>
    <div class="j-body-main">
        <div class="title-holder">
            <div class="first-col">
                <img src="/systemAssets/images/avatars/avatar2.jpg" alt="">
                <div>
                    <span class="name">ADmin admin</span><br>
                    <div class="action-btn">
                        <button @click="changeTab(0)" class="btn-post">Personal Information</button>
                        <button @click="changeTab(1)" class="btn-post">Company Profile</button>
                    </div>
                </div>
                
            </div>
            <div class="second-col">
                <!-- <div>
                    <button @click="changeTab(0)" class="btn-post">Personal Information</button>
                    <button @click="changeTab(1)" class="btn-post">Company Profile</button>
                </div> -->
            </div>
        </div>
        <div class="content-holder">
            <div class="body">
                <div v-if="tab == 0" class="personal card">
                    <div class="header">
                        <span></span>
                        <div class="filter">
                            <button class="btn btn-sm btn-success">Update Profile</button>
                        </div>
                    </div>
                    <div class="content">
                        <div>
                            <div>
                                <span class="p-header">Name</span>
                                <p>Milim Nava</p>
                            </div>
                            <div>
                                <span class="p-header"></span>
                                <p></p>
                            </div>
                        </div>
                        <div>
                            <span class="p-header">Address</span>
                            <p>temoset jura federation</p>
                        </div>
                        <div>
                            <span class="divider">Contact Information</span><br>
                            <hr><br>
                            <span class="p-header">Mobile</span>
                        </div>
                        <div class="mobile-content">
                            <span>09218124924</span>
                            <span>09218124924</span>
                        </div>
                        <div>
                            <span class="p-header">Email Address</span>
                        </div>
                        <div class="email-content">
                            <span>Enrickejanu@gmail</span>
                            <span>dawda@gmilafjdsfa</span>
                        </div>  
                    </div>
                </div>

                <div v-if="tab == 1" class="company card">
                    <div class="header">
                        <span></span>
                        <div class="filter">
                            <button class="btn btn-sm btn-success">Update Profile</button>
                        </div>
                    </div>
                    <div class="content">
                        <div class="">
                            <span class="p-header">Company Name</span>
                            <p>N/A</p>
                        </div>
                        <div>
                            <span class="p-header">Company Address</span>
                            <p>N/A</p>
                        </div>
                        <div class="">
                            <span class="p-header">Company Contact</span>
                            <p>N/A</p>
                        </div>
                    </div>
                </div>
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
            this.tab = num
        }
    }
    
}
</script>

<style scoped>
.first-col{
    flex: 0 0 70%;
    display: flex;
    align-items: center;
}
.j-body-main .title-holder .first-col .name{
    font-size:1.3rem;
    color: var(--dominant);
    font-weight: 700;
}

.j-body-main .title-holder .first-col img{
    width: 70px;
    height: 70px;
    border-radius: 100%;
    margin-right: 20px;
}

.j-body-main .title-holder .second-col{
    margin-left: auto;
    display: flex;
    padding: 1rem 0rem;
    flex-direction: row;
    flex: 0 0 65%;
    justify-content: flex-end;
}
.j-body-main .title-holder .first-col .action-btn button{
    padding: 7px 17px;
    font-size: 14px;
    border: 0;
    outline: 0px;
    background: var(--accent);
    color: var(--white);
    border-radius: 10px;
    font-weight: 600;
    margin:8px;
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

.personal,
.company{
    width: 680px;
    background-color: var(--white);
    border-radius: 15px;
}  
.header{
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    padding: 1rem;
    background-color: var(--dominant);
    display: flex;
    align-items: center;
}

.header span{
    font-size: 1rem;
    color: var(--white);
    font-weight: 600;
}

.body{
    width: 100%;
    display: flex;
    justify-content: center;
}

.p-header{
    font-size: 1rem;
    font-weight: 600;
    color:var(--accent)
}
.divider{
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dominant);
    width: 100%;
}

.personal .content,
.company .content{
    padding: 1.5rem;
}

.personal .content hr{
    border: 2px solid var(--accent);
}

.mobile-content, .email-content{
    display: flex;
    align-items: center;
    font: 15px;
    color: var(--darkgray);
}

p{
    font: 15px;
    font-weight: 600;
    color: var(--darkgray);
}

.mobile-content span,.email-content span{
    margin: 10px;
    font-weight: 600;
}
</style>