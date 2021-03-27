<template>
	<form @submit.prevent="submit()">
		<div class="flex items-center justify-between mb-5">
			<h1 v-if="edit" class="text-lg font-bold">
				<span>Edit Data Spp</span>
			</h1>
			<h1 v-else class="text-lg font-bold">
				<span>Entri Pembayaran</span>
			</h1>
			<form-button
				class="ml-4 bg-indigo-400"
				:class="{ 'opacity-25': form.processing }"
				:disabled="form.processing"
			>
				<fade>
					<icon
						v-if="!form.processing"
						name="save-icon"
						class="mr-3"
					></icon>
					<spin-animation
						v-else-if="form.processing"
						:animation-showed="form.processing"
					></spin-animation>
				</fade>
				<span>Simpan</span>
			</form-button>
		</div>
		<div class="grid grid-cols-2 md:gap-5 gap-3">
			<div class="mt-4">
				<input-label for="bulan_bayar" value="Bulan Bayar" />
				<select
					required
					v-model="form.bulan_bayar"
					:class="{
						'border-red-500': form.errors.bulan_bayar,
					}"
					class="w-full block mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
				>
					<option disabled :value="null">Pilih Bulan</option>
					<option
						v-for="(m, index) in months"
						:key="index"
						:value="m"
					>
						{{ m }}
					</option>
				</select>
				<form-error
					class="mt-3"
					:message="form.errors.bulan_bayar"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="tahun_bayar" value="Tahun Bayar" />
				<form-input
					id="tahun_bayar"
					type="number"
					class="mt-1 block w-full"
					v-model="form.tahun_bayar"
					required
					autocomplete="tahun_bayar"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.tahun_bayar"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="id_spp" value="Spp" />
				<form-input
					id="id_spp"
					type="text"
					class="mt-1 block w-full"
					:value="`(${data.spp.tahun}) - ${data.spp.nominal}`"
					disabled
					required
				/>
				<form-error
					class="mt-3"
					:message="form.errors.id_spp"
				></form-error>
			</div>

			<div class="mt-4">
				<input-label for="jumlah_bayar" value="Jumlah Bayar" />
				<form-input
					id="jumlah_bayar"
					type="number"
					class="mt-1 block w-full"
					v-model="form.jumlah_bayar"
					required
					autocomplete="jumlah_bayar"
				/>
				<form-error
					class="mt-3"
					:message="form.errors.jumlah_bayar"
				></form-error>
			</div>
		</div>
	</form>
</template>

<script>
import FormButton from "@/Components/Button";
import FormInput from "@/Components/Input";
import FormError from "@/Components/InputError";
import InputLabel from "@/Components/Label";
import Icon from "@/Components/Icon";
import SpinAnimation from "@/Components/SpinAnimation.vue";
import Fade from "@/Components/Fade";
import months from "../../Helper/month";

export default {
	components: {
		FormInput,
		InputLabel,
		FormButton,
		FormError,
		Icon,
		SpinAnimation,
		Fade,
	},

	props: {
		edit: {
			default: false,
		},
		data: {
			default: null,
		},
	},

	data() {
		return {
			form: this.$inertia.form({
				nisn: this.data ? this.data.nisn : null,
				id_petugas: this.$page.props.auth.user
					? this.$page.props.auth.user.id
					: null,
				bulan_bayar: null,
				tahun_bayar: null,
				id_spp: this.data ? this.data.spp.id : null,
				jumlah_bayar: null,
			}),

			months: months,
		};
	},

	methods: {
		submit() {
			if (this.edit && this.data) {
				//console.log(this.data);
				this.form.put(this.route("pemabayaran.update", this.data.id));
			} else {
				this.form.post(this.route("pembayaran.store"), {
					preserveScroll: true,
				});
			}
		},
	},
};
</script>