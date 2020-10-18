<template>
   
   <div class="menu_item"   style="justify-content: flex-end;">
        <!-- <a href="#" @click="isOpen = !isOpen; "><i class="fas fa-plus  fa-2x"></i></a>    -->
        <i class="fas fa-plus  fa-2x i" @click="isOpen = !isOpen; "></i>
        <div v-if="isOpen" id="overlay" >

           <div class="modal-dialog" style="margin-top: 200px">
           <div class="modal-content">
               
                <div class="modal-header in-line">
                    <h2 class="mt-4 text-dark">Create Post</h2> 
                    <i class=" fas fa-times fa-2x ml-auto text-dark" @click=" isOpen = !isOpen"></i>
                </div>
                
                <form enctype="multipart/form-data" @submit.prevent="addArticle" class="mb-3"> 
                    <!-- <div class="form-group">
                        <input type="text" class="form-control" placeholder="Title" v-model="article.title" >
                    </div>    -->
                    <div class="form-group">
                        <textarea rows="6" type="text" class="form-control" placeholder="Body" v-model="article.body" required>
                        </textarea >
                    </div>
                    
                    <div class="form-group">
                        <input type="file" class="form-control" id="file" ref="file" v-on:change="handleFileUpload()">
                    </div>
                    
                   
                    
                    <button type="submit" class="btn btn-info btn-block">post</button>
            
                </form>
            </div>
           </div>
        </div>
    </div>  
    
   
</template>

<script>
    export default {
        
        name: 'createArticle',
        props: ['auth'],
        

        data() {
            return{
                isOpen: false,
                msg: '',
                article: {
                body: '', 
                
                },
                file: ''
            }
           
        },
        
        methods:{
            addArticle(){

              
                let formData = new FormData();
                formData.append('user_id', this.auth.id);
                formData.append('body', this.article.body);
                formData.append('image', this.file);

                axios.post('/api/addArticle',formData)
                .then(res => {
                    console.log(res.data);
                    this.msg = res.data.msg;
                    this.isOpen = false;
                    this.article.body = '';
                }).catch((error)=>{
                    console.log(error);
                });
            },

           
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }

        },
          
        
        

        mounted() {
           
           
        }
    }
</script>

<style  >
 #overlay{
            position: fixed;
            top:0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 3;
        }
.article_form{
    position: absolute;
    background-color: #222;
    top: calc(100% + 18px);
    left: 50%;
    transform: translateX(-50%);
    /* width: max-content; */
     width: 500px; 
    border-radius: 0px 0px 16px 16px;
}
.in-line{
    align-items: baseline;
}
.i:hover{
    cursor: pointer;
}
</style>