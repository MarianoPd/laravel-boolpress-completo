<template>
  <header>
      <nav>
          <ul>
              <li><router-link :to="{name: 'home'}">Home</router-link></li>
              <li><router-link :to="{name: 'about'}">About</router-link></li>
              <li><router-link :to="{name: 'contacts'}">Contacts</router-link></li>
              <li><router-link :to="{name: 'posts'}">Posts</router-link></li>              
              
          </ul>
      </nav>
  </header>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style lang="scss" scoped>

    header{
        
        background-color: cadetblue;
        text-align: center;
        nav{
            ul{
                list-style: none;
                li{
                    display: inline-block;
                    padding: 30px;
                    a{
                        text-decoration: none;
                        color: white;
                        &:hover{
                            text-decoration: underline;
                        }
                        &.active{
                            color: sandybrown;
                        }
                    }
                }
            };
        }
    }

</style>