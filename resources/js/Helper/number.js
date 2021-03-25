export default {
    computed: {
        number() {
            return (this.data.current_page - 1) * this.data.per_page + 1;
        },
    },
};
