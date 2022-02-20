<template>
  <div class="container">
      <h1>{{post.title}}</h1>
      <div class="image">
          <img :src="post.cover" alt="post.title">
      </div>
      <h3 v-if="post.category">{{post.category.name}}</h3>
      <p>{{post.content}}</p>
      <div class="tags">
          <span class="tag"
            v-for="(tag,index) in post.tags"
            :key="index"
          >{{tag.name}}</span>
      </div>
      <button>
          <router-link :to="{name: 'posts'}" class="rl-button">Posts</router-link>
      </button>
  </div>
</template>

<script>
export default {
    name: 'PostDetail',
    data(){
        return{
            apiUrl: 'http://127.0.0.1:8000/api/posts/',
            post:{
                title: '',
                category: {},
                content: '',
                tags: [],
            }
        }
    },

    methods:{
        getApi(){
            axios.get(this.apiUrl + this.$route.params.slug)
                .then(res=>{
                    this.post = res.data;
                })
        }
    },

    mounted(){
        this.getApi();
    }
}
</script>

<style lang="scss" scoped>

.container{
    margin-top: 30px;

    h3{
        color: salmon;
        margin: 10px 0;
    }

    .image{
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
        img{
            width: 100%;
        }
    }

    .tags{
        margin-top: 30px;
        .tag{
            margin-right: 15px;
            background-color: rgb(81, 192, 90);
            color: white;
            border-radius: 5px;
            padding: 2px 5px;
        }
    }
    button{
        margin: 30px 0;
        padding: 5px 7px;
        background-color: brown;
        border-radius: 10px;
        border: none;
        .rl-button{
            color: white;
            text-decoration: none;
            &:hover{
                text-decoration: underline;
            }
        }
    }
}

</style>