<template>
   
                            <div class="card messanger above" v-if="receiver.id > 0 && isUser" style="">
                                
                                <div class="card-header msg_heder">
                                    <!-- <h3 >{{receiver.name}}</h3> -->
                                    <a :href="'/user/' +receiver.id" >{{ receiver.name }}</a> 
                                    <i class="fas fa-times fa-2x ml-auto" @click=" isUser = !isUser"></i>
                                </div>
                                
                                <div id="msg_container" class="p-2 d-flex flex-column msg_container" style="">
                                   
                                   <div  v-for="msg in get_message" v-bind:key="msg.id" class="" >
                                        
                                        <div v-if="msg.sender_id == authUser.id" class="p-2 bg-primary text-light msg" style="float: right;">
                                             <small class=" msg_text ">{{msg.message}}</small>
                                            
                                        </div>
                                        
                                        <div v-else class="p-2 msg bg-secondary text-light" style="float: left;">
                                           <small class=" msg_text ">{{msg.message}}</small>
                                            
                                        </div>
                                        
                                   </div>
                                   
                                    
                                </div>
                                <form @submit.prevent="send_msg(receiver); get_msg(); ">
    
                                    <div class="form-group ">
                                        <label for="exampleFormControlTextarea1">Write your msg</label>
                                        
                                        <input class="form-control block" id="exampleFormControlTextarea1" v-on:input="scrollToEnd()" v-model="text_msg" required>

                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i></button>

                                    </div>
                                </form>
                            </div>
       
   
</template>

<script>
    export default {
        name: 'Chat',
        props: ['authUser','receiver','get_message','isUser'],
        

        data() {
            return{
                text_msg: '',
                //get_message: []
            }
           
        },

        methods:{
            

          
            send_msg(receiver){

               

                axios.post('/api/sendMsg',{
                   
                        sender_id: this.authUser.id,
                        receiver_id: this.receiver.id,
                        message: this.text_msg
                        
                }).then(res => {
                    console.log(res.data);
                    this.text_msg = '';
                }).catch((error) => {
                    console.log(error);
                });

                this.get_msg();
               
                
            },
            get_msg(){
                axios.get('/api/showMsg',{
                    params:{
                        sender_id: this.authUser.id,
                        receiver_id: this.receiver.id,
                    }
                }).then(res => {
                    
                    this.get_message = res.data.msg;
                   
                    //console.log(res.data);
                    
                }).catch((error) => {
                    console.log(error);
                });

               

            },
            scrollToEnd() {    	
                var container = this.$el.querySelector("#msg_container");
                container.scrollTop = container.scrollHeight;
               
                console.log('go');
               
            },
            

        },

        mounted() {
            
          console.log(this.authUser);
          //this.get_msg();

        }
    }
</script>

<style >
.msg_container{
    
    position:relative;
    height: 350px;
    overflow-y: auto;
   
}
.msg_heder {
    display: flex;
    align-items: baseline;

}
.msg_text {
    font-size:14px;
    font-weight: 500;
}
.msg {
    border: 1px solid #222;
    border-radius: 20px;
}
.messanger{
    position: absolute;
    background-color: #222;
    top: calc(100% + 18px);
    left: 50%;
    transform: translateX(-50%);
    /* width: max-content; */
     width: 300px; 
    border-radius: 0px 0px 16px 16px;
}

.above{
    z-index: 2;
}
</style>