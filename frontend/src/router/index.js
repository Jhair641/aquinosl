import { h, resolveComponent } from 'vue'
import { createRouter, createWebHashHistory } from 'vue-router'

import DefaultLayout from '@/layouts/DefaultLayout'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: DefaultLayout,
    redirect: '/dashboard/empleados',
    children: [
      {
        path: '/dashboard',
        name: 'Dashboard',
        redirect: '/dashboard/empleados'
      },
      {
        path: '/dashboard/empleados',
        name: 'Empleados',
        component: () => import('@/views/empleados/Empleados.vue'),
      },
      {
        path: '/dashboard/clientes',
        name: 'Clientes',
        component: () => import('@/views/clientes/Clientes.vue'),
      },
      {
        path: '/dashboard/cargas',
        name: 'Cargas',
        component: () => import('@/views/cargas/Cargas.vue'),
      },
      {
        path: '/dashboard/vehiculos',
        name: 'Vehiculos',
        component: () => import('@/views/vehiculos/Vehiculos.vue'),
      },
      {
        path: '/facturacion',
        name: 'Facturacion',
        redirect: '/facturacion/cargas'
      },
      {
        path: '/facturacion/cargas',
        name: 'Cfacturacion',
        component: () => import('@/views/facturacion/Cargas.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior() {
    // always scroll to top
    return { top: 0 }
  },
})

export default router
