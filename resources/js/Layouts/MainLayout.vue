<template>
	<div>
		<navbar
			@hamburgerClick="hamburgerClicked"
			class="transition-all duration-300"
			:class="[hideSideBar ? 'md:ml-72 ml-4/5' : 'md:ml-24 ml-0']"
		></navbar>
		<side-bar class="md:block hidden" :hide="hideSideBar"></side-bar>
		<!-- Mobile -->
		<side-bar-mobile
			class="md:hidden"
			:hide="hideSideBarMobile"
			@navClicked="onNavClicked"
		></side-bar-mobile>
		<hamburger-mobile
			class="md:hidden"
			:data="buttonPressed"
			@hamburgerClicked="clickedHandlerMobile"
		></hamburger-mobile>
		<!-- Mobile -->
		<main
			class="transition-all duration-300 bg-gray-50 min-h-screen h-full"
			:class="[hideSideBar ? 'md:ml-72 ml-4/5' : 'md:ml-24 ml-0']"
		>
			<slot></slot>
			<toast :toast="$page.props.toast"></toast>
		</main>
	</div>
</template>

<script>
import Navbar from "@/Components/Navbar";
import SideBar from "@/Components/SideBar";
import SideBarMobile from "@/Components/SideBarMobile";
import HamburgerMobile from "@/Components/Fab";
import { Inertia } from "@inertiajs/inertia";
import Toast from "@/Components/Toast";

export default {
	name: "MainLayout",
	components: {
		Navbar,
		SideBar,
		SideBarMobile,
		HamburgerMobile,
		Toast,
	},

	data() {
		return {
			hideSideBar: true,
			buttonPressed: null,
			isMobile: false,
			hideSideBarMobile: false,
			mediaQuery: window.matchMedia("(max-width: 768px)"),
		};
	},

	methods: {
		hamburgerClicked(isClicked) {
			this.hideSideBar = isClicked;
		},

		clickedHandlerMobile(value) {
			this.hideSideBarMobile = !this.hideSideBarMobile;
		},

		onNavClicked() {
			this.buttonPressed = true;
			this.hideSideBarMobile = !this.hideSideBarMobile;
		},

		onResize() {
			if (window.innerWidth < 768) {
				this.isMobile = true;
			} else {
				this.isMobile = false;
			}
		},
	},

	created() {
		this.onResize();
		window.addEventListener("resize", this.onResize);
	},

	mounted() {
		Inertia.on("success", (event) => {
			if (this.isMobile) {
				this.buttonPressed = true;
				this.hideSideBarMobile = !this.hideSideBarMobile;
			}
		});
	},

	beforeUnmount() {
		window.removeEventListener("resize", this.onResize);
	},
};
</script>