<template>
   
    <div class="menu_item"   style="justify-content: flex-end;">
        <a href="#" @click="isOpen = !isOpen; showFriends()"><i class="fab fa-facebook-messenger fa-2x text-"></i></a>   
        <transition name="fade" appear="">
            <div class="sub_menu above" v-if="isOpen">
                <div class="menu_item">
                    <input type="text"  v-model="find_friend" class="search" >
                </div>
                <div v-for="(user,i) in filteredList " :key="i" class="menu_item">
                    <a href="#" @click="write_to(user); get_msg(); isOpen= !isOpen; isUser=true"  >{{ user.name }}</a>
                    
                </div>
            </div>
        </transition>

         <transition name="fade" appear="">
             <div class="chat above">
                  <Chat :auth-user="auth" :receiver="receiver" :get_message="get_message" :isUser="isUser"/>
             </div>
              
          
        </transition>

    </div>  
    

    

</template>

<script>
    
    import Chat from './Chat.vue';
    
    export default {
        
        name: 'dropdown',

        props: ['auth'],
        

         components:{
            Chat
        },

        data() {
            return{
                isOpen: false,
                isUser: false,
                 receiver:{
                    id: '',
                    name:'',
                    
                },
                text_msg: '',
                find_friend: '',
                message: '',
                get_message: [],
                friends:[]
            }
           
        },

        methods:{
           
            write_to(user){
               
                this.receiver.id = user.id;
                this.receiver.name = user.name;
            },

             get_msg(){
                axios.get('/api/showMsg',{
                    params:{
                        sender_id: this.auth.id,
                        receiver_id: this.receiver.id,
                    }
                }).then(res => {
                    
                    this.get_message = res.data.msg;
                  
                    //console.log(this.get_message);
                    
                }).catch((error) => {
                    console.log(error);
                });



            },
            showFriends(){
                axios.get('/api/showFriends',{
                    params: {
                        current_id: this.auth.id
                    }
                })
                .then(res => {
                    // console.log(res);
                    this.friends = res.data.friends;
                }).catch((error) =>{
                    console.log(error);
                });
            }, 

        },

        computed:{
             filteredList(){
                    return this.friends.filter(user => {
                        return user.name.toLowerCase().includes(this.find_friend.toLowerCase());
                    });
            }
        },
        mounted() {
            
          this.showFriends()

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

.chat {
    position: absolute;
    background-color: #222;
    top: calc(700%);
    left: 50%;
    transform: translateX(-50%);
    /* width: max-content; */
    border-radius: 0px 0px 16px 16px;
    /* display: flex;
    justify-content: flex-end;
    align-items: flex-end; */
   
    
}
.search{
    border: 1px solid white;
    border-radius: 20px;
}
</style>
