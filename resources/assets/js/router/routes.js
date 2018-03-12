const Welcome = () => import('~/pages/welcome')
const Login = () => import('~/pages/auth/login')
const Register = () => import('~/pages/auth/register')
const PasswordEmail = () => import('~/pages/auth/password/email')
const PasswordReset = () => import('~/pages/auth/password/reset')

const Home = () => import('~/pages/home')
const Settings = () => import('~/pages/settings/index')
const SettingsProfile = () => import('~/pages/settings/profile')
const SettingsPassword = () => import('~/pages/settings/password')

const Users = () => import('~/pages/admin/users/index.vue')
const UsersTable = () => import('~/pages/admin/users/table.vue')
const UsersCreate = () => import('~/pages/admin/users/create.vue')

const Clubs = () => import('~/pages/clubs/index.vue')
const ClubsTable = () => import('~/pages/clubs/table.vue')
const ClubsForm = () => import('~/pages/clubs/form.vue')

const Tables = () => import('~/pages/tables/index.vue')
const TablesTable = () => import('~/pages/tables/table.vue')
const TablesForm = () => import('~/pages/tables/form.vue')

export default [
  { path: '/', name: 'welcome', component: Welcome },

  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  { path: '/home', name: 'home', component: Home },
  { path: '/settings', component: Settings, children: [
    { path: '', redirect: { name: 'settings.profile' }},
    { path: 'profile', name: 'settings.profile', component: SettingsProfile },
    { path: 'password', name: 'settings.password', component: SettingsPassword }
  ] },

  { path: '/users', component: Users, children: [
    { path: '', name: 'users.table', component: UsersTable },
    { path: 'create', name: 'users.create', component: UsersCreate },
  ] },

  { path: '/clubs', component: Clubs, children: [
    { path: '', name: 'clubs.table', component: ClubsTable },
    { path: 'create', name: 'clubs.create', component: ClubsForm },
    { path: 'edite/:id', name: 'clubs.edit', component: ClubsForm },
  ] },

  { path: '/tables', component: Tables, children: [
    { path: '', name: 'tables.table', component: TablesTable },
    { path: 'create', name: 'tables.create', component: TablesForm },
    { path: 'edite/:id', name: 'tables.edit', component: TablesForm },
  ] },

  { path: '*', component: require('~/pages/errors/404') }
]
