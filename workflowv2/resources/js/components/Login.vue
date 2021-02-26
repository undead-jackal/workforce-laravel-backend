<template id="">
    <div class="w-1/3 shadow-lg mx-auto h-3/4 bg-white">
        <div class=" p-4 text-center text-red-900">
            <h4 class="text-2xl mr-auto">LOGIN</h4>
            <span class="text-sm p-2">Something to say</span>
        </div>
        <div class="p-4">
            <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-sm text-red-900">Username</label>
                <input v-model="form.username" class="border py-2 px-3 text-grey-darkest" type="text">
            </div>
            <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-sm text-red-900">Password</label>
                <input v-model="form.password" class="border py-2 px-3 text-grey-darkest" type="text">
            </div> 
            <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-sm text-red-900">Role</label>
                <select v-model="form.type" class="border py-2 px-3 text-grey-darkest" name="" id="">
                    <option value="0">Freelancer</option>
                    <option value="1">Coordinator</option>
                    <option value="2">Employer</option>

                </select>
            </div> 
            <div class="flex flex-col mb-4">
                <button @click="Login" class="px-5 py-2 text-white text-lg font-bold bg-red-900">Login</button>                            
            </div>   
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                username:null,
                password:null,
                type:null
            }
        }
    },
    methods:{
        Login() {
            const vm = this;
            axios.post('/handleLogin', this.form)
            .then(function (response) {
                vm.form.username = null
                vm.form.password = null
                vm.form.type = null
                if(response.status){
                    location.reload();
                }
                console.log(response.status);
            })
            .catch(function (error) {
                console.log(error)
            });
        }
    }
}
</script>
