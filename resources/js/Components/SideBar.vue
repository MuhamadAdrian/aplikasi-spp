<template>
	<div>
		<aside
			ref="sidebar"
			class="fixed top-0 left-0 bg-white transition-all duration-300 min-h-screen h-full shadow-lg"
			:class="[!hiden ? 'md:w-72 w-4/5' : 'md:w-24 w-0']"
		>
			<div class="p-4 flex items-center">
				<inertia-link :href="route('dashboard')">
					<breeze-application-logo class="block h-9 w-auto" />
				</inertia-link>
				<fade-slide>
					<h1
						v-if="!hiden"
						class="font-semibold text-lg ml-2 whitespace-nowrap"
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
};
</script>