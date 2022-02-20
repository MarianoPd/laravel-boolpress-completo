<template>
  <article>
    <div class="img-box">
      <img :src="post.cover" :alt="post.title">
    </div>
    <div class="text-box">
          <h3><router-link :to="{name: 'detail', params: {slug: post.slug}}" class="title-link">{{post.title}}</router-link></h3>
          <p>{{truncatedText}}</p>
          <p class="date">{{formatDate}}</p>
          <p v-if="post.category" class="category">{{post.category.name}}</p>
          <p v-if="post.tags">
            <span v-for="(tag,index) in post.tags" 
              :key="index" class="tag"
              @click="sendTag(tag)">
                {{tag.name}}
            </span>
          </p>
    </div>
  </article>
</template>

<script>
export default {
    name: 'PostItem',
    props:{
      'post' : Object,
    },
    
    methods:{
      sendTag(tag){
            this.$emit('getByTag', tag.slug);
            //console.log('slug: ',tag.slug);
        },
    },

    computed:{
      truncatedText(){
        return this.post.title.substr(0,50) + '...';
      },

      formatDate(){
        const d = new Date(this.post.created_at);
        let date = d.getDate();
        if(date < 10) date = '0' + date;
        let month = d.getMonth();
        if(month < 10) month = '0' + month;
        let year = d.getFullYear();
        return `${date}/${month}/${year}`;
      }
    },


}
</script>

<style lang="scss" scoped>

article{
  margin: 30px 0;
  border: 1px solid gray;
  border-radius: 5px;
  overflow: hidden;
  width: 90%;
  display: flex;
  height: 200px;

  .img-box{
    width: 30%;
    height: 100%;
    img{
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  .text-box{
    padding: 10px;
    width: 70%;
  }
  .title-link{
    text-decoration: none;
    color: black;
    &:hover{
      text-decoration: underline;
    }
  }
  p{
    padding: 7px 0;
  }
  .date{
    font-style: italic;
  }
  .category{
    font-weight: bold;
    color: rgb(150, 10, 64);
  }
  .tag{
    display: inline-block;
    padding: 2px 5px;
    margin-right: 10px;
    margin-bottom: 10px;
    background-color:rgb(81, 192, 90);
    color: white;
    border-radius: 5px;
    cursor: pointer;
    &:hover{
      background-color:rgb(130, 219, 138);
    }
  }
}

</style>