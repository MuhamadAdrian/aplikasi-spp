<template>
	<inertia-link
		@click="playAnimation()"
		@mouseenter="mouseEnter()"
		@mouseleave="mouseLeave()"
		:href="href"
		:class="classes"
		class="relative w-full flex justify-between items-center px-4 active:transform active:scale-105 py-3 text-sm md:text-base rounded-md transition-all duration-100 mb-2"
	>
		<span class="flex items-center">
			<slot />
		</span>
		<spin-animation :animation-showed="animationShowed"></spin-animation>
		<popup :show="hovered" :text="popupText"></popup>
	</inertia-link>
</template>

<script>
import SpinAnimation from "@/Components/SpinAnimation";
import Popup from "@/Components/Popup";
import { Inertia } from "@inertiajs/inertia";
export default {
	components: {
		SpinAnimation,
		Popup,
	},

	props: [
		"href",
		"active",
		"successfullyVisit",
		"popupText",
		"isSidebarHidden",
	],

	data() {
		return {
			animationShowed: false,
			hovered: false,
		};
	},

	computed: {
		classes() {
			return this.active
				? "bg-indigo-400 text-white hover:bg-indigo-500"
				: "bg-gray-50 hover:bg-gray-100 text-gray-600";
		},
	},

	methods: {
		playAnimation() {
			this.animationShowed = true;
		},

		mouseEnter() {
			if (this.isSidebarHidden) {
				this.hovered = true;
			}
		},
		mouseLeave() {
			if (this.isSidebarHidden) {
				this.hovered = false;
			}
		},
	},

	mounted() {
		Inertia.on("success", (event) => {
			setTimeout(() => {
				this.animationShowed = false;
			}, 1000);
		});
	},
};
</script>
