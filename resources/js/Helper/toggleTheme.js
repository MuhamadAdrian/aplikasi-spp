export default {
    data: () => ({
        is_dark: false,
    }),

    computed: {
        isDark() {
            return this.is_dark;
        },
    },

    watch: {
        is_dark(newVal, oldVal) {
            console.log(newVal);
        },
    },

    methods: {
        toggleTheme() {
            this.is_dark = !this.is_dark;
            localStorage.setItem("dark", JSON.stringify(this.is_dark));
            if (JSON.parse(localStorage.getItem("dark")) == true) {
                document.documentElement.classList.add("dark");
            } else {
                document.documentElement.classList.remove("dark");
            }
        },
    },

    mounted() {
        if (JSON.parse(localStorage.getItem("dark")) == true) {
            this.is_dark = true;
        } else {
            this.is_dark = false;
        }
    },
};
