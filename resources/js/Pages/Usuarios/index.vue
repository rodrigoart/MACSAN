<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'datatables.net-vue3';
import { Head, Link } from '@inertiajs/inertia-vue3';

const options = {
    columnDefs: [
        { orderable: false, targets: 2 },
    ],
    "language": {
        "info": "Pagina _PAGE_ de _PAGES_",
        "decimal":        "",
        "emptyTable":     "No hay datos",
        "infoEmpty":      "Showing 0 to 0 of 0 registros",
        "infoFiltered":   "(filtrado de _MAX_ total registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     " _MENU_  registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "No se encontro ningun dato",
        "paginate": {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
    },
};

defineProps({
    users: Array,
    user: Object,
    errors: Object,
});
</script>
<script>
export default{
    data() {
        return {
            editMode: false,
            isOpen: false,
            current_user: this.user,
            form: {
                name: '',
                email: '',
                password: '',
                role: '',
            },
        }
    },
    methods: {
        openModal() {
            this.isOpen = true;
        },
        closeModal() {
            this.isOpen = false;
            this.reset();
            this.editMode=false;
        },
        reset() {
            this.form = {
                body: null,
            }
        },
        edit(data) {
            this.form = Object.assign({}, data);
            this.editMode = true;
            this.openModal();
        },
        update(data) {
            data._method = 'PATCH';
            this.$inertia.put(this.route('usuario.update', data.id), data, {
                preserveScroll: true
            });
            this.reset();
            this.closeModal();
        },
        deleteRow(data) {
            if (!confirm('Desea eliminar el usuario?')) return;
            data._method = 'DELETE';
            this.$inertia.delete(this.route('usuario.destroy', data.id), {
                preserveScroll: true
            });
            this.reset();
            this.closeModal();
        },
    },
}
</script>
<style>
@import 'datatables.net-dt';
</style>

<template>
<AppLayout title="Usuarios">
    <template #header>
        <div>
            <h2 class="font-semibold text-m text-gray-800 leading-tight">
                Lista de usuarios registrados
            </h2>
        </div>
    </template>

    <div v-if="current_user.role == 'Administrador' || current_user.role == 'Normal'" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <Link v-if="current_user.role == 'Administrador'" :href="route('usuario.create')" class="inline-flex items-center px-4 py-2 mb-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Registrar Nuevo Usuario </Link>
                <!-- <Link :href="route('register')" class="ml-4 text-sm text-gray-700 " -->
                <!-- </Link> -->


                <div class="overflow-x-auto relative shadow-md sm:rounded-lg mt-6">

                    <DataTable class="w-full text-sm text-left text-gray-500 pt-4" :options="options">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="p-4">
                                    Codigo
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nombre
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Rol
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Fecha Creación
                                </th>
                                <th v-if="current_user.role == 'Administrador'" scope="col" class="py-3 px-6">
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user of users" class="bg-white border-b ">
                                <td class="p-4 w-4">
                                    <div class="flex items-center">
                                        {{ user.id }}
                                    </div>
                                </td>
                                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap ">
                                    <img class="w-10 h-10 rounded-full" :src="user.profile_photo_url" :alt="image">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            <Link :href="route('usuario.show', user.id)" class="underline text-blue-500 hover:text-blue-700">
                                            {{ user.name }}
                                            </Link>
                                        </div>
                                        <div class="font-normal text-gray-500">{{ user.email }}</div>
                                    </div>
                                </th>
                                <td class="py-4 px-6">
                                    {{ user.role }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ user.created_at }}
                                </td>
                                <td v-if="current_user.role == 'Administrador'" class="py-4 px-6">
                                    <div>
                                        <button @click="edit(user)" class="inline-flex items-center mr-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"> Editar </button>

                                        <button @click.prevent="deleteRow(user)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </DataTable>
                </div>


            </div>
        </div>
    </div>
    <div v-else>
        No tienes acceso a esta vista, para mas informacion comuncate con un usuario administrador.
    </div>




                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                      <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div class="fixed inset-0 transition-opacity">
                          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">



                          <form>






                                <div class="mt-5 md:col-span-2 md:mt-0">
                                    <div class="overflow-hidden shadow sm:rounded-md">
                                        <div class="bg-white px-4 py-5 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">

                                                <div class="col-span-6">
                                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Rol de usuario</label>
                                                        <select name="role" id="role" v-model="form.role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                        >
                                                            <option value="Administrador">Administrador - control total</option>
                                                            <option value="Normal" >Normal - ver y editar</option>
                                                            <option value="Visitante">Visitante - ver</option>
                                                        </select>
                                                    <div v-if="errors.role" class="text-red-500">{{ errors.role }}</div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>



                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">


                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click.prevent="update(form)">
                                  Actualizar
                              </button>
                            </span>

                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                  Cancelar
                              </button>
                            </span>

                          </div>
                          </form>



                        </div>
                      </div>
                    </div>


    </AppLayout>
</template>
