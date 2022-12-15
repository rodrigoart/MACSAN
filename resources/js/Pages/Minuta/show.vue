<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
const today = new Date();
const today_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()
</script>

<script>
    export default {
        props: {
            errors: Object,
            user: Object,
            minutum: Object,
            problemas: Array,
        },

    data () {
        return {
            editMode: false,
            isOpen: false,
            form: {
                minuta_id: this.minutum.id,
                user_id: this.user.id,
                responsable: '',
                causas: '',
                descripcion: '',
                recursos: '',
                acciones: '',
                fecha_aplicacion: '',
                fecha_solucioando: '',
                logros: '',
                solucionado: false,
            }
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
                minuta_id: this.minutum.id,
                supervisor: null,
                body: null,
            }
        },
        save(data) {
            this.$inertia.post(this.route('problema.store'), data,{
                preserveScroll: true
            });
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        edit(data) {
            this.form = Object.assign({}, data);
            if(this.form.solucionado){
                this.form.solucionado = true;
            }
            this.editMode = true;
            this.openModal();
        },
        update(data) {
            data.user_id = this.user.id;
            if(data.solucionado){
                data.fecha_solucionado = this.today_date;
            }else{
                data.fecha_solucionado = null;
            }
            data._method = 'PATCH';
            this.$inertia.put(this.route('problema.update', data.id), data, {
                preserveScroll: true
            });
            this.reset();
            this.closeModal();
        },
        deleteRow(data) {
            if (!confirm('Desea eliminar el problema a solucionar?')) return;
            data._method = 'DELETE';
            this.$inertia.delete(this.route('problema.destroy', data.id), {
                preserveScroll: true
            });
            this.reset();
            this.closeModal();
        },
    }

    }
</script>

<template>
<AppLayout title="Dashboard">
    <template #header>
        <h2 class="font-semibold text-m text-gray-800 leading-tight">
            Vista Hoja de Minuta {{ today_date }}
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">

                <div class="overflow-hidden bg-white shadow sm:rounded-lg">

                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Hoja de minuta - {{ minutum.id }}</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles de la hoja de minuta, ultima actualizacion   {{ minutum.updated_at }} por
                            <Link :href="route('usuario.show', minutum.actualizado.id)" class="underline text-blue-500 hover:text-blue-700">
                                {{ minutum.actualizado.name }}
                            </Link>
                        </p>
                    </div>

                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Creado por</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                    <Link :href="route('usuario.show', minutum.user.id)" class="underline text-blue-500 hover:text-blue-700">
                                        {{ minutum.user.name }}
                                    </Link>
                                </dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Fecha analisis</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                        {{ minutum.fecha_analisis }}
                                </dd>
                            </div>

                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Distrito</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ minutum.distrito }}</dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Responsable</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ minutum.responsable }}</dd>
                            </div>

                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Participantes</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ minutum.participantes }}</dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Fecha Inicio</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ minutum.fecha_inicio }}</dd>
                            </div>

                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Fecha Final</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ minutum.fecha_final }}</dd>
                            </div>

                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Observaciones</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ minutum.observaciones }}</dd>
                            </div>

                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500"></dt>
                                <Link v-if="user.role !== 'Visitante'" :href="route('minuta.edit', minutum)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    Editar cabecera hoja de minuta
                                </Link>
                                <a v-if="user.role !== 'Visitante'" :href="route('minuta-pdf', minutum.id)" :target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    Exportar PDF
                                </a>
                            </div>

                        </dl>
                    </div>
                </div>

                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Problemas a solucionar de la hoja de minuta</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles de los problemas a solucionar la hoja de minuta </p>
                </div>

                <div>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                            <button v-if="user.role !== 'Visitante'" @click="openModal()" class="inline-flex items-center mb-5 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Agregar Problema a solucionar</button>



                            <div v-for="problema in problemas" :key="problema.id"  class="overflow-x-auto relative shadow-md sm:rounded-lg mb-6">
                                <table :id="problema.fecha_aplicacion" class="w-full text-sm text-left text-gray-500 ">
                                    <thead class="text-xs text-gray-700 uppercase ">
                                        <tr>
                                            <th scope="col" class="py-2 px-4 bg-gray-50 ">
                                                Descripcion
                                            </th>
                                            <th scope="col" class="py-2 px-4">
                                                Responsable
                                            </th>
                                            <th scope="col" class="py-2 px-4 bg-gray-50 ">
                                                Causa
                                            </th>
                                            <th scope="col" class="py-2 px-4">
                                                Fecha Aplicacion
                                            </th>
                                            <th scope="col" class="py-2 px-4 bg-gray-50">
                                                Estado
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200 ">
                                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap bg-gray-50 ">
                                                {{ problema.descripcion }}
                                            </th>
                                            <td class="py-2 px-4">
                                                {{ problema.responsable }}
                                            </td>
                                            <td class="py-2 px-4 bg-gray-50 ">
                                                {{ problema.causas }}
                                            </td>
                                            <td class="py-2 px-4">
                                                {{ problema.fecha_aplicacion }}
                                            </td>
                                            <td class="py-2 px-4 bg-gray-50 ">
                                                <span v-if="!problema.solucionado"> En progreso </span>
                                                <span v-else> Solucionado, {{ problema.fecha_solucionado }} </span>
                                            </td>
                                        </tr>
                                        <tr class="text-xs text-gray-700 uppercase  font-black">
                                            <td scope="col" class="py-3 px-6 bg-gray-50 ">
                                                Recursos
                                            </td>
                                            <td class="py-2 px-4" colspan="2">
                                                Acciones
                                            </td>
                                            <td class="py-2 px-4 bg-gray-50 " colspan="2">
                                                Logros
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 ">
                                            <td class="py-2 px-4 bg-gray-50 ">
                                                {{ problema.recursos }}
                                            </td>
                                            <td class="py-2 px-4" colspan="2">
                                                {{ problema.acciones }}
                                            </td>
                                            <td class="py-2 px-4 bg-gray-50 " colspan="2">
                                                {{ problema.logros }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200 ">
                                            <td class="py-2 px-4" colspan="4">
                                                Ultima actualizacion  {{ problema.updated_at }} por
                                                <Link v-if="problema.user" :href="route('usuario.show', problema.user.id)" class="underline text-blue-500 hover:text-blue-700">
                                                    {{ problema.user.name }}
                                                </Link>
                                            </td>
                                            <td  v-if="user.role !== 'Visitante'" class="py-2 px-4 bg-gray-50 " >
                                                <div class="flex justify-end">
                                                    <button @click="edit(problema)" class="inline-flex items-center mr-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"> Editar </button>

                                                    <button @click.prevent="deleteRow(problema)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Eliminar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripcion</label>
                                                <input type="text" name="descripcion" id="descripcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" v-model="form.descripcion"/>
                                                <div v-if="errors.descripcion" class="text-red-500">{{ errors.descripcion }}</div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="responsable" class="block text-sm font-medium text-gray-700">Responsable</label>
                                                <input type="text" name="responsable" id="responsable" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"  placeholder="Responsable" v-model="form.responsable"/>
                                                <div v-if="errors.responsable" class="text-red-500">{{ errors.responsable }}</div>
                                            </div>

                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="fecha_aplicacion" class="block text-sm font-medium text-gray-700">Fecha Aplicacion</label>
                                                <input type="date" name="fecha_aplicacion" id="fecha_aplicacion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" v-model="form.fecha_aplicacion"/>
                                                <div v-if="errors.fecha_aplicacion" class="text-red-500">{{ errors.fecha_aplicacion }}</div>
                                            </div>


                                            <div class="col-span-6">
                                                <label for="causas" class="block text-sm font-medium text-gray-700">Causas</label>
                                                <input type="text" name="causas" id="causas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" v-model="form.causas"/>
                                                <div v-if="errors.causas" class="text-red-500">{{ errors.causas }}</div>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="acciones" class="block text-sm font-medium text-gray-700">Acciones</label>
                                                <input type="text" name="acciones" id="acciones" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" v-model="form.acciones"/>
                                                <div v-if="errors.acciones" class="text-red-500">{{ errors.acciones }}</div>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="logros" class="block text-sm font-medium text-gray-700">Logros</label>
                                                <input type="text" name="logros" id="logros" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" v-model="form.logros"/>
                                                <div v-if="errors.logros" class="text-red-500">{{ errors.logros }}</div>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="recursos" class="block text-sm font-medium text-gray-700">Recursos</label>
                                                <input type="text" name="recursos" id="recursos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" v-model="form.recursos"/>
                                                <div v-if="errors.recursos" class="text-red-500">{{ errors.recursos }}</div>
                                            </div>

                                            <div v-if="editMode" class="col-span-6 sm:col-span-4 mb-4">
                                                <div class="flex items-center">
                                                    <input id="solucionado" name="solucionado" type="checkbox" v-model="form.solucionado"  class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    <label for="solucionado" class="ml-2 block text-sm text-gray-900">
                                                        <span v-if="form.solucionado">Marcar como: "En progreso"</span>
                                                        <span v-else>Marcar como: "Solucionado"</span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>



                          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                              <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-indigo-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click.prevent="save(form)">
                                  Guardar
                              </button>
                            </span>

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
                </div>
            </div>
        </div>
              </div>
            </div>
        </div>
    </AppLayout>
</template>
