<template>
  
    <b-container>
    <b-form class="m-3"  action="/profile" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" v-model="csrfToken">  
      <b-form-group
        label="Correo electrónico:"
        disabled
      >
        <b-form-input
          v-model="user.email"
          type="email"
        ></b-form-input>
      </b-form-group>

      <b-form-group  label="Nombre:">
        <b-form-input
          v-model="user.name"
          name="name"
          placeholder="Ingresa tu nombre"
          required
        ></b-form-input>
      </b-form-group>

     <b-form-group  label="Nueva contraseña (sólo si dse desea modificar): ">
        <b-form-input
          name="password"
          type="password"
          placeholder="Ingresa una nueva contraseña"
          
        ></b-form-input>
      </b-form-group>

      <b-form-group  label="Imagen de perfil (sólo si dse desea modificar):">
        
        <b-img :src="image" rounded="circle" width="60" height="60" 
         alt="Imagen de perfil"  class="mb-1"></b-img>
        
        <b-form-file
          name="image"
          placeholder="Suba una imagen de perfil"
          
        ></b-form-file>
      </b-form-group>

      

      <b-button type="submit" variant="primary">Guardar cambios</b-button>
      
    </b-form>
    
  </b-container>
  
</template>

<script>
  export default {
    props:{
      user: Object,
      csrfToken: String,
    },
    data() {
      return {
        
      }
    },
    computed: {
      image(){
        return `/usuarios/${this.user.image}`;
      }
    }
  
  
  }
</script>
