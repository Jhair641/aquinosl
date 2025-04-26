export default [
  {
    component: 'CNavTitle',
    name: 'Gestión',
  },
  {
    component: 'CNavItem',
    name: 'Empleados',
    to: '/dashboard/empleados',
    icon: 'cil-people',
  },
  {
    component: 'CNavItem',
    name: 'Clientes',
    to: '/dashboard/clientes',
    icon: 'cil-list',
  },
  {
    component: 'CNavItem',
    name: 'Cargas',
    to: '/dashboard/cargas',
    icon: 'cil-list',
  },
  {
    component: 'CNavItem',
    name: 'Vehiculos',
    to: '/dashboard/vehiculos',
    icon: 'cil-list',
  },
  {
    component: 'CNavTitle',
    name: 'Facturación',
  },
  {
    component: 'CNavItem',
    name: 'Cargas',
    to: '/facturacion/cargas',
    icon: 'cil-list',
  },
]
