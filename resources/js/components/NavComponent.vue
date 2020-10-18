<template>       
    <nav class="navbar bg-dark x">
       
        
        <SearchFriend  :auth="authUser" />
        
         <div class="menu_item text-menu"  style="margin-left:auto; " >
            <a :href="'/user/'+authUser.id">{{authUser.name}}</a>
        </div>
        <div class="menu_item ">
            <a href="/home"><i class="fas fa-home fa-2x"></i></a>
        </div>
        <CreateArticle :auth="authUser"/>
        <Dropdown :auth="authUser" style=" margin-right:100px"/>
        <div class="menu_item">
           <a v-if="! authUser" class="nav-link text-menu" href="/login">Login</a>
           <a v-else class="text-menu" href="/logout">logout</a>
        </div>

    </nav>
</template>

<script>

    import SearchFriend from './SerachFriend.vue';
    import Dropdown from './Dropdown.vue';
    import CreateArticle from './CreateArticle.vue';
    export default {
        
        props: ['authUser'],
        
        components:{
            Dropdown,
            SearchFriend,
            CreateArticle
        },

        data() {
            return{
               friends:[],
               users: [
                  
               ]
            }
           
        },

        methods:{
           
           
            

        },
        

        mounted() {
            
          

        }
    }
</script>

<style >
    nav {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;

    }

    nav .menu_item {
        color: #ffffff;
        padding: 10px 20px;
        position: relative;
        text-align: center;
        border-bottom: 3px solid transparent;
        display: flex;
        transition: 0.4s;
    }

    nav .menu_item.active,
    nav .menu_item:hover{
        background-color: #444;
        border-bottom-color: #3e60a9;
       
    }
    
    nav .menu_item a {
        color: inherit;
        text-decoration: none;
    }
    .x{
        /* overflow: hidden; */
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 4;
    }
    .text-menu{
        font-size: 17px;
        
    }
</style>
