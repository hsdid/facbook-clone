<template>
   
        <div class="row justify-content-center">
            <div class="col-8">
                 <div v-if="message" class="alert alert-success">
                            {{message}}
                </div>
                <div class="card mb-2">
                  
                       
                       
                        <div class="card-body col-5">
                            <h2>{{user.name}}</h2>
                            

                        </div>

                        <div class="card-body col-5">
                             
                          <div class="d-flex align-items-baseline">
                               <button :disabled="isFriend" class="btn btn-primary" @click="addToFriend(user.id); friendOrNo()">Add to friend</button>
                                <button :disabled="!isFriend" class="btn btn-danger mr-4" @click="removeFriend(user.id); friendOrNo()">remove</button>

                                <a href="#" @click="showFavorite()"><i class="far fa-heart fa-2x " ></i></a>
                          </div>
                           

                        </div>
                        
                       

                       
                </div>
                <div v-if=" articles.length > 0"> 
                    <div  class="card card-body p-4 mb-4 " v-for="article in articles" v-bind:key="article.id">
                        <div class="card-header d-flex align-items-baseline">
                            
                            <div>
                                 <h5 class="header_text">{{article.name}}</h5>
                                <small>Post on {{article.created_at }}</small>
                            </div>
                            <div v-if="article.user_id == authUser.id" class="ml-auto">
                                <a  class="ml-4" @click="delete_article(article.id); user_articles();"  href="#"><i class="far fa-trash-alt fa-2x mr-3 text-danger"></i></a>

                                <a href=""><i class="fas fa-pencil-alt fa-2x"></i></a>
                            </div>

                        </div>
                        <p class="msg_text ml-3">{{article.body}}</p> 
                        
                        <img v-if="article.image != 'default.jpg'" :src="'/uploads/article_img/'+ article.image" alt="" >

                            <hr>
                        <div class="ml-3">
                                <i class="far fa-thumbs-up fa-2x mr-3"></i>
                                <i class="far fa-comment-alt fa-2x mr-3"></i>
                                
                                
                                <a href="" @click="addToFavorite(article.id, authUser.id)"><i class="far fa-heart fa-2x " ></i></a>
                                
                                
                        </div>
                        
                    </div>
                </div>
                <div v-else class="card card-body alert alert-primary">
                    user dont have any posts 
                </div>
                
               
            </div>
        </div>
   
</template>

<script>
    
    export default {
        props: ['authUser'],
       
       

        data() {
            return{
               pathId:'',
               user:[],
               message: '',
               friend_id: [],
               isFriend: false,
               articles:[],
               articles_len: 0,
            }

           
        },

        methods:{
           
             getIDfromURL(){
                return window.location.pathname.split('/')[2];
            },
            getUser(){
                axios.get('/api/user/'+this.pathId)
                .then(res => {
                    
                    this.user = res.data.user;
                    console.log(this.user);
                })
            },
            addToFriend(id){
                axios.post('/api/toFriend',{user_id: id,current_id: this.authUser.id} )
                .then((res)=>{
                    console.log(res.data.msg);
                    this.message = res.data.msg;
                }).catch((error)=>{
                    console.log(error);
                });


                
            },
            removeFriend(id){
                axios.delete('/api/removeFriend',{
                    params:{
                        friend_id: id,
                        current_id: this.authUser.id
                    }
                }).then(res => {
                    console.log(res);
                    this.message = res.data.msg;
                }).catch((error) => {
                    console.log(error);
                });

                
            },
            // take friends id and if user id is in friend mak "add to friend" btn disable
            friendOrNo(){
                axios.get('/api/showFriends',{
                    params: {
                        current_id: this.authUser.id
                    }
                })
                .then(res => {
                   
                    this.friend_id = res.data.friends_id;
                    console.log(this.friend_id);
                    const isfriend = this.friend_id.some(x => x == this.pathId)
                    this.isFriend = isfriend;
                    

                }).catch((error) =>{
                    console.log(error);
                });
            }, 
            
            //all articles for user 
            user_articles(){

                axios.get('/api/articles/user/'+this.pathId)
                .then(res => {
                    console.log(res.data);
                    this.articles = res.data.articles;
                    

                }).catch(error =>{
                    console.log(error);
                })
            },

            delete_article(article_id) {

                axios.delete('http://lcaht.test/api/article/destroy',{
                    params:{
                       id: article_id
                    }
                }).then(res => {
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                });

               
            },
            addToFavorite(article_id, user_id){

                let formData = new FormData();
                formData.append('user_id', user_id);
                formData.append('article_id', article_id);
                
                axios.post('http://lcaht.test/api/addToFavorite',formData)
                .then(res => {
                    console.log(res.data);
                }).catch(err => {
                    console.log(err);
                });

            },
            showFavorite(){

                axios.get('http://lcaht.test/api/showFavorite',{
                    params: {
                        current_id: this.authUser.id
                    }
                }).then(res => {
                    console.log(res.data);
                    this.articles = res.data.articles;
                }).catch(err => {
                    console.log(err);
                });
            }
           

        },

        mounted() {
            
            //console.log(this.authUser);
            this.pathId = window.location.pathname.split('/')[2];
            console.log(this.pathId);
            this.getUser();
            this.user_articles();
            this.friendOrNo();
            
            console.log(this.articles_len);
            
            
           
            
        }
    }
</script>

<style >
.header_text{
    font-size:17px;
    font-weight: 600;
}
.msg_text {
    font-size:14px;
    font-weight: 500;
}


</style>