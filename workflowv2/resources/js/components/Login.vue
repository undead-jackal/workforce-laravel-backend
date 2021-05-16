<template id="">
    <div class="w-1/3 shadow-lg mx-auto h-3/4 bg-white">
        <div class=" p-4 text-center text-red-900">
            <h4 class="text-2xl mr-auto">LOGIN</h4>
            <span class="text-sm p-2">Something to say</span>
        </div>
        <div class="p-4">
            <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-sm text-red-900">Username</label>
                <input v-model="form.username.val" class="border py-2 px-3 text-grey-darkest" type="text">
                <span v-if="form.username.error">{{form.username.error_msg}}</span>
            </div>
            <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-sm text-red-900">Password</label>
                <input v-model="form.password.val" class="border py-2 px-3 text-grey-darkest" type="text">
                <span v-if="form.password.error">{{form.password.error_msg}}</span>
            </div> 
            <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-sm text-red-900">Role</label>
                <select v-model="form.type.val" class="border py-2 px-3 text-grey-darkest" name="" id="">
                    <option value=0>Freelancer</option>
                    <option value=1>Coordinator</option>
                    <option value=2>Employer</option>

                </select>
                <span v-if="form.type.error">{{form.type.error_msg}}</span>

            </div> 
            <div class="flex flex-col mb-4">
                <button @click="Login" class="px-5 py-2 text-white text-lg font-bold bg-red-900">Login</button>                            
            </div>   
        </div>
    </div>
</template>

<script>
import GlobalMix from '../GlobalMix'

export default {
    mixins:[GlobalMix],
    data(){
        return{
            form:{
                username:{
                    val:null,
                    error:false,
                    error_msg:[],
                    rules:{
                        required:true,
                    }
                },
                password:{
                    val:null,
                    error:false,
                    error_msg:[],
                    rules:{
                        required:true,
                    }
                },
                type:{
                    val:null,
                    error:false,
                    error_msg:[],
                    rules:{
                        required:true,
                    }
                }
            }
        }
    },
    methods:{
        Login() {
            const vm = this;
            this.form = this.validate(this.form).obj_ret;
            if(!this.validate(this.form).status){
                axios.post('/handleLogin', this.form)
                .then(function (response) {
                    if(response.data.status){
                        location.reload();
                    }else{
                        alert("error you dont have the correct credentials");
                    }
                })
                .catch(function (error) {
                    console.log(error)
                });
            }
        }
    }
}
</script>
