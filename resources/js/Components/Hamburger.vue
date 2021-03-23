<template>
	<button
		@click="toggleSideBar"
		class="md:block hidden hover:bg-gray-100 mtext-black bg-white p-4 rounded-full"
	>
		<svg
			ref="anu"
			xmlns="http://www.w3.org/2000/svg"
			height="24"
			viewBox="0 0 24 24"
			width="24"
			class="fill-current"
		>
			<path d="M0 0h24v24H0z" fill="none" />
			<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
		</svg>
	</button>
</template>

<script>
export default {
	data() {
		return {
			clicked: true,
			mediaQuery: null,
		};
	},

	emits: ["hamburgerClicked"],

	methods: {
		toggleSideBar() {
			this.clicked = !this.clicked;
			this.$emit("hamburgerClicked", this.clicked);
		},
	},
};
</script>