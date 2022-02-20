<template>
  <main>
      <div v-if="posts" class="container">
          <div v-if="success">
                <div class="title">
                    <h1>{{title}}</h1>
                    
                </div>
                <PostItem 
                    v-for="(post, indexPost) in posts"
                    :key="indexPost"
                    :post = post
                    @getByTag="getByTag"
                />

                <div class="pagination" v-if="paginate">
                    <button
                        @click="getApi(pagination.current - 1)"
                        :disabled = "pagination.current === 1"
                    > &#8592; </button>

                    <button
                        v-for="i in pagination.last"
                        :key="i"
                        @click="getApi(i)"
                        :disabled = "pagination.current === i"
                    >
                        {{i}}
                    </button>

                    <button
                        @click="getApi(pagination.current + 1)"
                        :disabled = "pagination.current === pagination.last"
                    > &#8594; </button>
                </div>
          </div>
          <div v-else class="title">
              <h2>{{error_msg}}</h2>
          </div>
            <div>
                <Sidebar :categories = "categories" 
                    :tags = "tags"
                    @getByCateg="getByCateg"
                    @getByTag="getByTag"
                    @getAllPosts="getApi"/>
                
            </div>
      </div>
      <div v-else class="container">
          <Loading/>
      </div>
  </main>
</template>

<script>
import PostItem from '../partials/PostItem.vue';
import Loading from '../partials/Loading.vue';
import Sidebar from '../partials/Sidebar.vue';

export default {
    name: 'Posts',

    components:{
        PostItem,
        Loading,
        Sidebar,
    },

    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts',
            posts: null,
            pagination: {},
            tags:[],
            categories:[],
            success: true,
            error_msg: '',
            title: 'Posts',
            paginate: true,
        }
    },

    mounted(){
        this.getApi();
    },

    methods:{
        getByTag(slug){
            
            this.reset();
            axios.get(this.apiUrl + '/posttag/'+ slug)
                .then(res => {
                    
                    if(!res.data.success){
                        this.error_msg = res.data.error;
                        this.success = false;
                    }else{
                        this.posts = null;
                        this.posts = res.data.tag.posts;
                        this.title = 'Posts by Tag: '+slug;
                        console.log(res.data.tag.posts);
                    }

                })
        },
        getByCateg(slug){
            this.reset();
            axios.get(this.apiUrl +'/postcategory/' + slug)
                .then(res => {
                    //console.log('getbycat',res.data);
                    
                    if(!res.data.success){
                        this.error_msg = res.data.error;
                        this.success = false;
                    }else{
                        this.posts = [];
                        this.posts = res.data.categories.posts;
                        this.title = 'Posts by Category: '+slug;
                    }
                })
        },

        getApi(page = 1){
            this.reset();
            axios.get(this.apiUrl + '?page=' + page)
                .then(res => {
                    
                    this.posts = null;
                    this.posts = res.data.posts.data;
                    this.tags = res.data.tags;
                    this.categories = res.data.categories;
                    this.pagination = {
                        current: res.data.posts.current_page,
                        last: res.data.posts.last_page,
                    }
                    this.title = 'Posts';
                    //console.log(this.tags);
                    //console.log(this.categories);
                    //console.log(this.pagination);
                    //console.log(this.posts);
                })
                .catch(e=>{
                    console.log(e);
                });
        },
        reset(){
            this.error_msg = '';
            this.success = true;
            this.posts = null;
            this.paginate = true;
        }
    }
}
</script>

<style lang="scss" scoped>

    main{
        padding-bottom: 70px;
        .container{
            display: flex;
            justify-content: center;
        }
        .title{
            width: 100%;
            text-align: center;
            padding: 20px 0;
            color: sandybrown;
        }

        .pagination{
            text-align: center;
            button{
                cursor: pointer;
                padding: 5px;
            }
        }
        
    }

</style>