import VueRouter from 'vue-router'

// Pages
import Shop from './pages/Shop'
import Login from './pages/Login'
import Charge from './pages/Charge'
import ChargeHistory from './pages/ChargeHistory'
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
        path: '/charge',
        name: 'charge',
        component: Charge,
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
        path: '/history/charge',
        name: 'history.charge',
        component: ChargeHistory,
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
