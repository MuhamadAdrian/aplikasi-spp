<template>
	<button
		@click="toggleSideBarMobile"
		class="md:hidden p-4 bg-indigo-600 text-white rounded-full m-4 fixed bottom-0 right-0 z-40"
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
	props: {
		data: {
			default: false,
		},
	},
	emits: ["hamburgerClicked"],
	data() {
		return {
			openSideBar: this.data,
		};
	},
	methods: {
		toggleSideBarMobile() {
			this.openSideBar = !this.openSideBar;
			this.$emit("hamburgerClicked", this.openSideBar);
		},
	},
};
</script>