import VueRouter from 'vue-router'

// Pages
import Shop from './pages/Shop'
import Login from './pages/Login'
import Charge from './pages/Charge'
import NotFound from './pages/NotFound'
import History from './pages/History'

import Deposit from './components/Deposit'
import Voucher from './components/Voucher'
import ChargeHistory from './components/ChargeHistory'
import BuyHistory from './components/BuyHistory'

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
        },
    },
    {
        path: '/charge',
        component: Charge,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                name: 'charge.index',
                component: Deposit
            },
            {
                name: 'charge.deposit',
                path: 'deposit',
                component: Deposit
            },
            {
                name: 'charge.voucher',
                path: 'voucher',
                component: Voucher
            },
        ]
    },
    {
        path: '/history',
        component: History,
        meta: {
            auth: {
                roles: true,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                name: 'history.index',
                component: ChargeHistory
            },
            {
                name: 'history.charge',
                path: 'charge',
                component: ChargeHistory
            },
            {
                name: 'history.buy',
                path: 'buy',
                component: BuyHistory
            },
        ]
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
