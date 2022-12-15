<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Link from '@inertiajs/inertia-vue3';

defineProps({
    usuario: Object,
});

</script>
<script>
    export default {

    data () {
        return {
          link_wats: "https://api.whatsapp.com/send?phone=502" + this.usuario.contact,
        }
    },


    }
</script>

<template>
  <AppLayout title="Dashboard">
      <template #header>
          <div>
              <h2 class="font-semibold text-m text-gray-800 leading-tight">
                Vista de usuario individual
              </h2>
          </div>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white shadow-xl sm:rounded-lg p-5 mt-10">



                    <div class="grid grid-cols-1 md:grid-cols-3 z-50">
                      <div class="text-center order-last md:order-first mt-20 md:mt-0">
                        <div>
                            <p class="font-bold text-gray-700 text-l">Miembro desde</p>
                            <p class="text-gray-400">{{ usuario.created_at }}</p>
                        </div>
                        </div>
                        <div class="relative">
                          <div class="w-48 h-48 bg-indigo-100 mx-auto rounded-full shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500">
                            <div v-if="usuario.profile_photo_url">
                              <img class="rounded-full" :src="usuario.profile_photo_url" :alt="image" width="100">
                            </div>
                            <div v-else>
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                            </div>
                          </div>
                        </div>
                        <div class=" mt-32 md:mt-0 text-center">
                          <a :href="link_wats" target="_blank"  class="inline-block px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-indigo-600 rounded-full shadow ripple hover:shadow-lg hover:bg-indigo-600 focus:outline-none">Mensaje
                          </a>
                        </div>
                        </div>

                        <div class="mt-20 text-center border-b pb-12">
                          <h1 class="text-4xl font-medium text-gray-700"> {{ usuario.name }}</h1>
                          <p class="font-light text-gray-600 mt-3"> {{ usuario.email }} </p>

                          <p class="mt-8 text-gray-500">Rol - {{ usuario.role }}</p>
                        </div>




              </div>
          </div>
      </div>
  </AppLayout>
</template>
