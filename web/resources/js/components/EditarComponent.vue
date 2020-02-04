<template>
    <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
        <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        <router-link :to="{name: 'listado'}" class="cursor-pointer bg-gray-700 hover:bg-gray-600 shadow-xl px-5 py-2 inline-block text-blue-100 hover:text-white rounded">
                    Volver
        </router-link>
        <button v-on:click="actualizar" class="cursor-pointer bg-teal-600 hover:bg-teal-500 shadow-xl px-5 py-2 inline-block text-teal-100 hover:text-white rounded">Actualizar</button>
        </div>
    <div class="px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
      <div class="-mx-3 md:flex mb-6">
        <div class="md:w-full px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
            Imagen
          </label>

          <dropzone id="thisRef" ref="dropzone" :options="dropzoneOptions" @vdropzone-success="vsuccess" @vdropzone-max-files-exceeded="vexceeded" :useCustomSlot=true>
              <img class="h-24 w-24 rounded mx-auto" :src="'/storage/files/' + form['avatar']">
              <div class="mt-4">Haz clic o arrastra una imagen para sustituir</div>
            </dropzone>
    
        </div>
      </div>  
      <div class="-mx-3 md:flex mb-6">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
            Nombre
          </label>
          <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="Laura" v-model="form['name']">
        </div>
        <div class="md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
            Apellidos
          </label>
          <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" placeholder="López" v-model="form['lastname']">
        </div>
      </div>
      <div class="-mx-3 md:flex mb-6">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
            Email
          </label>
          <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-3 px-4 mb-3" id="grid-first-name" type="text" placeholder="laura.lopez@gmail.com" v-model="form['email']">
          
        </div>
        <div class="md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
            Cargo
          </label>
          <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-last-name" type="text" placeholder="Rockstar Developer" v-model="form['position']">
        </div>
      </div>
      <div class="-mx-3 md:flex mb-2">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
            Centro de trabajo
          </label>
          <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="text" placeholder="Tenerife" v-model="form['office']">
        </div>
        <div class="md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
            Salario
          </label>
          <div class="relative">
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" type="number" placeholder="50.000" v-model="form['salary']">
          </div>
        </div>
        <div class="md:w-1/2 px-3">
          <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-zip">
            Horas semanales
          </label>
          <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-zip" type="number" placeholder="40" v-model="form['hours']">
        </div>
      </div>
    </div>
    </div>
</template>

<script>
import Dropzone from 'vue2-dropzone'

export default {
  components: {
    Dropzone
  },


  methods: {
    actualizar(){
        axios.put('/api/trabajadores/' + this.$route.params.id, this.form).then(res=>{
          this.$toast.success('Se ha actualizado el perfil correctamente');
          this.$router.push('/trabajadores');
        }).catch(error => {
         this.$toast.warning('Revisa todos los campos');
     });
    },
    vsuccess(file, response) {
      this.form['avatar'] = response.success;
    },
    vexceeded(file) {
        this.$refs.dropzone.removeAllFiles()

    }
  },
  data: function () {

    return {
      dropzoneOptions: {
          url: '/api/trabajadores/upload',
          thumbnailWidth: 150,
          maxFilesize: 0.5,
          acceptedFiles: '.jpg,.jpeg,.png',
          maxFiles: 1,
          headers: {'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content},
          dictDefaultMessage: "Actualizar imagen de perfil"
      },
      form: {},
      user: '',
    }
  },
  mounted () {
    axios.get('/api/trabajadores/' + this.$route.params.id).then(res=>{
          this.form = res.data;
        }).catch(error => {
         this.$toast.error('El usuario no existe');
         this.$router.push('/trabajadores');
    });
  },
}
</script>