<template>
   
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="">
                  
                  <div class="card card-body p-4 mb-4 " v-for="article in articles" v-bind:key="article.id">
                      <!-- <div class="card-header">
                          <h5 class="header_text"><a :href="'/user/'+article.user_id"> {{article.name}}</a></h5>
                           <small>Post on {{article.created_at }}</small>
                      </div> -->
                        <div class="card-header d-flex align-items-baseline">
                            
                            <div>
                                 <h5 class="header_text"><a :href="'/user/'+article.user_id"> {{article.name}}</a></h5>
                                <small>Post on {{article.created_at }}</small>
                            </div>
                            <div v-if="article.user_id == authUser.id" class="ml-auto">
                                <a  class="ml-4" @click="delete_article(article.id); get_articles();"  href="#"><i class="far fa-trash-alt fa-2x mr-3 text-danger"></i></a>

                                <a href=""><i class="fas fa-pencil-alt fa-2x"></i></a>
                            </div>

                        </div>
                     <p class="msg_text ml-3">{{article.body}}</p> 
                     <img v-if="article.image != 'default.jpg'" :src="'/uploads/article_img/'+ article.image" alt="" >
                        <hr>
                       <div class="ml-3">
                            <i class="far fa-thumbs-up fa-2x mr-3"></i>
                            
                            <!-- <a href="#" @click="openComment()"><i class="far fa-comment-alt fa-2x mr-3"></i></a> -->
                            <i @click="openComment()" class="far fa-comment-alt fa-2x mr-3 i"></i>
                            <!-- <a href="#" @click="addToFavorite(article.id, authUser.id)"><i class="far fa-heart fa-2x "></i></a> -->
                            <i class="far fa-heart fa-2x i" @click="addToFavorite(article.id, authUser.id)"></i>
                           
                       </div>
                       <hr>
                       <Comment :authUser="authUser.id" :article_id="article.id" :openComment="openComments"/>
                  </div>
                    
                   
                </div>
            </div>
        </div>
   
</template>

<script>

    import Comment from './Comment.vue';

    export default {
        props: ['authUser'],
        

        data() {
            return{
                
                articles:[],
                openComments: false

            }
           
        },
        
        methods:{
            
            get_articles(){

                axios.get('api/articles')
                .then(res => {
                    console.log(res.data);
                    this.articles = res.data.articles;
                }).catch(error => {
                    console.log(error);
                });
            },

            delete_article(article_id) {

                axios.delete('api/article/destroy',{
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
                
                axios.post('api/addToFavorite',formData)
                .then(res => {
                    console.log(res.data);
                }).catch(err => {
                    console.log(err);
                })

            },
            
            openComment(){
                
                this.openComments = !this.openComments;
            }


        },
        

        mounted() {
           
           this.get_articles();

        }
    }
</script>

<style  scoped>

.msg_text {
    font-size:14px;
    font-weight: 500;
}
.msg {
    border: 1px solid white;
    border-radius: 20px;
}
.friend{
    font-size:15px;
    font-weight: 500;
    text-decoration: none;
   
}

.header_text{
    font-size:17px;
    font-weight: 600;
    
}
.i:hover{
    cursor: pointer;
}
/* .img{
    
} */

</style>