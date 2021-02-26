<template>
    <div class="row">
        <div class="card col-lg-3 mx-4">
            <div class="card-header">
                <h4>Messenger</h4>
            </div>
            <div class="accordion" role="tablist">
                <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block v-b-toggle.accordion-1 variant="info">Interview</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-1" visible accordion="my0" role="tabpanel">
                        <b-card-body>
                            <b-list-group>
                                <b-list-group-item @click.prevent="openChat(null,solo_chat.key,null,solo_chat.application)" v-for="(solo_chat, index) in solo" :key="index" href="#" active class="flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{solo_chat.fname}} {{solo_chat.lname}}</h6>
                                    </div>
                                    <small>{{solo_chat.name}}</small>
                                </b-list-group-item>
                            </b-list-group>
                        </b-card-body>
                    </b-collapse>
                </b-card>
                <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <b-button block v-b-toggle.accordion-2 variant="info">Jobs</b-button>
                    </b-card-header>
                    <b-collapse id="accordion-2" visible accordion="my1" role="tabpanel">
                        <b-card-body>
                            <b-list-group>
                                <b-list-group-item @click.prevent="openChat(null,group_C.key,null,group_C.application)" v-for="(group_C, index) in group" :key="index" href="#"  class="flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{group_C.fname}} {{group_C.lname}}</h6>
                                    </div>
                                    <small>{{group_C.name}}</small>
                                </b-list-group-item>
                            </b-list-group>
                        </b-card-body>
                    </b-collapse>
                </b-card>
            </div>
        </div>
        <div class="card chat-box col-lg-7 mx-4">
            <div class="card-header">
                <h4>Chat</h4>
            </div>
            <div class="card-body " v-chat-scroll>
                <div v-for="(chat,index) in chats" :key="index">
                    <div v-if="chat.user == my_id" class="my-chat">
                        <small>You</small>
                        <div class="chat-m"><p class="p-2">{{chat.message}}</p></div>
                    </div>
                    <div v-else class="your-chat">
                        <small v-if="chat.type == 2"> {{chat.efname}} {{chat.elname}}</small>
                        <div v-if="chat.type == 2" class="chat-m"><p class="p-2">{{chat.message}}</p></div>
                        <small v-if="chat.type == 0"> {{chat.fname}} {{chat.lname}}</small>
                        <div v-if="chat.type == 0" class="chat-m"><p class="p-2">{{chat.message}}</p></div>
                        <small v-if="chat.type == 1"> {{chat.cfname}} {{chat.clname}}</small>
                        <div v-if="chat.type == 1" class="chat-m"><p class="p-2">{{chat.message}}</p></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div v-if="is_interview">
                    <a href="" @click.prevent="hire(application)" class="btn btn-primary mr-2">Hire</a>
                    <button class="btn btn-primary">View Profile</button>
                </div>
                <b-input-group class="mt-3">
                    <b-form-input v-model="message"></b-form-input>
                    <b-input-group-append>
                        <b-button @click="sendMessage" variant="primary">Send</b-button>
                    </b-input-group-append>
                </b-input-group>
            </div>
        </div>
    </div>
</template>

<script>
import db from '../../db';

export default {
    props:['id','type'],
    data(){
        return{
            group_chats:this.group,
            my_id:this.id,
            my_role:this.type,
            message:null,
            group_key:null,
            application:null,
            group:[],
            solo:[],
            chats:[],
            is_interview:false
        }
    },
    mounted:function(){  
        var self = this;
        let firebase_not = db.database().ref("workforce").orderByKey().limitToLast(1);
            firebase_not.on('value',snapshot => {
                const data = snapshot.val();
                var self = this;
                self.solo=[];
                self.group=[];
                console.log(self.solo);
                console.log(self.group);
                axios.post('/employer/floaterGetSolo')
                        .then(function (response) {
                            self.solo = response.data.solo;
                            console.log(self.solo);
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                axios.post('/employer/floaterGetGroup')
                        .then(function (response) {
                            self.group = response.data.group;
                            console.log(self.group);
                        })
                        .catch(function (error) {
                            console.log(error)
                        }); 
            })
        let firebase_cc = db.database().ref("workforce/invite_not").orderByKey().limitToLast(1);
            firebase_cc.on('value', snapshot => {
                const data = snapshot.val();
                const formdata = new FormData();
                var self = this;
                Object.keys(data).forEach(key => {
                    formdata.append('key',data[key][0].key);
                    if (self.group_key == data[key][0].key) {
                        axios.post('/employer/getChats',formdata)
                                        .then(function (response) {
                                            self.chats = response.data.chats
                                        })
                                        .catch(function (error) {
                                            console.log(error)
                                        });
                    }
                });
            });
    },
    methods:{
        openChat(name, key, stat,application){
            this.group_key =key;
            this.application = application;
            const formdata = new FormData();
            if(key.includes('interview')){
                this.is_interview = true;
            }else{
                this.is_interview = false
            }
            formdata.append('key',key);
            var self = this;
            axios.post('/employer/getChats',formdata)
                .then(function (response) {
                    self.chats = response.data.chats;
                    
                })
                .catch(function (error) {
                    console.log(error)
                });          
        },        
        sendMessage(){
            const formdata = new FormData();
            formdata.append('group',this.group_id);
            formdata.append('message', this.message);
            formdata.append('key', this.group_key);
            var self = this;
            axios.post('/employer/recordChats',formdata)
                        .then(function (response) {
                            self.message="";
                            let group_chat = db.database().ref("workforce/invite_not");
                                var updates = [
                                    {
                                        key:self.group_key,
                                    },
                                ]
                            group_chat.push(updates)
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            
        },
        hire(applicant){
            const formdata = new FormData();
            var self = this;
            formdata.append('application',applicant);
            axios.post('/employer/hire',formdata)
                        .then(function (response) {
                            let notif = db.database().ref("workforce/notify");
                                var updates = [
                                    {changes:true},
                                ];
                            notif.push(updates);
                            self.is_interview = false
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            
        },
    }
}
</script>

<style scoped>
    .chat_room{
        min-height: 500px;
        
    }
</style>