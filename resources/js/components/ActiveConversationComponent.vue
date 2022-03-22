<template>
    <b-row class="h-100">
        <b-col cols="8">
            <b-card no-body
                footer-bg-variant="light"
                footer-border-variant="dark"
                class="h-100"
            >
            <b-card-body class="card-body-scroll">
                <!-- <div id="messages-container"> -->
                    <message-conversation-component 
                        v-for="message in messages"
                        :key="message.id"
                        :written-by-me="message.written_by_me"
                        :image="message.written_by_me ? myImage : contactImage" >
                        {{message.content}}
                    </message-conversation-component>
               <!--  </div> -->
              
            </b-card-body>
            <div slot="footer">
                <b-form @submit.prevent="postMessage" autocomplete="off">
                    <b-input-group>
                        <b-form-input  class="text-center"
                            type="text"
                            placeholder="Escribe un mensaje"
                            v-model="newMessage"

                        ></b-form-input>
                        <b-input-group-append>
                                <b-button type="submit" variant="primary">Enviar </b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form>
            </div>
               
            </b-card>
        </b-col>
        <b-col cols="4" >
            <b-img :src="contactImage" rounded="circle"  width="60" height="60" 
              class="mb-1"></b-img>
            <p>{{contactName}}</p>
            <hr>
            <b-form-checkbox
                name="checkbox-1">
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<style>
.card-body-scroll{
    max-height: calc(100vh - 126px);
    overflow-y: auto;
}
</style>


<script>
export default {
    props:{
        contactId: Number,
        contactName: String,
        contactImage: String,
        myImage: String,
        messages: Array 

    },
    data(){
        return{
            newMessage:'',
        }
    },
    mounted(){
      eventBus.$on('example', function(data){
          console.log('Ocurrio el evento example', data)
      });
    }, 
    methods: {
        postMessage(){
            const params = {
                to_id: this.contactId,
                content: this.newMessage,
            }
            axios.post('/api/messages', params)
                .then((response)=> {
                    if(response.data.succes){
                        this.newMessage = '';
                        const message = response.data.message;
                        message.written_by_me = true;
                        this.$emit('messageCreated', message)
                       
                    }else{
                        console.log('no');
                    }
                    
                }).catch((error) => {
                   console.log(error);
                });
        },

        scrollToBottom(){
            const el = document.querySelector('.card-body-scroll');
            el.scrollTop = el.scrollHeight;
        }

    },

    updated(){
        this.scrollToBottom();
    }

   
}
</script>