<template>
	<div>
		<fade>
			<div
				v-if="hide"
				@click="$emit('navClicked')"
				class="fixed top-0 left-0 bg-black bg-opacity-75 w-full h-full z-50"
			></div>
		</fade>
		<aside
			ref="sidebar"
			class="fixed top-0 left-0 bg-white transition-all duration-300 min-h-screen h-full overflow-x-hidden w-4/5 z-50"
			:class="[
				hide
					? 'transform translate-x-0'
					: 'transform -translate-x-full',
			]"
		>
			<div class="p-4 flex items-center">
				<inertia-link :href="route('dashboard')">
					<breeze-application-logo class="block h-9 w-auto" />
				</inertia-link>

				<h1 class="font-semibold text-lg ml-2 whitespace-nowrap">
					Aplikasi SPP
				</h1>
			</div>
			<div class="mt-4">
				<div v-if="$page.props.auth.user.level == 'admin'">
					<p v-if="!hideText" class="text-xs text-gray-400 ml-3 px-4">
						Utama
					</p>
					<NavLink
						:href="route('dashboard')"
						:active="route().current('dashboard')"
						popup-text="Dashboard"
						:is-sidebar-hidden="isSidebarHidden"
						class="mb-3"
					>
						<icon class="ml-1" name="dashboard-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Dashboard</span
							>
						</fade-slide>
					</NavLink>
					<p v-if="!hideText" class="text-xs text-gray-400 ml-3 px-4">
						Data
					</p>
					<NavLink
						:href="route('siswa')"
						:active="
							route().current('siswa') ||
							route().current('siswa.tambah') ||
							route().current('siswa.edit')
						"
						popup-text="Data Siswa"
						:is-sidebar-hidden="isSidebarHidden"
					>
						<icon class="ml-1" name="siswa-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Data Siswa
							</span>
						</fade-slide>
					</NavLink>

					<NavLink
						:href="route('kelas')"
						:active="
							route().current('kelas') ||
							route().current('kelas.tambah') ||
							route().current('kelas.edit') ||
							route().current('kelas.show')
						"
						popup-text="Data Kelas"
						:is-sidebar-hidden="isSidebarHidden"
					>
						<icon class="ml-1" name="kelas-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Data Kelas
							</span>
						</fade-slide>
					</NavLink>

					<NavLink
						:href="route('petugas')"
						:active="
							route().current('petugas') ||
							route().current('petugas.tambah') ||
							route().current('petugas.edit')
						"
						popup-text="Data Petugas"
						:is-sidebar-hidden="isSidebarHidden"
					>
						<icon class="ml-1" name="petugas-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Data Petugas
							</span>
						</fade-slide>
					</NavLink>

					<NavLink
						:href="route('spp')"
						:active="
							route().current('spp') ||
							route().current('spp.tambah') ||
							route().current('spp.edit')
						"
						popup-text="Data Spp"
						:is-sidebar-hidden="isSidebarHidden"
						class="mb-3"
					>
						<icon class="ml-1" name="spp-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Data Spp
							</span>
						</fade-slide>
					</NavLink>

					<p v-if="!hideText" class="text-xs text-gray-400 ml-3 px-4">
						Pembayaran
					</p>
					<NavLink
						:is-sidebar-hidden="isSidebarHidden"
						:href="route('pembayaran')"
						:active="
							route().current('pembayaran') ||
							route().current('pembayaran.tambah')
						"
						popup-text="Entri Transaksi"
					>
						<icon class="ml-1" name="entri-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Entri Transaksi
							</span>
						</fade-slide>
					</NavLink>
					<NavLink
						:href="route('histori')"
						:active="
							route().current('histori') ||
							route().current('histori.show')
						"
						popup-text="Histori Pembayaran"
						:is-sidebar-hidden="isSidebarHidden"
						class="mb-3"
					>
						<icon class="ml-1" name="histori-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Histori Pembayaran
							</span>
						</fade-slide>
					</NavLink>

					<p v-if="!hideText" class="text-xs text-gray-400 ml-3 px-4">
						Laporan
					</p>
					<NavLink
						v-if="$page.props.auth.user.level == 'admin'"
						:href="route('laporan')"
						:active="route().current('laporan')"
						popup-text="Generate Laporan"
						:is-sidebar-hidden="isSidebarHidden"
					>
						<icon class="ml-1" name="print-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Generate Laporan
							</span>
						</fade-slide>
					</NavLink>
				</div>
				<div v-else-if="$page.props.auth.user.level == 'petugas'">
					<NavLink
						:is-sidebar-hidden="isSidebarHidden"
						:href="route('pembayaran')"
						:active="
							route().current('pembayaran') ||
							route().current('pembayaran.tambah')
						"
						popup-text="Entri Transaksi"
					>
						<icon class="ml-1" name="entri-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Entri Transaksi
							</span>
						</fade-slide>
					</NavLink>
					<NavLink
						:href="route('histori')"
						:active="
							route().current('histori') ||
							route().current('histori.show')
						"
						popup-text="Histori Pembayaran"
						:is-sidebar-hidden="isSidebarHidden"
					>
						<icon class="ml-1" name="histori-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Histori Pembayaran
							</span>
						</fade-slide>
					</NavLink>
				</div>
				<div v-else>
					<NavLink
						:href="route('histori')"
						:active="route().current('histori.show')"
						popup-text="Histori Pembayaran"
						:is-sidebar-hidden="isSidebarHidden"
					>
						<icon class="ml-1" name="histori-icon"></icon>
						<fade-slide>
							<span
								v-if="!hideText"
								class="ml-4 whitespace-nowrap"
							>
								Histori Pembayaran
							</span>
						</fade-slide>
					</NavLink>
				</div>
			</div>
		</aside>
	</div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import FadeSlide from "@/Components/FadeSlide";
import NavLink from "@/Components/NavLink";
import Icon from "@/Components/Icon";
import Fade from "@/Components/Fade";

export default {
	components: {
		NavLink,
		BreezeApplicationLogo,
		FadeSlide,
		Icon,
		Fade,
	},

	emits: ["navClicked"],

	props: ["hide"],

	mounted() {},
};
</script>