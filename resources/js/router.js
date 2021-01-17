import VueRouter from 'vue-router'

// Pages
import Shop from './components/Shop'
import Login from './pages/Login'
import Home from './pages/Home'
import NotFound from './pages/NotFound'

// Routes
const routes = [
    {
        path: '/',
        name: 'home',
        component: Shop,
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
        path: '/shop',
        name: 'shop',
        component: Shop,
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
    linkActiveClass: 'active',
    routes,
})

export default router
