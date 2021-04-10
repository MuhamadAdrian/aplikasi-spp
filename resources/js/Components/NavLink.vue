<template>
	<inertia-link
		@click="playAnimation()"
		@mouseenter="mouseEnter()"
		@mouseleave="mouseLeave()"
		:href="href"
		:class="classes"
		class="relative w-full flex justify-between items-center px-4 active:transform active:scale-105 py-4 text-sm md:text-base transition-all duration-100"
	>
		<span class="flex items-center mx-2">
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

	emits: ["linkClicked"],

	data() {
		return {
			animationShowed: false,
			hovered: false,
		};
	},

	computed: {
		classes() {
			return this.active
				? "bg-gray-50 text-indigo-400 dark:bg-gray-700"
				: "hover:bg-gray-50 text-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-200";
		},
	},

	methods: {
		playAnimation() {
			this.animationShowed = true;
			this.$emit("linkClicked");
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
