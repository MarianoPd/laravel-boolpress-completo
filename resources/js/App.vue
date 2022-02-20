<template>
  <div>
        <Header/>

        <router-view></router-view>

        <Footer/>
  </div>

</template>

<script>
import Footer from './components/partials/Footer.vue';
import Header from './components/partials/Header.vue';

export default {
    name: 'App',

    components:{
        Header,
        Footer,
        
    }
}
</script>

<style lang="scss">

</style>