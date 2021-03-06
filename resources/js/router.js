import VueRouter from 'vue-router'

// Pages
import Shop from './pages/Shop'
import Login from './pages/Login'
import Base from './pages/Base'
import NotFound from './pages/NotFound'

import DepositCharge from './pages/DepositCharge'
import VoucherCharge from './pages/VoucherCharge'
import ChargeHistory from './pages/ChargeHistory'
import PurchaseHistory from './pages/PurchaseHistory'
import SalesHistory from './pages/SalesHistory'
import MyProducts from './pages/MyProducts'
import ChargeAccept from './pages/ChargeAccept'
import SalesAuthority from './pages/SalesAuthority'

import SocialLogin from './pages/SocialLogin'
import AuthConfirm from './pages/AuthConfirm'
import PasswordReset from './pages/PasswordReset'

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
        path: '/tags/:slug',
        name: 'tags.shop',
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
        component: Base,
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
                component: DepositCharge
            },
            {
                name: 'charge.deposit',
                path: 'deposit',
                component: DepositCharge
            },
            {
                name: 'charge.voucher',
                path: 'voucher',
                component: VoucherCharge
            },
        ]
    },
    {
        path: '/history',
        component: Base,
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
                name: 'history.purchase',
                path: 'purchase',
                component: PurchaseHistory
            },
        ]
    },
    {
        path: '/admin',
        component: Base,
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
                name: 'admin.index',
                component: SalesHistory
            },
            {
                name: 'admin.sales',
                path: 'sales',
                component: SalesHistory
            },
            {
                name: 'admin.my-products',
                path: 'myproducts',
                component: MyProducts
            },
        ]
    },
    {
        path: '/super',
        component: Base,
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
                name: 'super.index',
                component: ChargeAccept
            },
            {
                name: 'super.accept',
                path: 'accept',
                component: ChargeAccept
            },
            {
                name: 'super.sales-authority',
                path: 'authority',
                component: SalesAuthority
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
        path: '/social/:provider',
        component: SocialLogin,
    },
    {
        path: '/auth/confirm',
        component: AuthConfirm
    },
    {
        path: '/password/reset',
        component: PasswordReset,
        meta: {
            auth: {
                roles: false,
                redirect: {
                    name: 'home'
                },
                forbiddenRedirect: '/403'
            }
        },
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
    scrollBehavior (to, from, savedPosition) { return { x: 0, y: 0 } },
    routes,
})

export default router
