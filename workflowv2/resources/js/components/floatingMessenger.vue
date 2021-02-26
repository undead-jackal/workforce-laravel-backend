<template>
    <div class="z-0">
        <!-- <div class="fixed bg-white shadow-lg border-2 border-red-900 text-center py-1 bottom-0 right-0 h-10 w-1/5">
            <a href="" @click="openMessenger(true)" class="text-red-900 font-bold text-lg">Messenger</a>
        </div> -->
    </div>
    
</template>

<script>
import db from '../db';
import VueChatScroll from 'vue-chat-scroll';

Vue.use(VueChatScroll);

export default {
    props:['id','type'],
    data(){
        return{
            is_open:false,
            is_chat_open:false,
            solo:null,
            key_g:null,
            currentChatTitle:null,
            chats:null,
            message:null,
            status:null,
            group:null
        }
    },
    mounted:function(){
        let test = db.database().ref("workforce/invite_not").orderByKey().limitToLast(1);
            test.on('value', snapshot => {
                const data = snapshot.val();
                const formdata = new FormData();
                var self = this;
                Object.keys(data).forEach(key => {
                    formdata.append('key',data[key][0].key);
                    console.log(data[key][0].key);
                    if (self.key_g == data[key][0].key) {
                                if (this.type == 2) {
                                    axios.post('/employer/getChats',formdata)
                                        .then(function (response) {
                                            console.log(response.data);
                                            self.chats = response.data.chats
                                    })
                                    .catch(function (error) {
                                        console.log(error)
                                    });
                                }else if(this.type == 0){
                                    axios.post('/freelancer/getChats',formdata)
                                        .then(function (response) {
                                            console.log(response.data);
                                            self.chats = response.data.chats
                                        })
                                        .catch(function (error) {
                                            console.log(error)
                                        });
                                }      
                    }
                });
            
                
            });
    },
    methods:{

        openMessenger(action){
            this.is_open = action;
            if (action == false) {
                this.is_chat_open = false
            }
            const formdata = new FormData();
            formdata.append('id',this.id);
            formdata.append('type',this.type);
            var self = this;
            if (this.type == 2) {
                axios.post('/employer/floaterGetSolo',formdata)
                        .then(function (response) {
                            self.solo = response.data.solo;
                            console.log();

                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                axios.post('/employer/floaterGetGroup',formdata)
                        .then(function (response) {
                            self.group = response.data.group
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }else if(this.type == 0){
                axios.post('/freelancer/floaterGetSolo',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.solo = response.data.solo
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                axios.post('/freelancer/floaterGetGroup',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.group = response.data.group
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
        },
        openChat(name, key, stat){
            
            this.currentChatTitle =name;
            this.key_g =key;
            this.is_chat_open=false;
            this.is_chat_open=true;
            this.status = stat;
            const formdata = new FormData();
            formdata.append('key',key);
            var self = this;
            if (this.type == 2) {
                axios.post('/employer/getChats',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.chats = response.data.chats;

                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }else if(this.type == 0){
                axios.post('/freelancer/getChats',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.chats = response.data.chats;
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }

            
        },
        sendMessage(){
            const formdata = new FormData();
            formdata.append('message', this.message);
            formdata.append('key', this.key_g);
            var self = this;
            if (this.type == 2) {
                axios.post('/employer/recordChats',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.message = " "
                            let group_chat = db.database().ref("workforce/invite_not");
                                var updates = [
                                    {
                                        key:self.key_g,
                                    },
                                ]
                            group_chat.push(updates)
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }else if(this.type == 0){
                axios.post('/freelancer/recordChats',formdata)
                        .then(function (response) {
                            console.log(response.data);
                            self.message = " "
                            let group_chat = db.database().ref("workforce/invite_not");
                                var updates = [
                                    {
                                        key:self.key_g,
                                    },
                                ]
                            group_chat.push(updates)
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
            }
            
        }
    }
}
</script>

<style scoped>
.messenger-floater{
    position: fixed;
    width: 250px;
    height: 30px;
    background: red;
    bottom: 0px;
    right: 0px;
}

.group-messenger{
    position: fixed;
    width: 351px;
    height: 500px;
    bottom: 0px;
    right: 0px;
    background: white;
    padding: 2%;
}


.chat-messenger{
    position: fixed;
    width: 351px;
    height: 500px;
    bottom: 0px;
    right: 351px;
    background: white;
    border-right: 2px solid #ccc;
    padding: 2%;
}

.chat-main{
    width: 100%;
    height: 80%;
    overflow: auto;
}
.chat-yours .message{
    width: 80%;
    background: #4469D7;
    padding: 3% 8%;
    border-radius: 23px;
    color: white;
}

.chat-yours span{
    margin-left: 17px;
}


.chat-mine{
    display: flex;
    flex: 1;
    align-items: flex-end;
    justify-content: right;
    flex-direction: column
}
.chat-mine .message{
    width: 80%;
    background: #E0A800;
    padding: 3% 8%;
    border-radius: 23px;
    color: white;
}

.chat-mine span{
    margin-right: 17px;
}
</style>