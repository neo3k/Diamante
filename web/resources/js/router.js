import VueRouter from 'vue-router'

// Pages
import Trabajadores from './components/TrabajadoresComponent.vue'
import Nuevo from './components/NuevoComponent.vue'
import Editar from './components/EditarComponent.vue'

// Routes
const routes = [
  {
    path: '/trabajadores',
    name: 'listado',
    component: Trabajadores,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/trabajadores/nuevo',
    name: 'nuevo',
    component: Nuevo,
    meta: {
      auth: true
    }
  },
  {
    path: '/trabajadores/:id',
    name: 'editar',
    component: Editar,
    meta: {
      auth: undefined
    }
  }
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router