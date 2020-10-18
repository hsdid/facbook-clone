<template>
   
     <div class="menu_item">
        <!-- <a href="#"  @click="isOpen = !isOpen; getUsers();"><i class="fas fa-search fa-2x" ></i></a>  -->
          <i class="fas fa-search fa-2x i" @click="isOpen = !isOpen; getUsers();"></i>
        <transition name="fade" appear="">
            <div class="sub_menu above" v-if="isOpen" style="margin-left:50px">
                <div class="menu_item"> 
                   <input type="text"  v-model="find_user" class="search" >
                </div>
                <div v-for="(item,i) in filteredList " :key="i" class="menu_item">
                    <a :href="'/user/' +item.id" >{{ item.name }}</a>
                </div>
            </div>
        </transition>
    </div>  
   
</template>

<script>
    export default {
        name: 'SearchFriend',

        props: ['auth'],
        

        data() {
            return{
               isOpen: false,
               find_user: '',
               users: []
              
            }
            
           
        },

        methods:{
           
            getUsers() {
                axios.get('/api/allUsers',{
                    params:{
                        current_id: this.auth.id
                    }
                }).then(res=>{
                    
                    // console.log(res);
                    this.users = res.data.users;
                    
                }).catch((error) =>{
                    console.log(error);
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
            
         

        }
    }
</script>
<style>
 
nav .menu_item .sub_menu {
    position: absolute;
    background-color: #222;
    top: calc(100% + 18px);
    left: 50%;
    transform: translateX(-50%);
    width: max-content;
    border-radius: 0px 0px 16px 16px;
}
.above { 
    z-index: 2;
}
.search{
    border: 1px solid white;
    border-radius: 20px;
}
.i:hover{
    cursor: pointer;
}
</style>
