<template>
   
        <div class="row justify-content-center">
            <div class="col-12">
                    <a href="/home">messages</a>
                <div class="card">
                        <div>
                            <input type="text"  v-model="find_user" >
                        </div>
                       <!-- <div v-for="user in users" v-bind:key="user.id">
                        <a href="user">{{user.name}}</a>  <i class="fas fa-plus" @click="addToFriend(user.id)"></i>
                       </div>    -->
                        <div class="card" v-for="user in filteredList" v-bind:key="user.id">
                             <a href="user">{{user.name}}</a>  <i class="fas fa-plus" @click="addToFriend(user.id)"></i>
                        </div>
                   
                </div>
            </div>
        </div>
   
</template>

<script>
    export default {
        props: ['authUser'],
        

        data() {
            return{
               users: [],
               find_user: ''
            }
           
        },
        
        methods:{
            getUsers() {
                axios.get('/api/allUsers',{
                    params:{
                        current_id: this.authUser.id
                    }
                }).then(res=>{
                    
                    console.log(res);
                    this.users = res.data.users;
                    
                }).catch((error) =>{
                    console.log(error);
                });
            },
            addToFriend(id){
                axios.post('/api/toFriend',{user_id: id,current_id: this.authUser.id} )
                .then((res)=>{
                    console.log(res)
                }).catch((error)=>{
                    console.log(error);
                });

                this.getUsers();
                
            },
            findUser(){

                console.log(this.find_user);
                console.log(this.users);
                
                this.users.forEach(element => {
                    console.log(element.name);
                    
                   
                });

               

            },
            
           
          
        },
        computed:{
             filteredList(){
                    return this.users.filter(user => {
                        return user.name.toLowerCase().includes(this.find_user.toLowerCase());
                    });
            }
        },
        

        mounted() {
            this.getUsers();
           //console.log( this.authUser.id);
        } 
    }
</script>