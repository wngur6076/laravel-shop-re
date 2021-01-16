import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Login from './pages/Login'
import NotFound from './pages/NotFound'

// Routes
const routes = [{
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    },
    {
        path: '*',
        component: NotFound
    }
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router
