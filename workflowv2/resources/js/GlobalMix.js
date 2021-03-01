export default {
    data(){
        return{
            form_error:[],
            options: [
                { name: 'Vue.js', code: 'vu' ,rating:0},
                { name: 'Javascript', code: 'js' ,rating:0},
                { name: 'Open Source', code: 'os' ,rating:0},
                { name: 'Laravel', code: 'Lar' ,rating:0},
                { name: 'Web Development', code: 'Web Dev',rating:0 }
            ],
        }
    },
    methods:{
        test:function(){
            
        },
        validate(event){
            console.log(event.target.value);
        }
    },
}