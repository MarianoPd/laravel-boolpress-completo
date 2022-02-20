<template>
  <div class="sidebar">
      <div class="box categories">
          <h3>Category</h3>
          <span v-for="(categ, index1) in categories" :key="index1"
                @click="sendCateg(categ)"
          >{{categ.name}}</span>
      </div>
      <div class="box tags">
          <h3>Tag</h3>
          <span v-for="(tag,index2) in tags" :key="index2"
                @click="sendTag(tag)"
          >{{tag.name}}</span>
      </div>

      <button @click="$emit('getAllPosts')">Reset</button>
  </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props:{
        'categories': [],
        'tags': [],
    },
    methods:{
        sendCateg(categ){
            this.$emit('getByCateg', categ.slug);
            //console.log('slug: ',categ.slug);
        },
        sendTag(tag){
            this.$emit('getByTag', tag.slug);
            //console.log('slug: ',tag.slug);
        },
    }

}
</script>

<style lang="scss" scoped>
    .sidebar{
        margin-left: 30px;
        margin-top: 100px;
        button{
            border-radius: 6px;
            border: none;
            padding: 6px;
            color: red;
            cursor: pointer;
        }
        .box{
            border: 2px solid gray;
            border-radius: 5px;
            padding: 30px 15px;
            margin-bottom: 30px;
            
            max-width: 150px;
            h3{
                margin-bottom: 20px;
            }
            span{
                padding: 3px 6px;
                border-radius:3px;
                color: white;
                display: inline-block;
                margin-bottom: 5px;
                margin-right: 5px;
                cursor: pointer;
            }
            &.categories{
                span{
                    background-color: brown;
                    &:hover{
                        background-color: rgb(212, 95, 95);
                    }
                }
            }
            &.tags{
                span{
                    background-color: rgb(43, 75, 136);
                    &:hover{
                        background-color: rgb(116, 143, 194);
                    }
                }
            }
        }

    }
</style>