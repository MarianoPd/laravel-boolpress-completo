<template>
  <main class="container">
      <h1>Contacts</h1>
      <div class="form">
        <form @submit.prevent="sendForm">
          
          <h2 v-if="success" class="success">Email inviata correttamente</h2>

          <div class="field">
            <label for="name">Name</label>
            <input v-model="name" type="text" placeholder="..." id="name">
            <p v-if="errors.name" class="errors">{{errors.name[0]}}</p>
          </div>          
          <div class="field">
            <label for="email">Email</label>
            <input v-model="email" type="text" placeholder="..." id="email">
            <p v-if="errors.email" class="errors">{{errors.email[0]}}</p>
          </div>
          <div class="field">
            <label for="message">Message</label>
            <textarea v-model="message" placeholder="..." id="message" rows="10"></textarea>
            <p v-if="errors.message" class="errors">{{errors.message[0]}}</p>
          </div>

          <button type="submit" :disabled="sending">
            {{sending ? 'Invio in corso...': 'Send'}}
          </button>
        </form>
      </div>
  </main>
</template>

<script>
export default {
    name: 'Contacts',
    data(){
      return{
        name: '',
        email: '',
        message: '',
        errors: {},
        sending: false,
        success: false,
      }
    },
    methods:{
      sendForm(){
        this.sending = true;
        this.success = false;
          axios.post('api/contacts', {
            name: this.name,
            email: this.email,
            message: this.message,
          }).then(res =>{
            //console.log(res.data);
            this.sending = false;
            if(!res.data.success){
              this.errors = res.data.errors;
            }else{
              this.errors = {};
              this.success = true;
              this.name = '';
              this.email = '';
              this.message = '';
            }
          })
      }
    }
}
</script>

<style lang="scss" scoped>
.container{
  margin-top: 30px;

  .form{
    .field{
      margin-top: 20px;
      label{
        display: block;
        margin-bottom: 10px;
      }
      input, textarea{
        padding: 3px 8px;
        width: 100%;
      }
      
    }
    button{
        padding: 2px 5px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        //background-color: lightgray;
        color: cadetblue;
        margin-top: 10px;
      }
      .errors{
        color: red;
      }
      .success{
        color: green;
      }
  }
}

</style>