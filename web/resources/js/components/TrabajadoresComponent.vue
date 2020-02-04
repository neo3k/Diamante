<template>
<div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        <router-link :to="{name: 'nuevo'}" class="cursor-pointer bg-blue-600 hover:bg-blue-500 shadow-xl px-5 py-2 inline-block text-blue-100 hover:text-white rounded">
                    Nuevo
        </router-link>
    </div>
    <div class="w-full p-6">
        <div>
            <vue-good-table
              :columns="columns"
              :rows="rows"
              ref="table"
              :pagination-options="{
                enabled: true,
                mode: 'pages'
              }"
              :search-options="{
                enabled: true,
                placeholder: 'Buscar'
              }"
              styleClass="vgt-table">
              <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'avatar'">
                  <img class="h-8 w-8 rounded mx-auto" :src="'/storage/files/' + props.row.avatar">
                </span>
                <span v-else-if="props.column.field == '_id'">
                    <div class="flex">
                        <router-link :to="{ name: 'editar', params: {id: props.row._id } }" aria-label="Edit user"
                                class="p-1 focus:outline-none focus:shadow-outline text-teal-500 hover:text-teal-600"
                                content="Editar" v-tippy>
                            <EditIcon/>
                        </router-link>
                        <button aria-label="Delete user"
                                class="p-1 focus:outline-none focus:shadow-outline text-red-500 hover:text-red-600"
                                v-on:click="eliminar(props.row._id, props.index)" content="Eliminar" v-tippy>
                            <Trash2Icon/>
                        </button>
                    </div>
                </span>
                <span v-else>
                  {{props.formattedRow[props.column.field]}}
                </span>
              </template>
              </vue-good-table>
        </div>
    </div>
</div>
</template>

<script>
export default {
  name: 'my-component',
  data(){
    return {
      columns: [
        {
          label: '',
          field: 'avatar',
          html: true,
          sortable: false,
        },
        {
          label: 'Nombre',
          field: 'name',
        },
        {
          label: 'Apellidos',
          field: 'lastname',
        },
        {
          label: 'Email',
          field: 'email',
        },
        {
          label: 'Cargo',
          field: 'position',
        },
        {
          label: 'Centro de trabajo',
          field: 'office',
        },
        {
          label: 'Salario',
          field: 'salary',
          type: 'number',
        },
        {
          label: 'Horas semanales',
          field: 'hours',
          type: 'number',
        },
        {
          label: 'Acciones',
          field: '_id',
        },
      ],
      rows: [],
    };
  },
  methods: {
            listar() {
                return axios.get('/api/trabajadores').then(response => {
                    this.rows = response.data;
                });
            },
            eliminar(id, row) {
                return axios.delete('/api/trabajadores/' + id).then(response => {
                    this.rows.splice(row, 1);
                });
            }
  },
  mounted() {
           this.listar()
  }
};
</script>