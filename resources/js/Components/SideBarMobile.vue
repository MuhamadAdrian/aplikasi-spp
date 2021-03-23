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
			<div class="p-4">
				<div v-if="$page.props.auth.user.level == 'admin'">
					<!-- Admin -->
					<NavLink
						:href="route('dashboard')"
						:active="route().current('dashboard')"
					>
						<icon name="dashboard-icon"></icon>

						<span class="whitespace-nowrap"> Dashboard</span>
					</NavLink>
					<NavLink
						:href="route('siswa')"
						:active="route().current('siswa')"
					>
						<icon name="siswa-icon"></icon>

						<span class="whitespace-nowrap"> Data Siswa </span>
					</NavLink>
					<NavLink
						:href="route('kelas')"
						:active="route().current('kelas')"
					>
						<icon name="kelas-icon"></icon>

						<span class="whitespace-nowrap"> Data Kelas </span>
					</NavLink>
					<NavLink
						:href="route('petugas')"
						:active="route().current('petugas')"
					>
						<icon name="petugas-icon"></icon>

						<span class="whitespace-nowrap"> Data Petugas </span>
					</NavLink>
					<NavLink
						:href="route('spp')"
						:active="route().current('spp')"
					>
						<icon name="spp-icon"></icon>

						<span class="whitespace-nowrap"> Data Spp </span>
					</NavLink>
					<NavLink
						:href="route('pembayaran')"
						:active="route().current('pembayaran')"
					>
						<icon name="entri-icon"></icon>

						<span class="whitespace-nowrap"> Entri Transaksi </span>
					</NavLink>
					<NavLink
						:href="route('histori')"
						:active="route().current('histori')"
					>
						<icon name="histori-icon"></icon>

						<span class="whitespace-nowrap">
							Histori Pembayaran
						</span>
					</NavLink>
					<NavLink
						v-if="$page.props.auth.user.level == 'admin'"
						:href="route('laporan')"
						:active="route().current('laporan')"
					>
						<icon name="print-icon"></icon>

						<span class="whitespace-nowrap">
							Generate Laporan
						</span>
					</NavLink>
				</div>

				<div v-else-if="$page.props.auth.user.level == 'petugas'">
					<!-- Petugas -->
					<NavLink
						:href="route('pembayaran')"
						:active="route().current('pembayaran')"
					>
						<icon name="entri-icon"></icon>

						<span class="whitespace-nowrap"> Entri Transaksi </span>
					</NavLink>
					<NavLink
						:href="route('histori')"
						:active="route().current('histori')"
					>
						<icon name="histori-icon"></icon>

						<span class="whitespace-nowrap">
							Histori Pembayaran
						</span>
					</NavLink>
				</div>

				<div v-else>
					<!-- Siswa -->
					<NavLink
						:href="route('histori')"
						:active="route().current('histori')"
					>
						<icon name="histori-icon"></icon>

						<span class="whitespace-nowrap">
							Histori Pembayaran
						</span>
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