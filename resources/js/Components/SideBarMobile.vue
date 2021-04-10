<template>
	<div class="h-full w-4/5">
		<fade>
			<div
				v-if="hide"
				@click="$emit('navClicked')"
				class="fixed top-0 left-0 bg-black bg-opacity-75 w-full h-full z-50"
			></div>
		</fade>
		<aside
			ref="sidebar"
			class="fixed top-0 left-0 bg-white dark:bg-gray-800 transition-all duration-200 min-h-screen h-full overflow-x-hidden w-4/5 z-50"
			:class="[
				hide
					? 'transform translate-x-0'
					: 'transform -translate-x-full',
			]"
		>
			<div class="relative h-full">
				<div class="p-4 flex items-center justify-between">
					<div>
						<inertia-link :href="route('dashboard')">
							<breeze-application-logo class="block h-9 w-auto" />
						</inertia-link>

						<h1
							class="font-semibold text-lg ml-2 whitespace-nowrap dark:text-gray-300"
						>
							Aplikasi SPP
						</h1>
					</div>
					<button
						@click="toggleTheme()"
						class="p-4 rounded-full relative shadow-light w-14 h-14 block"
					>
						<transition name="slide">
							<div
								class="absolute w-full h-full flex top-0 left-0 items-center justify-center"
								v-if="is_dark"
								key="dark"
							>
								<svg
									class="fill-current text-white"
									xmlns="http://www.w3.org/2000/svg"
									enable-background="new 0 0 24 24"
									height="24"
									viewBox="0 0 24 24"
									width="24"
								>
									<rect fill="none" height="24" width="24" />
									<path
										d="M12,3c-4.97,0-9,4.03-9,9s4.03,9,9,9s9-4.03,9-9c0-0.46-0.04-0.92-0.1-1.36c-0.98,1.37-2.58,2.26-4.4,2.26 c-2.98,0-5.4-2.42-5.4-5.4c0-1.81,0.89-3.42,2.26-4.4C12.92,3.04,12.46,3,12,3L12,3z"
									/>
								</svg>
							</div>
							<div
								class="absolute w-full h-full flex top-0 left-0 items-center justify-center"
								v-else
								key="day"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									enable-background="new 0 0 24 24"
									height="24"
									viewBox="0 0 24 24"
									width="24"
								>
									<rect fill="none" height="24" width="24" />
									<path
										d="M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0 c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2 c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1 C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06 c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41 l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41 c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36 c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z"
									/>
								</svg>
							</div>
						</transition>
					</button>
				</div>
				<div class="mt-4">
					<div v-if="$page.props.auth.user.level == 'admin'">
						<NavLink
							:href="route('dashboard')"
							:active="route().current('dashboard')"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="dashboard-icon"></icon>

							<span class="ml-4 whitespace-nowrap">
								Dashboard</span
							>
						</NavLink>
						<NavLink
							:href="route('siswa')"
							:active="
								route().current('siswa') ||
								route().current('siswa.tambah') ||
								route().current('siswa.edit')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="siswa-icon"></icon>

							<span class="ml-4 whitespace-nowrap">
								Data Siswa
							</span>
						</NavLink>

						<NavLink
							:href="route('kelas')"
							:active="
								route().current('kelas') ||
								route().current('kelas.tambah') ||
								route().current('kelas.edit') ||
								route().current('kelas.show')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="kelas-icon"></icon>

							<span class="ml-4 whitespace-nowrap">
								Data Kelas
							</span>
						</NavLink>

						<NavLink
							:href="route('petugas')"
							:active="
								route().current('petugas') ||
								route().current('petugas.tambah') ||
								route().current('petugas.edit')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="petugas-icon"></icon>

							<span class="ml-4 whitespace-nowrap">
								Data Petugas
							</span>
						</NavLink>

						<NavLink
							:href="route('spp')"
							:active="
								route().current('spp') ||
								route().current('spp.tambah') ||
								route().current('spp.edit')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="spp-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Data Spp
							</span>
						</NavLink>

						<NavLink
							:href="route('pembayaran')"
							:active="
								route().current('pembayaran') ||
								route().current('pembayaran.tambah')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="entri-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Entri Transaksi
							</span>
						</NavLink>
						<NavLink
							:href="route('histori')"
							:active="
								route().current('histori') ||
								route().current('histori.show')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="histori-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Histori Pembayaran
							</span>
						</NavLink>

						<NavLink
							v-if="$page.props.auth.user.level == 'admin'"
							:href="route('laporan')"
							:active="route().current('laporan')"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="print-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Generate Laporan
							</span>
						</NavLink>
					</div>
					<div v-else-if="$page.props.auth.user.level == 'petugas'">
						<NavLink
							:href="route('pembayaran')"
							:active="
								route().current('pembayaran') ||
								route().current('pembayaran.tambah')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="entri-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Entri Transaksi
							</span>
						</NavLink>
						<NavLink
							:href="route('histori')"
							:active="
								route().current('histori') ||
								route().current('histori.show')
							"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="histori-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Histori Pembayaran
							</span>
						</NavLink>
					</div>
					<div v-else>
						<NavLink
							:href="route('histori')"
							:active="route().current('histori.show')"
							@linkClicked="linkHandler"
						>
							<icon class="ml-1" name="histori-icon"></icon>
							<span class="ml-4 whitespace-nowrap">
								Histori Pembayaran
							</span>
						</NavLink>
					</div>
				</div>
				<inertia-link
					:href="route('logout')"
					method="post"
					as="button"
					@linkClicked="linkHandler"
					class="absolute bottom-0 left-0 w-full flex text-white text-sm hover:bg-red-500 items-center justify-center bg-red-400 py-3"
				>
					<icon
						class="ml-1 transform rotate-180"
						name="login-icon"
					></icon>
					<span class="ml-4 whitespace-nowrap"> Keluar </span>
				</inertia-link>
			</div>
		</aside>
	</div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import NavLink from "@/Components/NavLink";
import Icon from "@/Components/Icon";
import Fade from "@/Components/Fade";
import toggleTheme from "@/Helper/toggleTheme.js";
import { Inertia } from "@inertiajs/inertia";

export default {
	components: {
		NavLink,
		BreezeApplicationLogo,
		Icon,
		Fade,
	},
	mixins: [toggleTheme],

	props: ["hide"],

	emits: ["navClicked"],

	methods: {
		linkHandler() {
			let remove = Inertia.on("success", (event) => {
				this.$emit("navClicked");
				remove();
			});
		},
	},
};
</script>