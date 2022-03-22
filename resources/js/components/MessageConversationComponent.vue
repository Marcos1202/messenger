<template>
    <b-media :right-align="WrittenByMe" vertical-align="center"  class="mb-2">
        <template #aside>
            <b-img :src="image"  rounded="circle" width="48" height="48" ></b-img>
        </template>
        <b-card >
            <slot>
            </slot>
                {{ content}}
        </b-card>
    </b-media>
</template>

<script>
export default {
    props:{
        image:String,
        WrittenByMe:Boolean
    },
    
    data(){
        return {
            content: ""
        }
    },
    mounted(){
        //axios.get('/api/messages').then((response)=> console.log(response));
    }
}
</script>