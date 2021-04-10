<template>
	<div>
		<navbar
			@hamburgerClick="hamburgerClicked"
			class="transition-all duration-200"
			:class="[hideSideBar ? 'md:ml-72 ml-4/5' : 'md:ml-20 ml-0']"
		></navbar>
		<div class="fixed top-0 right-0 p-4 z-50 md:hidden">
			<div
				class="bg-white dark:bg-gray-700 dark:text-gray-300 py-2 px-3 rounded text-xs shadow"
			>
				<p v-if="$page.props.auth.user.level">
					{{ $page.props.auth.user.nama_petugas }}
				</p>
				<p v-else>{{ $page.props.auth.user.nama }}</p>
			</div>
		</div>
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
			class="transition-all dark:bg-gray-900 duration-200 bg-gray-50 min-h-screen md:px-20 h-full text-gray-600"
			:class="[hideSideBar ? 'md:ml-72 ml-4/5' : 'md:ml-20 ml-0']"
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
	},

	mounted() {
		if (JSON.parse(localStorage.getItem("dark")) == true) {
			document.documentElement.classList.add("dark");
		} else {
			document.documentElement.classList.remove("dark");
		}
	},
};
</script>

<style scoped>
.bg {
	background: linear-gradient(
			0deg,
			rgba(249, 249, 249, 0.9),
			rgba(249, 249, 249, 0.9)
		),
		url("/img/patternpad1.jpeg");
}
</style>