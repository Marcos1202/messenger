<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters class="h-100">
            <b-col cols="4" >
                <b-form class="my-3 mx-2">
                    <b-form-input  class="text-center"
                        type="text"
                        v-model="querySearch"
                        placeholder="Buscar contacto"
                    ></b-form-input>
                </b-form>
                <contact-list-component 
                @conversationSelected="changeActiveConversation($event)"
                :conversations="conversationsFiltered">
                </contact-list-component>
            </b-col>
            <b-col cols="8" >
                <active-conversation-component
                v-if="selectedConversation"
                    :contact-id="selectedConversation.contact_id"
                    :contact-name="selectedConversation.contact_name"
                    :contact-image="selectedConversation.contact_image"
                    :my-image="MyImageUrl"
                    :messages="messages"
                    @messageCreated="addMessage($event)">
                </active-conversation-component>
            </b-col>
            
        </b-row>
    </b-container>

</template>

<script>
export default {
    props:{
        user: Object
    },
    data(){
        return {
            selectedConversation: null,
            messages: [],
            conversations: [],
            querySearch: '',
        }
    },
    mounted(){
        this.getConversations();

    Echo.private(`users.${this.user.id}`)
        .listen('MessageSent', (data) => {
            const message = data.message
            message.written_by_me = false;
            
            this.addMessage(message)
    });

    Echo.join('messenger')
        .here((users) => {
            users.forEach((user) => {
                this.ChangeStatus(user, true)
            });
        })
        .joining((user) =>{
            this.ChangeStatus(user, true)
        })
        .leaving((user) => {
             this.ChangeStatus(user, false)
        })

    },
    methods:{
        changeActiveConversation(conversation){
            this.selectedConversation = conversation;
            this.getMessages();
        },

        getMessages(){
            axios.get(`/api/messages?contact_id=${this.selectedConversation.contact_id}`)
            .then((response)=> {
               this.messages = response.data;
              // console.log(response.data);
            });
        },

        addMessage(message){ 
            const conversation = this.conversations.find(function (conversation) {
                return conversation.contact_id == message.from_id || 
                conversation.contact_id == message.to_id;
            });
            console.log()
            const author = this.user.id === message.from_id ? 'Tú' : conversation.contact_name;
            conversation.last_message =`${author}: ${message.content}`;
            conversation.last_time = message.created_at;

            if(this.selectedConversation.contact_id == message.from_id ||
            this.selectedConversation.contact_id == message.to_id){  
                this.messages.push(message);
            }
        },
        
        getConversations(){
            axios.get('/api/conversation')
                .then((response) => {
                    this.conversations = response.data;
                }).catch((error) => {
                    console.log(error);
                });
        },

        ChangeStatus(user, status){
            const index = this.conversations.findIndex((conversation) =>{
                //console.log(conversation.conversation_id);
                return conversation.contact_id == user.id;
            });
            if(index >= 0){
                this.$set(this.conversations[index], 'online', status )
            }
            //console.log(user.id);
        }

    },
    computed: {
        conversationsFiltered(){
            return this.conversations.filter(
                (conversation) => 
                conversation.contact_name.toLowerCase().includes(this.querySearch.toLowerCase())
            );
        },
        MyImageUrl(){
            return `/usuarios/${this.user.image}`
        }
    }
}
</script>