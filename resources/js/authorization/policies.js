export default {
    accept (user, product) {
        return user.id === product.user.id;
    },
}