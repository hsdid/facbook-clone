<template>
   
    <div v-if="openComment">
        <form @submit.prevent="send_comment(); get_comments(article_id);">
            <input type="text" class="form-input " v-model="comment" required>
        </form>
       
        
        <div>
            {{authUser}} / {{article_id}}
        <div class="card comment-area">
            <div  v-for="comment in comments" v-bind:key="comment.id" class="" >
                                            
                        
                    <div  class="p-2 msg bg-secondary text-light mb-2" style="float: left;">
                       <div class="comment-con">
                            <small>{{comment.name}}</small>
                            <small class=" msg_text ">{{comment.text}}</small>
                        </div> 
                       
                                                
                    </div>
                                            
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    
    
    
    export default {
        props: ['authUser','article_id','openComment'],

        name: 'comment',

        data() {
            return{
                comment: '',
                comments: []

            }
           
        },
        
        methods:{
            
           
            send_comment(){

                let formData = new FormData();
                formData.append('user_id', this.authUser);
                formData.append('article_id', this.article_id);
                formData.append('text', this.comment);

               axios.post('http://lcaht.test/api/comment',formData)
               .then(res => {
                   console.log(res.data);
               }).catch(err => {
                   console.log(err);
               });

                this.comment = '';
                this.get_comments($article_id);
            },
            
            get_comments(article_id){
                
                
                axios.get('http://lcaht.test/api/comments',{
                    params: {
                        article_id : article_id
                    }
                }).then(res => {
                    console.log(res.data);
                    this.comments = res.data.comments;
                }).catch( err => {
                    console.log(err);
                });
                

            }

        },
        

        mounted() {
           
          this.get_comments(this.article_id);

        }
    }
</script>

<style  scoped>

.msg_text {
    font-size:14px;
    font-weight: 500;
}
.msg {
    border: 1px solid;
    border-radius: 20px;
    
}

.header_text{
    font-size:17px;
    font-weight: 600;
    
}
.form-input {
    width: 100%;
}
.form-span {
    display: block;
    overflow: hidden;
    padding: 0 5px 0 0;
}


.msg_heder {
    display: flex;
    align-items: baseline;

}
.msg_text {
    font-size:14px;
    font-weight: 500;
}
.comment-area{
    max-height: 200px;
    min-height: 0px;
    position:relative;
    /* height: 350px; */
    overflow-y: auto;
}
.comment-con{
    display: flex;
    flex-direction: column;
}

</style>