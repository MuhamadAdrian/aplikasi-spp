<template>
	<div>
		<aside
			@mouseenter="mouseEnter()"
			ref="sidebar"
			class="fixed top-0 left-0 bg-white dark:bg-gray-800 transition-all duration-200 min-h-screen h-full shadow-xl"
			:class="[!hiden ? 'md:w-72 w-4/5' : 'md:w-20 w-0']"
		>
			<div class="p-4 flex items-center">
				<inertia-link :href="route('dashboard')">
					<breeze-application-logo class="block h-9 w-auto" />
				</inertia-link>
				<fade-slide>
					<h1
						v-if="!hiden"
						class="font-semibold text-lg ml-2 whitespace-nowrap dark:text-gray-100"
					>
						Aplikasi SPP
					</h1>
				</fade-slide>
			</div>
			<ListMenu
				:is-mobile="false"
				:hide-text="hiden"
				:is-sidebar-hidden="hiden"
			></ListMenu>
		</aside>
	</div>
</template>

<script>
import ListMenu from "./ListMenu";
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import FadeSlide from "@/Components/FadeSlide";

export default {
	props: ["hide"],

	computed: {
		hiden() {
			return !this.hide;
		},
	},
	components: {
		ListMenu,
		BreezeApplicationLogo,
		FadeSlide,
	},

	methods: {
		mouseEnter() {
			if (this.hiden) {
				this.hiden = !this.hiden;
			}
		},
	},
};
</script>